@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Server Pickups</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Server Pickups</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Server Pickups</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Koordinaten</th>
                    <th class="text-center">Model</th>
                    <th class="text-center">World</th>
                    <th class="text-center">Interior</th>
                    <th class="text-center">Typ</th>
                    <th class="text-center">Text</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serverPickups as $item)
                <tr>
                    <td class="text-center"><span>{{$item->id}}</span></td>
                    <td class="text-center"><span>{{$item->x}}, {{$item->y}}, {{$item->z}}</span></td>
                    <td class="text-center"><span>{{$item->model}}</span></td>
                    <td class="text-center"><span>{{$item->world}}</span></td>
                    <td class="text-center"><span>{{$item->interior}}</span></td>
                    <td class="text-center"><span>{{App\Http\Controllers\AdminController::getServerPickupType($item->type)}}</span></td>
                    <td class="text-center"><span>{{$item->text}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$serverPickups->links()}}
    </div>
</div>
@endsection