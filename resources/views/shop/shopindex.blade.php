@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Shop</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Shop</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="row">
    @foreach($shopdata as $data)
    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>{{$data->coupon_desc}}</h5>
            </div>
            <div class="card-body text-center">
                @if($data->type == 1)
                <img class="profile-user-img img-fluid img-circle" src="{{asset('images/vehicles/Vehicle_'.$data->coupon_value.'.jpg')}}" alt="Vehicle profile picture">
                @else
                <img class="profile-user-img img-fluid img-circle" src="{{asset('images/items/icon_sa.jpg')}}" alt="Vehicle profile picture">
                @endif
                <ul class="list-group list-group-unbordered mt-3 mb-1">
                    <li class="list-group-item">
                        <h5>{{$data->price}} Euro</h5>
                    </li>
                </ul>
            </div>
            <div class="card-footer text-center">
                <a href="{{route('processTransaction', $data->id)}}" class="btn btn-primary btn-sm">Kaufen</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection