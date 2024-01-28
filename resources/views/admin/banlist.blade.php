@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Server Bans</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Server Bans</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Server Bans</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Spieler</th>
                    <th class="text-center">Teammitglied</th>
                    <th class="text-center">Grund</th>
                    <th class="text-center">Datum</th>
                    <th class="text-center">Kommentare</th>
                    <th class="text-center">Aktion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($banlist as $item)
                <tr>
                    <td class="text-center"><span>{{$item->ID}}</span></td>
                    <td class="text-center"><span>{{$item->Name}}</span></td>
                    <td class="text-center"><span>{{$item->Teammitglied}}</span></td>
                    <td class="text-center"><span>{{$item->Bangrund}}</span></td>
                    <td class="text-center"><span>{{$item->Datum}}, {{$item->Uhrzeit}}</span></td>
                    <td class="text-center"><span>{{$item->comments->count()}}</span></td>
                    <td class="text-center">
                    <a class="btn btn-info btn-sm" href="{{route('banlist_details', $item->ID)}}"><i class="fa fa-folder-open"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$banlist->links()}}
    </div>
</div>
@endsection