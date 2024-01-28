@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Teamspeak</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Teamspeak</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Teamspeak Identitäten</h5>
            </div>
            <div class="card-body">
                @if(!Auth::guard('account')->user()->teamspeakuser->count())
                <div class="alert alert-secondary" role="alert">
                    Du hast noch keine Teamspeak Identität angelegt.
                </div>
                @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Identiät</th>
                            <th class="text-center">Beschreibung</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::guard('account')->user()->teamspeakuser as $item)
                        <tr>
                            <td class="text-center"><span>{{$item->id}}</span></td>
                            <td class="text-center"><span class="badge badge-primary">{{$item->identity}}</span></td>
                            <td class="text-center"><span>{{$item->description}}</span></td>
                            <td class="text-center">
                                <a href="{{ route('teamspeak_delete', $item->id) }}" class="btn btn-danger btn-sm">Entfernen</a>
                                @if($item->synced)
                                <button class="btn btn-warning btn-sm" disabled>Syncronisieren</button>
                                @else
                                <a href="{{ route('teamspeak_sync', $item->id) }}" class="btn btn-warning btn-sm">Syncronisieren</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                Identität anlegen
            </div>
            <form action="{{route('teamspeak_add')}}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="identity">Eindeutige ID</label>
                        <input type="text" class="form-control" id="identity" name="identity" placeholder="Identität eingeben">
                    </div>
                    <div class="form-group">
                        <label for="description">Beschreibung</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Beschreibung">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Anlegen</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection