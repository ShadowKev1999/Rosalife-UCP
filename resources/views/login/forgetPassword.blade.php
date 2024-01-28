<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rosa Life Reloaded | Login</title>
        @include('layouts.header')
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
        <!-- /.login-logo -->
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="/" class="h1"><b>Rosa</b>Life | UCP</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Passwort vergessen</p>
                    <form action="{{route('forget_password_post')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="E-Mail">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                        {!! NoCaptcha::display() !!}
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Zurücksetzen</button>
                    </form>
                    <p class="mb-1 mt-3">
                        <a href="{{ route('login') }}">Einloggen</a>
                    </p>
                </div>
            <!-- /.card-body -->
            </div>
        <!-- /.card -->
        </div>
        <!-- /.login-box -->
        @include('layouts.footers')
        @method('scripts')
        {!! NoCaptcha::renderJs('de', true, 'recaptchaCallback') !!}
        <script>
        function recaptchaCallback() {
            document.querySelectorAll('.g-recaptcha').forEach(function (el) {
                grecaptcha.render(el);
            });
        }
        </script>
    </body>
</html>


