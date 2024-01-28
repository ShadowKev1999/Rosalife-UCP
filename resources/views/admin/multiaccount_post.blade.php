@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Multiaccount Überprüfung</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Multiaccount Überprüfung</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Multiaccount Überprüfung</h5>
    </div>
    <div class="card-body">
        @if(!$playerProtocol->count())
        <div class="alert alert-danger" role="alert">
            Es wurde keine Spieler mit dieser IP-Adresse gefunden.
        </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Spieler</th>
                    <th class="text-center">IP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($playerProtocol as $item)
                <tr>
                    <td class="text-center"><span>{{$item->id}}</span></td>
                    <td class="text-center"><span class="badge badge-primary">{{$item->userData->Name}}</span></td>
                    <td class="text-center"><span>{{preg_replace('/\d+$/', '***', $item->ip)}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
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