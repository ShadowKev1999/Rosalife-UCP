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
                    <p class="login-box-msg">Gib deine Benutzerdaten ein!</p>
                    <form action="{{route('postlogin')}}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="Name" id="Name" class="form-control" placeholder="Spielername">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="Passwort" id="Passwort" class="form-control" placeholder="Passwort">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                        {!! NoCaptcha::display() !!}
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="icheck-primary">
                                    <input type="checkbox" id="remember">
                                    <label for="remember">
                                        Eingeloggt bleiben?
                                    </label>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Einloggen</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <p class="mb-1 mt-3">
                        <a href="{{ route('forget_password_get') }}">Passwort vergessen?</a>
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


