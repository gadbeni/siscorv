@extends('voyager::master')

@section('page_title', 'Bandeja de Entradas')

@if(auth()->user()->hasPermission('browse_bandeja'))

    @section('content')
        <div id="page-content" class="page-content browse container-fluid">
            @include('voyager::alerts')
            <div class="row">
                <div class="col-md-12 div-phone">
                    <div class="panel panel-bordered">
                        <div class="panel-body">

                            <div class="alert alert-info" style="padding: 5px 10px; display: none" role="alert" id="alert-new">
                                <div class="row">
                                    <div class="col-md-8" style="margin: 0px">
                                    <p style="margin-top: 10px"><b>Atención!</b> Tienes una nueva derivación, refresca la página para actualizar la lista.</p></div>
                                    <div class="col-md-4 text-right" style="margin: 0px"><button class="btn btn-default" onclick="location.reload()">Refrescar <i class="voyager-refresh"></i></button></div>
                                </div>
                            </div>

                            @php
                                $pestanas = [
                                    ['pendientes', 'Pendientes', 'fa-inbox',       $resumen->pendientes],
                                    ['urgentes',   'Urgentes',   'fa-bolt',        $resumen->urgentes],
                                    ['vias',       'Vías',       'fa-signs-post',  $resumen->vias],
                                    ['derivados',  'Derivados',  'fa-share',       $resumen->derivados],
                                    ['archivados', 'Archivados', 'fa-box-archive', $resumen->archivados],
                                ];
                            @endphp
                            <div class="bandeja-tabs" role="tablist">
                                @foreach ($pestanas as [$valor, $titulo, $icono, $cantidad])
                                    <button type="button" class="bandeja-tab @if($valor == 'pendientes') active @endif"
                                            data-type="{{ $valor }}" role="tab" aria-selected="{{ $valor == 'pendientes' ? 'true' : 'false' }}">
                                        <i class="fa-solid {{ $icono }}"></i>
                                        <span>{{ $titulo }}</span>
                                        <span class="bandeja-tab-count">{{ number_format($cantidad, 0, ',', '.') }}</span>
                                    </button>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-sm-9" style="margin-bottom: 0px">
                                    <div class="dataTables_length" id="dataTable_length">
                                        <label>Mostrar <select id="select-paginate" class="form-control input-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50" selected>50</option>
                                            <option value="100">100</option>
                                        </select> registros</label>
                                    </div>
                                </div>
                                <div class="col-sm-3" style="margin-bottom: 0px">
                                    <input type="text" id="input-search" class="form-control" placeholder="Ingrese busqueda..."> <br>
                                </div>
                            </div>
                            <div class="row" id="div-results" style="min-height: 200px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('css')
        <style>
            .entrada:hover{
                cursor: pointer;
                opacity: .7;
            }
            .unread{
                background-color: rgba(135, 183, 148, 0.2) !important
            }

            /* Pestanas de la bandeja */
            .bandeja-tabs{
                display: flex;
                flex-wrap: wrap;
                gap: 4px;
                border-bottom: 1px solid #e4e7ea;
                margin-bottom: 15px;
            }
            .bandeja-tab{
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 8px 14px;
                background: none;
                border: 0;
                border-bottom: 2px solid transparent;
                margin-bottom: -1px;
                color: #76838f;
                font-size: 14px;
            }
            .bandeja-tab:hover{ color: #2c3e50; }
            .bandeja-tab:focus{ outline: none; }
            .bandeja-tab:focus-visible{ background: #f5f6f7; }
            .bandeja-tab.active{
                color: #2c3e50;
                font-weight: 600;
                border-bottom-color: #22a565;
            }
            .bandeja-tab.active i{ color: #22a565; }
            .bandeja-tab-count{
                min-width: 22px;
                padding: 1px 7px;
                border-radius: 10px;
                background: #eef0f2;
                color: #76838f;
                font-size: 12px;
                font-weight: 600;
                text-align: center;
            }
            .bandeja-tab.active .bandeja-tab-count{ background: #22a565; color: #fff; }
        </style>
    @endsection

    @section('javascript')
        <script src="https://cdn.socket.io/4.1.2/socket.io.min.js" integrity="sha384-toS6mmwu70G0fw54EGlWWeA4z3dyJ+dlXBtSURSKN4vyRFOcxd3Bzjj/AoOwY+Rg" crossorigin="anonymous"></script>
        <script>
            var countPage = 50;
            var currentType = 'pendientes';

            function activarTab(type){
                currentType = type;
                $('.bandeja-tab').removeClass('active').attr('aria-selected', 'false');
                $(`.bandeja-tab[data-type="${type}"]`).addClass('active').attr('aria-selected', 'true');
            }

            $(document).ready(function(){
                // Recordar la pestana al volver desde el detalle de un tramite.
                try {
                    let guardada = localStorage.getItem('bandeja.tab');
                    if (guardada && $(`.bandeja-tab[data-type="${guardada}"]`).length) {
                        activarTab(guardada);
                    }
                } catch (e) {}

                list();

                $('.bandeja-tab').click(function(){
                    activarTab($(this).data('type'));
                    try { localStorage.setItem('bandeja.tab', currentType); } catch (e) {}
                    list();
                });

                $('#input-search').on('keyup', function(e){
                    if(e.keyCode == 13) {
                        list();
                    }
                });
                $('#select-paginate').change(function(){
                    countPage = $(this).val();
                    list();
                });

                try {
                     // Socket.io
                    let socket = io(IP_ADDRESS + ':' + SOCKET_PORT);
                    socket.on('sendNotificationToClient', (id) => {
                        let user_id = "{{ Auth::user()->id }}";
                        if(user_id == id){
                            $('#alert-new').fadeIn();
                        }
                    });
                } catch (error) {
                    
                }

                @if (session('alert-type'))
                socket.emit('sendNotificationToServer', "{{ session('funcionario_id') }}");
                @endif
            });

            function list(page = 1){
                $('#div-results').loading({message: 'Cargando...'});
                let type = currentType;
                let url = '{{ url("admin/bandeja/list/".($funcionario_id ?? 0)) }}';
                let search = $('#input-search').val() ? $('#input-search').val() : '';
                $.ajax({
                    url: `${url}/${type}?search=${search}&paginate=${countPage}&page=${page}`,
                    type: 'get',
                    success: function(response){
                        $('#div-results').html(response);
                        $('#div-results').loading('toggle');
                    }
                });
            }

            function read(id){
                window.location = "{{ url('admin/bandeja') }}/"+id;
            }
        </script>
    @stop
    
@else
    @section('content')
        @include('errors.403')
    @stop
@endif