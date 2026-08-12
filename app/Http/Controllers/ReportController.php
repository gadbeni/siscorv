<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use Illuminate\Support\Facades\DB;
use App\Models\Entrada;
use App\Models\Person;
use Dflydev\DotAccessData\Data;
use Dotenv\Parser\Entry;
use Prophecy\Doubler\Generator\Node\ReturnTypeNode;
use App\Models\Derivation;

class ReportController extends Controller
{
    public function rde_index()
    {
        $categoria = Category::where('deleted_at', null)->get();
        $entidad = Entity::where('deleted_at', null)->get();
        return view('report.rde.browse', compact('categoria', 'entidad'));
    }

    public function rde_list(Request $request)
    {
        $funcionario = Persona::where('user_id', Auth::user()->id)->first();
        $query_filtro = 'e.tipo = "E"';
        $start = $request->start ?? date('Y-m-d', strtotime('-30 days'));
        $finish = $request->finish ?? date('Y-m-d');
        $data = DB::table('entradas as e')
            ->leftJoin('sysadmin.people as p', 'p.id', 'e.people_id_para')
            ->leftJoin('entities as t', 't.id', 'e.entity_id')
            ->select('e.id', 'e.cite', 't.nombre as entidad', 'e.fecha_registro', 'e.remitente', 'e.referencia', 'p.first_name', 'p.last_name', 'e.job_para')
            ->whereRaw($query_filtro)
            ->whereRaw($request->category_id ? 'e.category_id = ' . $request->category_id : 1)
            ->whereRaw($request->category_id ? 'e.entity_id = ' . $request->origen : 1)
            ->whereDate('e.fecha_registro', '>=', date('Y-m-d', strtotime($start)))
            ->whereDate('e.fecha_registro', '<=', date('Y-m-d', strtotime($finish)))
            ->where('e.deleted_at', null)
            ->orderBy('e.id', 'ASC')
            ->get();

        if ($request->print) {
            return view('report.rde.print', compact('data'));
        } else {
            return view('report.rde.list', compact('data'));
        }
    }

    public function rde_documents_index()
    {
        return view('report.rde.browse-document');
    }

    public function rde_documents_list(Request $request)
    {
        $people = persona::where('user_id', Auth::user()->id)->first();
        $data = DB::table('entradas as e')
            ->join('entities as en', 'e.entity_id', 'en.id')
            ->join('derivations as d', 'd.entrada_id', 'e.id')
            ->select('e.created_at', 'e.cite', 'en.nombre as origen', 'e.remitente', 'e.referencia', 'd.funcionario_nombre_para', 'd.funcionario_cargo_para')
            ->where('e.deleted_at', null)
            ->where('e.tipo', 'E')
            ->where('d.deleted_at', null)
            ->whereDate('e.created_at', '>=', date('Y-m-d', strtotime($request->start)))
            ->whereDate('e.created_at', '<=', date('Y-m-d', strtotime($request->finish)))
            ->groupBy('e.cite')
            ->get();

        if ($request->print) {
            return view('report.rde.print-documents', compact('data'));
        } else {
            return view('report.rde.list-documents', compact('data'));
        }
    }

    public function view_report_ingreso()
    {
        $people = Person::where('deleted_at', null)->get();
        return view('report.salida.report', compact('people'));
    }

    public function printf_report_ingreso(Request $request)
    {
        $data = Entrada::with(['entity:id,nombre', 'estado:id,nombre'])
            ->where('people_id_de', $request->people)
            ->select([
                'id',
                'tipo',
                'gestion',
                'estado_id',
                'cite',
                'detalles',
                'hr',
                'remitente',
                'referencia',
                'entity_id',
                'created_at',
                'people_id_para'
            ])
            ->where('deleted_at', NULL)->orderBy('id', 'ASC')->get();

        $people = Person::where('id', $request->people)->first();
        if ($request->print) {
            $start = $request->start;
            $finish = $request->finish;
            return view('report.salida.print', compact('data', 'finish', 'start', 'people'));
        } else {
            return view('report.salida.list', compact('data'));
        }
    }

    /**
     * Formulario del reporte por direccion.
     */
    public function view_report_direcciones()
    {
        $direcciones = DB::connection('mamore')->table('direcciones')
            ->select('id', 'nombre', 'sigla')
            ->orderBy('nombre')
            ->get();

        return view('report.direcciones.report', compact('direcciones'));
    }

    /**
     * Resultado del reporte por direccion: en pantalla o para imprimir.
     */
    public function printf_report_direcciones(Request $request)
    {
        $request->validate([
            'start'     => 'required|date',
            'finish'    => 'required|date|after_or_equal:start',
            'direccion' => 'nullable|integer',
            'unidad'    => 'nullable|integer',
            'modulo'    => 'nullable|in:entrada,bandeja',
            'estado'    => 'nullable|in:todo,pendiente,enviado,urgente,derivado,archivado,rechazado',
        ], [
            'start.required'          => 'La fecha de inicio es obligatoria.',
            'finish.required'         => 'La fecha final es obligatoria.',
            'finish.after_or_equal'   => 'La fecha final no puede ser anterior a la de inicio.',
        ]);

        $start       = $request->start;
        $finish      = $request->finish;
        $direccionId = $request->filled('direccion') ? (int) $request->direccion : null;
        // La unidad solo tiene sentido dentro de una direccion; sin direccion se ignora.
        $unidadId    = $direccionId && $request->filled('unidad') ? (int) $request->unidad : null;
        $modulo      = $request->input('modulo', 'entrada') ?: 'entrada';

        // Con una direccion elegida el reporte baja a sus unidades.
        $porUnidad     = !is_null($direccionId);
        $etiquetaGrupo = $porUnidad ? 'Unidad' : 'Dirección';

        $columnas = $this->columnasVisibles($modulo, $request->input('estado'));
        $visibles = array_keys($columnas['columnas']);

        // Con un estado concreto elegido, las direcciones que no tienen nada en
        // esas columnas solo agregarian filas en cero: se descartan.
        $data = $this->resumenPorDireccion($start, $finish, $direccionId, $modulo, $unidadId)
            ->filter(function ($fila) use ($visibles) {
                foreach ($visibles as $col) {
                    if ($fila->$col > 0) {
                        return true;
                    }
                }

                return false;
            })
            ->values();

        $totales = $this->totalesResumen($data, $visibles);

        if ($request->print) {
            // Con detalle pedido, null significa que se paso del tope y el papel
            // sale solo con el resumen mas un aviso.
            $detalles = $request->detalle
                ? $this->detallesParaImpresion($start, $finish, $data, $modulo, $request->input('estado'), $direccionId, $porUnidad)
                : collect();

            $columnaDetalle  = $this->columnaDetalle($modulo, $request->input('estado'));
            $detalleExcedido = is_null($detalles);
            $detalleEtiqueta = $columnaDetalle === $columnas['total']
                ? 'Todos los registros'
                : ($columnas['columnas'][$columnaDetalle] ?? 'Todos los registros');
            $esBandeja       = $modulo === 'bandeja';
            $maxDetalle      = self::MAX_DETALLE_IMPRESION;

            return view('report.direcciones.print', compact(
                'data', 'totales', 'start', 'finish', 'columnas',
                'detalles', 'detalleExcedido', 'detalleEtiqueta', 'esBandeja', 'maxDetalle',
                'etiquetaGrupo', 'porUnidad'
            ));
        }

        return view('report.direcciones.list', compact('data', 'totales', 'columnas', 'etiquetaGrupo', 'porUnidad', 'direccionId'));
    }

    /**
     * Unidades de una direccion, para el select dependiente del filtro.
     *
     * Se listan solo las vigentes; el catalogo tiene 452 unidades en total, asi
     * que ofrecerlas todas sin acotar por direccion no seria usable.
     */
    public function unidades_de_direccion($direccion)
    {
        return response()->json(
            DB::connection('mamore')->table('unidades')
                ->where('direccion_id', (int) $direccion)
                ->where('estado', 1)
                ->whereNull('deleted_at')
                ->orderBy('nombre')
                ->get(['id', 'nombre'])
        );
    }

    /**
     * Detalle de una celda del resumen: los registros que hay detras del numero.
     *
     * Llega por AJAX al hacer clic en una cifra. La celda manda que columna se
     * toco, y de ahi sale todo: el modulo (por el prefijo del nombre) y el estado
     * concreto a filtrar.
     *
     * Las consultas repiten EXACTAMENTE los filtros de resumenEntradas() y
     * resumenBandeja(). Es lo que hace que la cantidad de registros listados
     * coincida con el numero sobre el que se hizo clic; si se tocan unos hay que
     * tocar los otros.
     */
    public function detalle_report_direcciones(Request $request)
    {
        $columnasValidas = collect($this->modulos())
            ->flatMap(fn ($m) => array_keys($m['columnas']))
            ->implode(',');

        $request->validate([
            'start'     => 'required|date',
            'finish'    => 'required|date|after_or_equal:start',
            'direccion' => 'nullable|integer',
            'grupo'     => 'nullable|integer',
            'porUnidad' => 'nullable|boolean',
            'columna'   => 'required|in:' . $columnasValidas,
        ], [
            'columna.required' => 'No se indico que columna abrir.',
            'columna.in'       => 'La columna pedida no existe en el reporte.',
        ]);

        $columna   = $request->columna;
        $porUnidad = (bool) $request->porUnidad;

        // El grupo vacio no es "todos": es la fila "Sin direccion" / "Sin unidad",
        // donde la columna quedo en NULL. Se distingue con filled().
        $grupoId     = $request->filled('grupo') ? (int) $request->grupo : null;
        $direccionId = $request->filled('direccion') ? (int) $request->direccion : null;

        return view('report.direcciones.detalle', [
            'data'      => $this->detallePorGrupo($request->start, $request->finish, $columna, $grupoId, $direccionId, $porUnidad),
            'esBandeja' => str_starts_with($columna, 'bandeja_'),
            'titulo'    => $request->input('titulo', 'Detalle'),
        ]);
    }

    /**
     * Cuantos registros como maximo se aceptan en una impresion con detalle.
     *
     * Sin tope, un rango historico sin filtrar direccion manda mas de cien mil
     * filas al papel y cuelga el navegador. Al pasarse se imprime igual el
     * resumen, con un aviso en lugar del detalle.
     */
    private const MAX_DETALLE_IMPRESION = 3000;

    /**
     * Que columna se detalla al imprimir.
     *
     * Con un estado concreto elegido, ese; con "Todo", la columna total, que son
     * todos los registros del modulo. Detallar las demas columnas cuando el
     * estado es "Todo" repetiria los mismos tramites una vez por columna.
     */
    private function columnaDetalle(string $modulo, ?string $estado): string
    {
        $modulos = $this->modulos();
        $m = $modulos[$modulo] ?? $modulos['entrada'];

        return $m['estados'][$estado] ?? $m['total'];
    }

