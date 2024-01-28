@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Server Mappings</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Server Mappings</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Server Mappings</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Kartenname</th>
                    <th class="text-center">von</th>
                    <th class="text-center">Objekte</th>
                    <th class="text-center">Removes</th>
                    <th class="text-center">Aktion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serverMappings as $item)
                <tr>
                    <td class="text-center"><span>{{$item->id}}</span></td>
                    <td class="text-center"><span>{{$item->name}}</span></td>
                    <td class="text-center"><span>{{$item->creator}}</span></td>
                    <td class="text-center"><span>{{$item->objects->count()}}</span></td>
                    <td class="text-center"><span>{{$item->removes->count()}}</span></td>
                    <td class="text-center"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$serverMappings->links()}}
    </div>
</div>
@endsection