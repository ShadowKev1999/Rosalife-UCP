<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RosaLife Reloaded | User Control Panel</title>

        @include('layouts.header')
        @method('scripts')

    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            @include('layouts.navbar')
            @include('layouts.sidebar')
            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        @yield('header_content')
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        @yield('main_content')
                    </div>
                </section>
            </div>
        </div>
    </body>
    @include('layouts.footer')
    @include('layouts.footers')
    @method('scripts')
  </body>
</html>