    /**
     * Registros de todas las direcciones del reporte, agrupados por direccion.
     *
     * Una sola consulta para todas las direcciones en lugar de una por fila.
     * Devuelve null si el total supera MAX_DETALLE_IMPRESION.
     *
     * @return \Illuminate\Support\Collection|null
     */
    private function detallesParaImpresion($start, $finish, $data, string $modulo, ?string $estado, $direccionId = null, bool $porUnidad = false)
    {
        if ($data->isEmpty()) {
            return collect();
        }

        $columna   = $this->columnaDetalle($modulo, $estado);
        $esBandeja = str_starts_with($columna, 'bandeja_');
        $col       = $this->columnasAgrupacion($esBandeja ? 'bandeja' : 'entrada', $porUnidad);

        $ids = $data->pluck('grupo_id');

        $consulta = ($esBandeja
                ? $this->consultaDetalleBandeja($start, $finish, $columna, $porUnidad)
                : $this->consultaDetalleEntradas($start, $finish, $columna, $porUnidad))
            ->when($porUnidad && $direccionId, fn ($q) => $q->where($col['direccion'], $direccionId))
            ->where(function ($q) use ($col, $ids) {
                $concretos = $ids->filter()->values();

                if ($concretos->isNotEmpty()) {
                    $q->whereIn($col['grupo'], $concretos->all());
                }
                // La fila "Sin direccion" / "Sin unidad" tiene la columna en NULL
                // y whereIn no la toma.
                if ($ids->contains(null) || $ids->contains('')) {
                    $q->orWhereNull($col['grupo']);
                }
            });

        if ((clone $consulta)->count() > self::MAX_DETALLE_IMPRESION) {
            return null;
        }

        return $consulta->get()->groupBy(fn ($fila) => $fila->grupo_id ?? '');
    }

    /**
     * Consulta base del detalle del modulo Entrada, sin filtrar direccion.
     *
     * Mismos filtros que resumenEntradas(): rango sobre entradas.created_at y
     * agrupacion por la direccion que registro la nota. "Pendiente" es la que no
     * tiene ninguna derivacion vigente, con el mismo EXISTS correlacionado.
     *
     * La direccion la agrega quien llama, porque la pantalla pide una sola y la
     * impresion pide varias de una vez.
     */
    private function consultaDetalleEntradas($start, $finish, string $columna, bool $porUnidad = false)
    {
        $col = $this->columnasAgrupacion('entrada', $porUnidad);

        $tieneDerivacion = fn ($q) => $q->select(DB::raw(1))
            ->from('derivations as d')
            ->whereColumn('d.entrada_id', 'e.id')
            ->whereNull('d.deleted_at');

        return DB::table('entradas as e')
            ->leftJoin('estados as es', 'es.id', '=', 'e.estado_id')
            ->whereNull('e.deleted_at')
            ->whereDate('e.created_at', '>=', $start)
            ->whereDate('e.created_at', '<=', $finish)
            ->when($columna === 'entradas_pendientes', fn ($q) => $q->whereNotExists($tieneDerivacion))
            ->when($columna === 'entradas_enviadas', fn ($q) => $q->whereExists($tieneDerivacion))
            ->select(
                DB::raw("{$col['grupo']} as grupo_id"),
                'e.id',
                'e.created_at',
                'e.tipo',
                'e.cite',
                'e.remitente',
                'e.referencia',
                'e.urgent',
                'es.nombre as estado'
            )
            ->orderByDesc('e.created_at');
    }

    /**
     * Consulta base del detalle del modulo Bandeja, sin filtrar direccion.
     *
     * Mismos filtros que resumenBandeja(): sin transferidas, sin personerias y
     * sin tramites cerrados (estado 4 y 6), con el rango sobre
     * derivations.created_at.
     */
    private function consultaDetalleBandeja($start, $finish, string $columna, bool $porUnidad = false)
    {
        $col = $this->columnasAgrupacion('bandeja', $porUnidad);

        $estados = [
            'bandeja_derivadas'  => 'SI',
            'bandeja_archivadas' => 'ARCHIVADO',
            'bandeja_rechazadas' => 'RECHAZADO',
        ];

        return DB::table('derivations as d')
            ->join('entradas as en', 'en.id', '=', 'd.entrada_id')
            ->whereNull('d.deleted_at')
            ->where('d.transferred', 0)
            ->where('en.personeria', 0)
            ->whereNotIn('en.estado_id', [4, 6])
            ->whereDate('d.created_at', '>=', $start)
            ->whereDate('d.created_at', '<=', $finish)
            ->when($columna === 'bandeja_pendientes', fn ($q) => $q->where('d.ok', 'NO')->where('en.urgent', 0))
            ->when($columna === 'bandeja_urgentes', fn ($q) => $q->where('d.ok', 'NO')->where('en.urgent', 1))
            ->when(isset($estados[$columna]), fn ($q) => $q->where('d.ok', $estados[$columna]))
            ->select(
                DB::raw("{$col['grupo']} as grupo_id"),
                'd.id',
                'd.created_at',
                'd.ok',
                'd.funcionario_nombre_para',
                'd.funcionario_cargo_para',
                'en.cite',
                'en.remitente',
                'en.referencia',
                'en.urgent'
            )
            ->orderByDesc('d.created_at');
    }

