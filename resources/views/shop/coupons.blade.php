@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Coupons</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Coupons</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Meine Coupons</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Coupon</th>
                    <th class="text-center">Datum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($couponData as $item)
                <tr>
                    <td class="text-center">{{$item->id}}</td>
                    <td class="text-center">{{$item->coupon_desc}}</td>
                    <td class="text-center"><span class="badge badge-primary">{{Carbon\Carbon::createFromTimestamp($item->servertime)}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection