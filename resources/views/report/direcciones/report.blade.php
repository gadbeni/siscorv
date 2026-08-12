@extends('voyager::master')

@section('page_title', 'Reporte por Dirección')

@if(auth()->user()->hasRole('admin'))

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-6" style="padding: 0px">
                            <h1 class="page-title">
                                <i class="voyager-list"></i> Reporte por Dirección
                            </h1>
                            <p class="text-muted" style="margin-left: 15px">
                                Entradas registradas y estado de las bandejas, agrupado por dirección.
                            </p>
                        </div>
                        <div class="col-md-6" style="margin-top: 20px">
                            <form name="form_search" id="form-search" action="{{ route('print.report.direcciones') }}" method="post">
                                @csrf
                                <input type="hidden" name="print">
                                <input type="hidden" name="detalle">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="direccion" id="select-direccion" class="form-control select2">
                                                <option value="">Todas las direcciones</option>
                                                @foreach ($direcciones as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                                @endforeach
                                            </select>
                                            <small>Dirección (opcional) — al elegir una, el reporte se abre por unidades</small>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select name="unidad" id="select-unidad" class="form-control select2" disabled>
                                                <option value="">Todas las unidades</option>
                                            </select>
                                            <small id="ayuda-unidad" class="text-muted">Unidad (opcional) — elija primero una dirección</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="date" name="start" class="form-control" required>
                                            <small>Fecha inicio</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="date" name="finish" class="form-control" required>
                                            <small>Fecha fin</small>
                                        </div>
                                    </div>
                                </div>

                                {{-- El modulo define que mitad del reporte se muestra y que
                                     estados ofrece el segundo select. El estado no cambia los
                                     contadores, solo recorta a una columna: una misma columna da
                                     el mismo numero con filtro y sin el. --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="modulo" id="select-modulo" class="form-control">
                                                <option value="entrada">Entrada</option>
                                                <option value="bandeja">Bandeja</option>
                                            </select>
                                            <small>Módulo</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select name="estado" id="select-estado" class="form-control"></select>
                                            <small>Estado</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary" style="padding: 5px 10px">
                                        <i class="voyager-settings"></i> Generar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content browse container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div id="div-results" style="min-height: 100px"></div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .loader{
            width: 100px;
            height: 100px;
            border-radius: 100%;
            position: relative;
            margin: 0 auto;
        }
        #loader-3:before, #loader-3:after{
            content: "";
            width: 20px;
            height: 20px;
            position: absolute;
            top: 0;
            left: calc(50% - 10px);
            background-color: #3498db;
            animation: squaremove 1s ease-in-out infinite;
        }
        #loader-3:after{
            bottom: 0;
            animation-delay: 0.5s;
        }
        @keyframes squaremove{
            0%, 100%{ transform: translate(0,0) rotate(0); }
            25%{ transform: translate(40px,40px) rotate(45deg); }
            50%{ transform: translate(0px,80px) rotate(0deg); }
            75%{ transform: translate(-40px,40px) rotate(45deg); }
        }
    </style>
@stop

@section('javascript')
    <script>
        // Estados de cada modulo. Mismas claves que ReportController::modulos(),
        // que es donde se decide que columna muestra cada una.
        var ESTADOS = {
            entrada: [
                ['todo',      'Todo'],
                ['pendiente', 'Pendiente'],
                ['enviado',   'Enviado']
            ],
            bandeja: [
                ['todo',      'Todo'],
                ['pendiente', 'Pendiente'],
                ['urgente',   'Urgente'],
                ['derivado',  'Derivado'],
                ['archivado', 'Archivado'],
                ['rechazado', 'Rechazado']
            ]
        };

        // Repuebla el select de estado. Si el estado que estaba elegido tambien
        // existe en el modulo nuevo se conserva ("Pendiente" esta en los dos);
        // si no, vuelve a "Todo".
        function cargarEstados(modulo, anterior) {
            var $estado = $('#select-estado');
            var opciones = ESTADOS[modulo] || ESTADOS.entrada;

            $estado.empty();
            $.each(opciones, function(i, op) {
                $estado.append($('<option>', { value: op[0], text: op[1] }));
            });

            var existe = opciones.some(function(op) { return op[0] === anterior; });
            $estado.val(existe ? anterior : 'todo');
        }

        // Unidades de la direccion elegida. El catalogo tiene 452, asi que se piden
        // acotadas y solo cuando hay direccion; sin direccion el select queda
        // deshabilitado porque el reporte agrupa por direccion y la unidad no aplica.
        function cargarUnidades(direccionId) {
            var $unidad = $('#select-unidad');
            var $ayuda  = $('#ayuda-unidad');

            // Select2 v4 no observa cambios en el atributo disabled del <select>,
            // asi que en vez de confiar en trigger('change') se destruye y se
            // vuelve a crear. Es lo unico que redibuja opciones y estado a la vez.
            // width 100% replica lo que hace Voyager al iniciar los .select2.
            function refrescar(habilitado) {
                if ($.fn.select2 && $unidad.data('select2')) {
                    $unidad.select2('destroy');
                }

                $unidad.prop('disabled', !habilitado);

                if ($.fn.select2) {
                    $unidad.select2({ width: '100%' });
                }
            }

            $unidad.empty().append($('<option>', { value: '', text: 'Todas las unidades' }));

            if (!direccionId) {
                refrescar(false);
                $ayuda.text('Unidad (opcional) — elija primero una dirección');
                return;
            }

            refrescar(false);
            $ayuda.text('Cargando unidades…');

            $.get('{{ url('admin/report/direcciones') }}/' + direccionId + '/unidades', function (res) {
                $.each(res, function (i, u) {
                    $unidad.append($('<option>', { value: u.id, text: u.nombre }));
                });
                refrescar(res.length > 0);
                $ayuda.text(res.length
                    ? 'Unidad (opcional) — ' + res.length + ' unidades, puede escribir para buscar'
                    : 'Esta dirección no tiene unidades registradas');
            }).fail(function () {
                refrescar(false);
                $ayuda.text('No se pudieron cargar las unidades');
            });
        }

        $(document).ready(function() {
            cargarEstados($('#select-modulo').val(), null);

            $('#select-modulo').on('change', function() {
                cargarEstados(this.value, $('#select-estado').val());
            });

            $('#select-direccion').on('change', function() {
                cargarUnidades(this.value);
            });

            $('#form-search').on('submit', function(e){
                e.preventDefault();
                $('#div-results').empty();
                $('#div-results').html('<div class="col-md-12 bg"><div class="loader" id="loader-3"></div></div>');

                $.post($('#form-search').attr('action'), $('#form-search').serialize(), function(res){
                    $('#div-results').html(res);
                })
                .fail(function(xhr) {
                    $('#div-results').empty();
                    // 422 = el rango de fechas no paso la validacion del servidor.
                    if (xhr.status === 422) {
                        var errores = xhr.responseJSON && xhr.responseJSON.errors
                            ? Object.values(xhr.responseJSON.errors).flat().join('<br>')
                            : 'Revise el rango de fechas.';
                        toastr.warning(errores, 'Datos incompletos');
                    } else {
                        toastr.error('Ocurrió un error!', 'Oops!');
                    }
                })
                .always(function() {
                    $('html, body').animate({
                        scrollTop: $("#div-results").offset().top - 70
                    }, 500);
                });
            });
        });

        // ---- Detalle de una celda -------------------------------------------
        // La tabla del resumen llega por AJAX, asi que los handlers van delegados
        // sobre document; si se bindearan directo se perderian en cada consulta.

        // Ultima celda abierta, para que el paginado sepa que volver a pedir.
        var celdaAbierta = null;

        function cargarDetalle(celda, pagina) {
            var $destino = $('#detalle-fila-' + celda.fila).find('td');

            $('#detalle-fila-' + celda.fila).show();
            $destino.html('<div class="text-center text-muted" style="padding:15px">Cargando…</div>');

            $.post('{{ route('detalle.report.direcciones') }}', {
                _token:    '{{ csrf_token() }}',
                start:     $('#form-search input[name="start"]').val(),
                finish:    $('#form-search input[name="finish"]').val(),
                grupo:     celda.grupo,
                direccion: celda.direccion,
                porUnidad: celda.porUnidad,
                columna:   celda.columna,
                titulo:    celda.titulo,
                page:      pagina || 1
            }, function (res) {
                $destino.html(res);
            }).fail(function (xhr) {
                var msg = xhr.status === 422 ? 'Revise el rango de fechas.' : 'No se pudo cargar el detalle.';
                $destino.html('<div class="text-center text-danger" style="padding:15px">' + msg + '</div>');
            });
        }

        $(document).on('click', '.celda-detalle', function (e) {
            e.preventDefault();

            var celda = {
                fila:      $(this).data('fila'),
                grupo:     $(this).data('grupo'),
                direccion: $(this).data('direccion'),
                porUnidad: $(this).data('por-unidad') ? 1 : 0,
                columna:   $(this).data('columna'),
                titulo:    $(this).data('titulo')
            };

            // Segundo clic sobre la misma celda: cierra.
            if (celdaAbierta &&
                celdaAbierta.fila === celda.fila &&
                celdaAbierta.columna === celda.columna &&
                $('#detalle-fila-' + celda.fila).is(':visible')) {
                $('.fila-detalle').hide().find('td').empty();
                celdaAbierta = null;
                return;
            }

            // Solo un detalle abierto a la vez.
            $('.fila-detalle').hide().find('td').empty();
            celdaAbierta = celda;
            cargarDetalle(celda, 1);
        });

        $(document).on('click', '.pagina-detalle', function () {
            if (celdaAbierta) {
                cargarDetalle(celdaAbierta, $(this).data('pagina'));
            }
        });

        $(document).on('click', '.cerrar-detalle', function () {
            $('.fila-detalle').hide().find('td').empty();
            celdaAbierta = null;
        });

        // conDetalle = true agrega al papel la lista de registros de cada
        // direccion, debajo del resumen.
        function report_print(conDetalle){
            $('#form-search').attr('target', '_blank');
            $('#form-search input[name="print"]').val(1);
            $('#form-search input[name="detalle"]').val(conDetalle ? 1 : '');
            window.form_search.submit();
            $('#form-search').removeAttr('target');
            $('#form-search input[name="print"]').val('');
            $('#form-search input[name="detalle"]').val('');
        }
    </script>
@stop

@else
    @section('content')
        <h1>403</h1>
    @stop
@endif
