@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Busroute - Details</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Busroute - Details</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Busroute - Details {{$busRoute->name}}</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Checkpoint</th>
                    <th class="text-center">Aktion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($busRoute->checkpoints as $item)
                <tr>
                    <td class="text-center"><span>{{$loop->index+1}}</span></td>
                    <td class="text-center"><span>{{$item->checkpoint}}</span></td>
                    <td class="text-center">
                        <a class="btn btn-warning btn-sm" href="#"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="#"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection