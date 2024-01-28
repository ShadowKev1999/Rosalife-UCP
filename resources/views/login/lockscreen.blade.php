<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RosaLife Reloaded | Passworteingabe</title>

        @include('layouts.header')
    </head>
    <body class="hold-transition lockscreen">
        <!-- Automatic element centering -->
        <div class="lockscreen-wrapper">
            <div class="lockscreen-logo">
                <a href="../../index2.html" class="text-white"><b>Rosa</b>Life | UCP</a>
            </div>
            <!-- User name -->
            <div class="lockscreen-name text-white">c0kkie</div>
                <!-- START LOCK SCREEN ITEM -->
                <div class="lockscreen-item">
                    <!-- lockscreen image -->
                    <div class="lockscreen-image">
                        <img src="{{asset('images/skins-avatar/0.png') }}" alt="User Image">
                    </div>
                    <!-- /.lockscreen-image -->
                    <!-- lockscreen credentials (contains the form) -->
                    <form class="lockscreen-credentials" method="POST" action="{{ route('unlock') }}">
                        @csrf
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Passwort">
                            <div class="input-group-append">
                                <button type="button" class="btn">
                                    <i class="fas fa-arrow-right text-muted"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- /.lockscreen credentials -->
                </div>
                <!-- /.lockscreen-item -->
                <div class="help-block text-center alert alert-secondary">
                    Gib dein Passwort ein, um zurückzukehren!
                </div>
                <div class="text-center">
                    <a href="{{route('logout')}}" class="btn btn-danger btn-sm mt-3">Ausloggen</a>
                </div>
            </div>
            <!-- /.center -->
        @include('layouts.footers')
        @method('scripts')
    </body>
</html>
