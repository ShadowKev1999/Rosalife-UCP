@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">ATMs</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">ATMs</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>ATMs</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Position</th>
                    <th class="text-center">Inhalt</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Interior</th>
                </tr>
            </thead>
            <tbody>
                @foreach($atms as $item)
                <tr>
                    <td class="text-center"><span>{{$item->id}}</span></td>
                    <td class="text-center"><span>{{$item->x}}, {{$item->y}}, {{$item->z}}, {{$item->rx}}, {{$item->ry}}, {{$item->rz}}</span></td>
                    <td class="text-center"><span>{{$item->money}} $</span></td>
                    <td class="text-center">
                        @if(!$item->state)
                        <span class="badge badge-success">In Betrieb</span>
                        @else
                        <span class="badge badge-danger">Defekt</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->interior)
                        <span class="badge badge-warning">Ja</span>
                        @else
                        <span class="badge badge-secondary">Nein</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$atms->links()}}
    </div>
</div>
@endsection