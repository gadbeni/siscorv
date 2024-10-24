@extends('voyager::auth.master')

@section("pre_css")
    <link rel="stylesheet" href={{ asset('/character_animation/style.css') }}>
    @if(!$errors->isEmpty())
        <link rel="stylesheet" href={{ asset('/character_animation/style-color.css') }}>
    @endif
@endsection

@section('content')
    <div class="box-character">
        <div class="thought" id="thought">
            <img src={{asset('/character_animation/pensamiento250.png')}} alt="Pensamiento">
        </div>
        <div class="round-character">
            <div class="character" id="character">
                <div class="head">

                    <div class="head-character">
                        <div class="groud-eye left">
                            <div class="eye-character left">
    
                            </div>
                        </div>
                        <div class="groud-eye right">
                            <div class="eye-character right">
    
                            </div>
                        </div>
    
                    </div>
                    <div class="my-beak">
    
                    </div>
                </div>
                <div class="head-col-character">
                    <div class="body-col"></div>
                </div>
                <div id="wing" class="wing">

                </div>
            </div>
        </div>
    </div>
    <div class="login-container">

        <p>{{ __('voyager::login.signin_below') }}</p>

        <form class="form-submit" action="{{ route('voyager.login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group form-group-default" id="emailGroup">
                <label>{{ __('voyager::generic.email') }}</label>
                <div class="controls">
                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('voyager::generic.email') }}" class="form-control" required>
                </div>
            </div>
            <div class="form-group form-group-default" id="passwordGroup">
                <label>{{ __('voyager::generic.password') }}</label>
                <div class="input-group controls">
                    <input type="password" id="input-password" name="password" placeholder="{{ __('voyager::generic.password') }}" class="form-control" required>
                    <div class="input-group-addon" style="background:#fff;border:0px;font-size:25px;cursor:pointer;padding:0px;position: relative;bottom:10px;" id="btn-verpassword">
                        <span class="fa fa-eye" id="span-eye"></span>
                    </div>
                </div>
            </div>
            <div class="form-group" id="rememberMeGroup">
                <div class="controls">
                    <input type="checkbox" name="remember" id="remember" value="1"><label for="remember" class="remember-me-text">{{ __('voyager::generic.remember_me') }}</label>
                </div>
            </div>

            <button type="submit" class="btn btn-block login-button">
                <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                <span class="signin btn-submit">{{ __('voyager::generic.login') }}</span>
            </button>

        </form>

        <div style="clear:both"></div>

        @if(!$errors->isEmpty())
            <div class="alert alert-red">
                <ul class="list-unstyled">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div> <!-- .login-container -->
@endsection

@section('post_js')
    <script src="{{ asset('/character_animation/script.js') }}"></script>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script>
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var email = document.querySelector('[name="email"]');
        var password = document.querySelector('[name="password"]');
        btn.addEventListener('click', function(ev){
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        email.focus();
        document.getElementById('emailGroup').classList.add("focused");

        // Focus events for email and password fields
        email.addEventListener('focusin', function(e){
            document.getElementById('emailGroup').classList.add("focused");
        });
        email.addEventListener('focusout', function(e){
            document.getElementById('emailGroup').classList.remove("focused");
        });

        password.addEventListener('focusin', function(e){
            document.getElementById('passwordGroup').classList.add("focused");
        });
        password.addEventListener('focusout', function(e){
            document.getElementById('passwordGroup').classList.remove("focused");
        });

        $(document).ready(function(){
            let ver_pass = false;
            $('.form-submit').submit(function(e){
                $('.form-submit .btn-submit').attr('disabled', 'disabled');
            });
            $('#btn-verpassword').click(function(){
                if(ver_pass){
                    ver_pass = false;
                    // $(this).html('<span class="fa fa-eye"></span>');
                    $('#span-eye').removeClass("fa-eye-slash")
                    $('#span-eye').addClass("fa-eye")
                    $('#input-password').prop('type', 'password');
                }else{
                    ver_pass = true;
                    // $(this).html('<span class="fa fa-eye-slash"></span>');
                    $('#span-eye').removeClass("fa-eye")
                    $('#span-eye').addClass("fa-eye-slash")
                    $('#input-password').prop('type', 'text');
                }
            });
        });
    </script>
@endsection
