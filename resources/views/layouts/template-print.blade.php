<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('page_title') | {{ env('APP_NAME', 'MAMORE') }}</title>
        <!-- Favicon -->
        <?php $admin_favicon = Voyager::setting('admin.icon_image', ''); ?>
        @if($admin_favicon == '')
            <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/png">
        @else
            <link rel="shortcut icon" href="{{ Voyager::image($admin_favicon) }}" type="image/png">
        @endif
        <style>
            body{
                margin: 0px auto;
                font-family: Arial, sans-serif;
            }
            .container {
                display: flex;
                justify-content: center;
                width: 100%;
                background: rgb(115,117,117);
                background: linear-gradient(90deg, rgba(115,117,117,1) 0%, rgba(173,173,173,1) 50%, rgba(115,117,117,1) 100%);
            }
            .sheet {
                padding: 30px;
                max-width: 780px;
                background-color: white
            }
            .content {
                text-align: justify;
                padding: 0px 34px;
                font-size: 13px;
                min-height: 100vh;
            }
            .page-head {
                text-align: center;
            }
            .page-head h3 {
                margin-top: 0px !important
            }
            #watermark {
                position: fixed;
                width: 100%;
                text-align: center;
                top: 350px;
                opacity: 0.1;
                z-index:  0;
            }
            #watermark img{
                position: relative;
                width: 300px;
            }

            .btn {
                padding: 8px 15px
            }
            .text-center{
                text-align: center;
            }
            ol p{
                margin: 10px
            }
            .table-signature {
                width: 100%;
                text-align: center;
                margin-top: 80px;
                margin-bottom: 50px;
            }

            @page {
                /* size: letter; */
                margin: 10mm 10mm 10mm 10mm;
            }
            @media print {
                body{
                    margin: 0px auto;
                }
                .options {
                    display: none
                }
                .sheet {
                    padding: 0px;
                    max-width: 100%;
                    background-color: white
                }
                .container {
                    background-color: transparent
                }
                .content {
                    min-height: auto;
                }
                .table-signature {
                    margin-bottom: 0px;
                }
            }
        </style>
    </head>
    <body>
        <div id="watermark">
            <img src="{{ asset('images/icon.png') }}" /> 
        </div>
        <div class="container">
            <div class="sheet" style="position: relative">
                <div class="options" style="position: fixed; bottom: 10px; right: 20px; z-index:100;">
                    <button type="button" class="btn btn-print">Imprimir</button>
                </div>
        
                @yield('content')
            </div>
        </div>

        @yield('css')

        <script>
            window.onafterprint = function(event) {
                console.log('before print');
            };
        </script>

        <script src="{{ asset('js/jquery-3.4.1.min.js')}}" ></script>
        <script>
            $(document).ready(function () {
                $('.btn-print').click(function(){
                    window.print();
                });
            });
        </script>
        @yield('script')
    </body>
</html>