    /**
     * Consulta del detalle acotada a la fila que se toco, paginada para pantalla.
     *
     * Cuando el reporte esta agrupado por unidad hay que filtrar por las dos: la
     * unidad identifica la fila y la direccion la acota, porque un mismo id de
     * unidad puede repetirse en catalogos distintos.
     */
    private function detallePorGrupo($start, $finish, string $columna, $grupoId, $direccionId, bool $porUnidad, int $porPagina = 25)
    {
        $esBandeja = str_starts_with($columna, 'bandeja_');
        $col       = $this->columnasAgrupacion($esBandeja ? 'bandeja' : 'entrada', $porUnidad);

        $consulta = $esBandeja
            ? $this->consultaDetalleBandeja($start, $finish, $columna, $porUnidad)
            : $this->consultaDetalleEntradas($start, $finish, $columna, $porUnidad);

        return $consulta
            ->when($porUnidad && $direccionId, fn ($q) => $q->where($col['direccion'], $direccionId))
            ->when(
                is_null($grupoId),
                fn ($q) => $q->whereNull($col['grupo']),
                fn ($q) => $q->where($col['grupo'], $grupoId)
            )
            ->paginate($porPagina);
    }

    /**
     * Catalogo de los dos modulos del reporte.
     *
     * Es la unica definicion de que columnas tiene cada modulo, que estado del
     * formulario corresponde a cada columna y como se pinta. Tanto el controlador
     * como las dos vistas trabajan sobre lo que sale de aca, asi que agregar una
     * columna se hace en un solo lugar.
     *
     * 'alerta' es la columna que se resalta en rojo por ser la que interesa
     * detectar de un vistazo: entradas sin derivar y derivaciones urgentes.
     * 'total' es la que va en negrita; puede no estar entre las mostradas si se
     * eligio un estado concreto, y en ese caso no se destaca ninguna.
     */
    private function modulos(): array
    {
        return [
            'entrada' => [
                'titulo'  => 'Entradas registradas',
                'color'   => '#eaf4fb',
                'alerta'  => 'entradas_pendientes',
                'total'   => 'entradas_total',
                'columnas' => [
                    'entradas_pendientes' => 'Pendientes',
                    'entradas_enviadas'   => 'Enviadas',
                    'entradas_total'      => 'Total',
                ],
                'estados' => [
                    'pendiente' => 'entradas_pendientes',
                    'enviado'   => 'entradas_enviadas',
                ],
            ],
            'bandeja' => [
                'titulo'  => 'Bandeja',
                'color'   => '#f3f0fa',
                'alerta'  => 'bandeja_urgentes',
                'total'   => 'bandeja_total',
                'columnas' => [
                    'bandeja_pendientes' => 'Pendientes',
                    'bandeja_urgentes'   => 'Urgentes',
                    'bandeja_derivadas'  => 'Derivadas',
                    'bandeja_archivadas' => 'Archivadas',
                    'bandeja_rechazadas' => 'Rechazadas',
                    'bandeja_total'      => 'Total',
                ],
                'estados' => [
                    'pendiente' => 'bandeja_pendientes',
                    'urgente'   => 'bandeja_urgentes',
                    'derivado'  => 'bandeja_derivadas',
                    'archivado' => 'bandeja_archivadas',
                    'rechazado' => 'bandeja_rechazadas',
                ],
            ],
        ];
    }

