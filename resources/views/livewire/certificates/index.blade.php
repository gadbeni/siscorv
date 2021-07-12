@section('page_title', 'Viendo Registros')
@push('css')
<link rel="stylesheet" href="{{ asset('css/select2.min.css')}}" type="text/css">
<style>
    .select2-search__field{
        z-index: 100002 !important
    }
</style>
@endpush
@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h1 class="page-title">
                    <i class="voyager-basket"></i> Registros
                </h1>
                <a href="{{route('certificate.create')}}"
                    class="btn btn-success"
                >
                    <i class="voyager-plus"></i> <span>Crear</span>
                </a>
            </div>
            <div class="col-md-4">

            </div>
        </div>
    </div>
@stop
<div class="page-content browse container-fluid">
    @include('voyager::alerts')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>CODIGO</th>
                                    <th>TIPO</th>
                                    <th>PRECIO</th>
                                    <th>CI</th>
                                    <th>NOMBRE</th>
                                    <th>REGISTRADO POR</th>
                                    <th>ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($certificates as $certificate)
                                    <tr>
                                        <td>{{$certificate->id}}</td>
                                        <td>{{$certificate->codigo}}</td>
                                        <td>{{$certificate->price}}</td>
                                        <td>{{$certificate->ci}}</td>
                                        <td>{{$certificate->nombre}}</td>
                                        <td>{{$certificate->fecha_registro}}</td>
                                        <td>
                                            <a href="javascript:void(0)" 
                                                onclick="Confirm('{{$certificate->id}}')"
                                                class="btn btn-dark mtmobile" 
                                                title="Delete">
                                                    <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr></tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $certificates->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.certificates.form')
</div>
@push('javascript')
<script src="{{ asset('js/select2.min.js') }}"></script>
@endpush
<script ype="text/javascript">

    document.addEventListener('livewire:load', function () {
    })
    document.addEventListener('DOMContentLoaded', function () {
        window.livewire.on('show-modal', msg => {
            $('#theModal').modal('show')
        });

        window.livewire.on('hability-getpersons', Msg => {
          ShowPrice(Msg);
        });

        window.livewire.on('show-deuda', Msg => {
            console.log(Msg)
          document.getElementById("deuda").readOnly = false;
          ShowPrice(Msg);
        });
    })
    function habilitar() {
        limpiar();
        ruta = "{{route('certificados.getFuncionario')}}";
        $('#selUser').select2({
            placeholder: '<i class="fa fa-search"></i> Buscar...',
            escapeMarkup : function(markup) {
                return markup;
            },
            language: {
                inputTooShort: function (data) {
                    return `Por favor ingrese ${data.minimum - data.input.length} o más caracteres`;
                },
                noResults: function () {
                    return `<i class="far fa-frown"></i> No hay resultados encontrados`;
                }
            },
            quietMillis: 250,
            minimumInputLength: 4,
            ajax: {
                url: function (params) {
                    return `/admin/search/${escape(params.term)}`;
                },        
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            },
            // templateResult: formatResultLandingPage,
            templateSelection: (opt) => opt.text
        });
    }

    function  limpiar() {
        $("#selUser").val(0).trigger('change');
    }
    function ShowPrice(msg) {
        
        let ruta = '';
        if (msg == "externo") {
            ruta = "{{route('certificados.getPersonas')}}";
        }else{
            ruta = "{{route('certificados.getFuncionario')}}";
        }
        
        $("#selUser").select2({
            ajax: { 
                url: ruta,
                type: "get",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term // search term
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                }
            }
        });
        var $dep = $("#departamento_id").select2();
        $('#selUser').on('select2:select', function (e) {
            var data = e.params.data;
            console.log(data)
            if (data) {
                @this.set('nombre', data.nombre);
                @this.set('ap_paterno', data.ap_paterno);
                @this.set('ap_materno', data.ap_materno);
                @this.set('ci', data.ci);
                @this.set('alfanum', data.alfanum);
                
                $("#departamento_id option").each(function(){
                    if ($(this).val() == data.departamento_id){        
                        $dep.val($(this).val()).trigger("change");
                    } 
                });   
            }					
        });
    }
    function Confirm(id)
    {
        let me = this
        swal({
            title: 'CONFIRMAR',
            text: '¿DESEAS ELIMINAR EL REGISTRO?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3B3F5C',//#3B3F5C
            cancelButtonColor: '#fff',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            closeOnConfirm: false
        }).then(function(result) {
            if (result.value) {
                window.livewire.emit('deleteRow',id)
                swal.close()
            }
        })
    }
</script>