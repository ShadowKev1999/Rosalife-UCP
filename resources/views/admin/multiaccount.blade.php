@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Spielerprotokoll</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Spielerprotokoll</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Letzte Spielerprotokolle</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Spieler</th>
                            <th class="text-center">IP</th>
                            <th class="text-center">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($playerProtocol as $item)
                        <tr>
                            <td class="text-center"><span>{{$item->id}}</span></td>
                            <td class="text-center"><span class="badge badge-primary">{{$item->userData->Name}}</span></td>
                            <td class="text-center"><span>{{preg_replace('/\d+$/', '***', $item->ip)}}</span></td>
                            <td class="text-center"><span>{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y, H:i')}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
    <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Multiaccount überprüfen</h5>
            </div>
            <form method="POST" action="{{route('multiaccount_post')}}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="ip">IP-Adresse</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-laptop"></i></span>
                            </div>
                            <input type="text" class="form-control" name="ip" id="ip" data-inputmask="'alias': 'ip'" data-mask>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Überprüfen</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom-footer-scripts')
<script src="{{asset('js/plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<script>
  $(function () {
    $('[data-mask]').inputmask()
  })
</script>
@endsection