    /**
     * Columnas a mostrar segun el modulo elegido y su estado.
     *
     * El estado no cambia la consulta -los contadores del modulo se calculan
     * siempre completos- sino que recorta a una sola columna. De esa forma los
     * numeros son los mismos se aplique o no el filtro, que es lo que espera
     * quien compara dos reportes distintos.
     *
     * "Pendiente" existe en los dos modulos y el resto no, asi que un estado que
     * no pertenece al modulo elegido se ignora y se muestran todas sus columnas.
     * Pasa al cambiar de modulo con un estado ya seleccionado.
     *
     * @return array{titulo: string, color: string, alerta: string, total: string, columnas: array<string,string>}
     */
    private function columnasVisibles(string $modulo, ?string $estado): array
    {
        $modulos = $this->modulos();
        $m = $modulos[$modulo] ?? $modulos['entrada'];

        $columnas = isset($m['estados'][$estado])
            ? [$m['estados'][$estado] => $m['columnas'][$m['estados'][$estado]]]
            : $m['columnas'];

        return [
            'titulo'   => $m['titulo'],
            'color'    => $m['color'],
            'alerta'   => $m['alerta'],
            'total'    => $m['total'],
            'columnas' => $columnas,
        ];
    }

    /**
     * Resumen por direccion del modulo elegido.
     *
     * Los dos modulos son universos distintos y no comparables entre si, por eso
     * el reporte muestra uno por vez:
     *
     *  ENTRADAS  - se agrupan por la direccion que registro la nota
     *              (entradas.registrado_por_id_direccion, la unica poblada al
     *              100%), en el rango sobre entradas.created_at.
     *
     *  BANDEJA   - se agrupan por la direccion que recibio la derivacion
     *              (derivations.funcionario_direccion_id_para), en el rango
     *              sobre derivations.created_at.
     *
     * Solo se consulta el modulo pedido: la agregacion de derivaciones recorre
     * 224k filas y no tiene sentido pagarla para columnas que no se muestran.
     *
     * @return \Illuminate\Support\Collection
     */
    private function resumenPorDireccion($start, $finish, $direccionId = null, string $modulo = 'entrada', $unidadId = null)
    {
        // Sin direccion elegida el reporte agrupa por direccion; al elegir una,
        // baja un nivel y agrupa por las unidades de esa direccion. Los totales
        // siguen cerrando con la fila que mostraba la direccion.
        $porUnidad = !is_null($direccionId);

        $filas = $modulo === 'bandeja'
            ? $this->resumenBandeja($start, $finish, $direccionId, $unidadId, $porUnidad)
            : $this->resumenEntradas($start, $finish, $direccionId, $unidadId, $porUnidad);

        return $this->conNombreDelGrupo($filas, $porUnidad)
            ->sortBy('grupo', SORT_NATURAL | SORT_FLAG_CASE)
            ->values();
    }

    /**
     * Columnas por las que se agrupa y se filtra, segun el nivel del reporte.
     *
     * @return array{grupo: string, direccion: string, unidad: string}
     */
    private function columnasAgrupacion(string $modulo, bool $porUnidad): array
    {
        $cols = $modulo === 'bandeja'
            ? ['direccion' => 'd.funcionario_direccion_id_para', 'unidad' => 'd.funcionario_unidad_id_para']
            : ['direccion' => 'e.registrado_por_id_direccion',   'unidad' => 'e.registrado_por_id_unidad'];

        return $cols + ['grupo' => $porUnidad ? $cols['unidad'] : $cols['direccion']];
    }

    /**
     * Entradas registradas por direccion.
     *
     * "Pendiente" = todavia sin ninguna derivacion vigente; "Enviada" = ya tiene
     * al menos una.
     *
     * Se usa EXISTS correlacionado y no un LEFT JOIN contra
     * (SELECT DISTINCT entrada_id FROM derivations): el EXISTS aprovecha el
     * indice derivations_entrada_id_foreign y solo mira las entradas del rango,
     * mientras que la tabla derivada obligaba a recorrer las 224k derivaciones en
     * cada consulta, sin importar el rango pedido. "Enviadas" se deduce como
     * total - pendientes para no repetir el EXISTS.
     *
     * @return \Illuminate\Support\Collection
     */
    private function resumenEntradas($start, $finish, $direccionId = null, $unidadId = null, bool $porUnidad = false)
    {
        $col = $this->columnasAgrupacion('entrada', $porUnidad);

        return DB::table('entradas as e')
            ->whereNull('e.deleted_at')
            ->whereDate('e.created_at', '>=', $start)
            ->whereDate('e.created_at', '<=', $finish)
            ->when($direccionId, fn ($q) => $q->where($col['direccion'], $direccionId))
            ->when($unidadId, fn ($q) => $q->where($col['unidad'], $unidadId))
            ->groupBy($col['grupo'])
            ->selectRaw("
                {$col['grupo']} as grupo_id,
                COUNT(*) as entradas_total,
                SUM(CASE WHEN EXISTS (
                    SELECT 1 FROM derivations d
                    WHERE d.entrada_id = e.id AND d.deleted_at IS NULL
                ) THEN 0 ELSE 1 END) as entradas_pendientes
            ")
            ->get()
            ->map(function ($f) {
                $total      = (int) $f->entradas_total;
                $pendientes = (int) $f->entradas_pendientes;

                return (object) [
                    'grupo_id'            => $f->grupo_id,
                    'grupo_nombre'        => null,
                    'entradas_pendientes' => $pendientes,
                    'entradas_enviadas'   => $total - $pendientes,
                    'entradas_total'      => $total,
                ];
            });
    }

    /**
     * Derivaciones recibidas por direccion.
     *
     * Los estados replican las pestanas de la bandeja, con los mismos filtros que
     * usa EntradasController::derivacion_list(): sin transferidas, sin personerias
     * y sin tramites cerrados (estado 4 y 6).
     *
     * @return \Illuminate\Support\Collection
     */
    private function resumenBandeja($start, $finish, $direccionId = null, $unidadId = null, bool $porUnidad = false)
    {
        $col = $this->columnasAgrupacion('bandeja', $porUnidad);
        // Las derivaciones guardan el nombre desnormalizado de las dos, asi que el
        // respaldo del nombre sale de la misma consulta.
        $nombre = $porUnidad ? 'd.funcionario_unidad_para' : 'd.funcionario_direccion_para';

        return DB::table('derivations as d')
            ->join('entradas as en', 'en.id', '=', 'd.entrada_id')
            ->whereNull('d.deleted_at')
            ->where('d.transferred', 0)
            ->where('en.personeria', 0)
            ->whereNotIn('en.estado_id', [4, 6])
            ->whereDate('d.created_at', '>=', $start)
            ->whereDate('d.created_at', '<=', $finish)
            ->when($direccionId, fn ($q) => $q->where($col['direccion'], $direccionId))
            ->when($unidadId, fn ($q) => $q->where($col['unidad'], $unidadId))
            ->groupBy($col['grupo'])
            ->selectRaw("
                {$col['grupo']} as grupo_id,
                MAX({$nombre}) as grupo_nombre,
                COUNT(*) as bandeja_total,
                SUM(CASE WHEN d.ok = 'NO' AND en.urgent = 0 THEN 1 ELSE 0 END) as bandeja_pendientes,
                SUM(CASE WHEN d.ok = 'NO' AND en.urgent = 1 THEN 1 ELSE 0 END) as bandeja_urgentes,
                SUM(CASE WHEN d.ok = 'SI' THEN 1 ELSE 0 END) as bandeja_derivadas,
                SUM(CASE WHEN d.ok = 'ARCHIVADO' THEN 1 ELSE 0 END) as bandeja_archivadas,
                SUM(CASE WHEN d.ok = 'RECHAZADO' THEN 1 ELSE 0 END) as bandeja_rechazadas
            ")
            ->get()
            ->map(fn ($f) => (object) [
                'grupo_id'           => $f->grupo_id,
                'grupo_nombre'       => $f->grupo_nombre,
                'bandeja_pendientes' => (int) $f->bandeja_pendientes,
                'bandeja_urgentes'   => (int) $f->bandeja_urgentes,
                'bandeja_derivadas'  => (int) $f->bandeja_derivadas,
                'bandeja_archivadas' => (int) $f->bandeja_archivadas,
                'bandeja_rechazadas' => (int) $f->bandeja_rechazadas,
                'bandeja_total'      => (int) $f->bandeja_total,
            ]);
    }

    /**
     * Agrega el nombre del grupo (direccion o unidad) a cada fila.
     *
     * El nombre oficial sale de mamore. Hay direcciones y unidades que ya no estan
     * en esos catalogos, asi que para las que falten se usa el nombre
     * desnormalizado que las derivaciones guardan en funcionario_direccion_para /
     * funcionario_unidad_para.
     *
     * En el modulo Bandeja ese respaldo ya viene en la fila. En Entrada no existe
     * columna equivalente, asi que se busca con una segunda consulta contra
     * derivations, y solo si quedo algun grupo sin nombre: esas columnas no tienen
     * indice y el barrido es caro.
     *
     * @return \Illuminate\Support\Collection
     */
    private function conNombreDelGrupo($filas, bool $porUnidad)
    {
        $nombres = DB::connection('mamore')->table($porUnidad ? 'unidades' : 'direcciones')
            ->pluck('nombre', 'id');

        $sinNombre = $filas
            ->reject(fn ($f) => isset($nombres[$f->grupo_id]) || filled($f->grupo_nombre))
            ->pluck('grupo_id')
            ->filter()
            ->unique()
            ->values();

        $respaldo = collect();
        if ($sinNombre->isNotEmpty()) {
            $idCol     = $porUnidad ? 'funcionario_unidad_id_para' : 'funcionario_direccion_id_para';
            $nombreCol = $porUnidad ? 'funcionario_unidad_para' : 'funcionario_direccion_para';

            $respaldo = DB::table('derivations')
                ->whereIn($idCol, $sinNombre->all())
                ->groupBy($idCol)
                ->selectRaw("{$idCol} as id, MAX({$nombreCol}) as nombre")
                ->pluck('nombre', 'id');
        }

        $vacio = $porUnidad ? 'Sin unidad' : 'Sin dirección';

        return $filas->map(function ($f) use ($nombres, $respaldo, $vacio) {
            $f->grupo = $nombres[$f->grupo_id]
                ?? $f->grupo_nombre
                ?? $respaldo[$f->grupo_id]
                ?? null;

            $f->grupo = $f->grupo ?: $vacio;

            return $f;
        });
    }

    /**
     * Fila de totales, sobre las columnas que efectivamente se muestran.
     */
    private function totalesResumen($data, array $columnas)
    {
        return (object) collect($columnas)
            ->mapWithKeys(fn ($c) => [$c => (int) $data->sum($c)])
            ->all();
    }

    public function view_report_bandeja()
    {
        $people = Person::where('deleted_at', null)->get();
        return view('report.bandeja.report', compact('people'));
    }

    public function printf_report_bandeja(Request $request)
    {
        $data = Derivation::where('transferred', 0)->where('people_id_para', $request->people)
            ->whereHas('entrada', function ($q) {
                $q->whereNotIn('estado_id', [4, 6]);
            })
            ->whereDate('created_at', '>=', $request->start)
            ->whereDate('created_at', '<=', $request->finish)
            ->orderBy('id', 'DESC')->get();
        $people = Person::where('id', $request->people)->first();
        if ($request->print) {
            $start = $request->start;
            $finish = $request->finish;
            return view('report.bandeja.print', compact('data', 'finish', 'start', 'people'));
        } else {
            return view('report.bandeja.list', compact('data'));
        }
    }
}
