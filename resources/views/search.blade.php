<section>
    <div class="section-title" style="margin-top: 50px">
        <h2>Seguimiento</h2>
        <h3><span>Seguimiento del Trámite</span></h3>
        @if ($data)
        <p>La siguiente información te muestra el historial de tu trámite.</p>
        @endif
    </div>
    @if ($data)
        <div class="row m-5">
            <div class="col-md-6">
                <div class="panel-body" style="padding-top:0;">
                    <p>Hoja de Ruta</p>
                </div>
                <div class="panel-heading" style="border-bottom:0;">
                    <h3 class="panel-title">{{ $data->tipo.'-'.$data->gestion.'-'.$data->id }}</h3>
                </div>
            </div>
            <div class="col-md-6" style="text-align: right">
                <div class="panel-body" style="padding-top:0;">
                    <p>Fecha de ingreso</p>
                </div>
                <div class="panel-heading" style="border-bottom:0;">
                    <h5 class="panel-title">{{ date('d/m/Y H:i:s', strtotime($data->created_at)) }} <small>{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans() }}</small></h5>
                </div>
            </div>
            <hr>
            <div class="col-md-12 mt-1">
                <b>Número de Cite: </b> &nbsp; {{ $data->cite }} <br>
                <b>Número de hojas: </b> &nbsp; {{ $data->nro_hojas }} <br>
                <b>Origen: </b> &nbsp; {{ $data->entity->nombre }} <br>
                <b>Remitente: </b> &nbsp; {{ $data->remitente }} <br>
                <b>Referencia: </b> &nbsp; {{ $data->referencia }} <br>
                <b>Estado: </b> &nbsp; <span class="bg-{{ $data->estado->color }} text-white" style="padding: 2px 5px">{{ $data->estado->nombre }}</span>
            </div>
        </div>
        @php
            $cont = 1;
        @endphp
        @if (count($data->derivaciones) > 0)
            <div class="row m-5">
                <div class="col-md-12">
                    <h4 style="text-decoration: underline">Historial de derivaciones</h4>
                </div>
            </div>
            <ul class="timeline">
                @forelse ($data->derivaciones as $item)
                    @php
                        $pendiente = false;
                        if(count($data->derivaciones) == $cont && $data->estado_id == 6){
                            $pendiente = true;
                        }
                    @endphp
                    <li class="timeline-inverted">
                        <div class="timeline-badge {{ $pendiente ? 'warning': 'primary' }}"><i class="{{ $pendiente ? 'bi bi-exclamation-lg': 'bi bi-check-lg' }}"></i></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="timeline-title">{{ $item->funcionario_direccion_para }}</h4>
                                <h6>{{ $item->funcionario_nombre_para }} | <small>{{ $item->funcionario_cargo_para }}</small></h6>
                                <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> {{ date('d/M/Y H:i:s', strtotime($item->created_at)) }} {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</small></p>
                            </div>
                            <div class="timeline-body">
                                <p>{{ $item->observacion }}</p>
                            </div>
                        </div>
                    </li>
                    @php
                        $cont++;
                    @endphp
                @endforeach
            </ul>
        @endif
    @else
        <div class="row">
            <div class="col-md-12 text-center mt-3">
                <img src="{{ asset('images/not-found.png') }}" width="150px" alt="Not Found">
                <h3 class="text-muted mt-3">Trámite no encontrado</h3>
            </div>
        </div>
    @endif
    <hr>
</section>