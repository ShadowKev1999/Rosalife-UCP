@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Fahrzeuginformationen</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Fahrzeuginfos</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Fahrzeuginformationen</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Fahrzeug</th>
                    <th class="text-center">Tankart</th>
                    <th class="text-center">Verbrauch</th>
                    <th class="text-center">Liter</th>
                    <th class="text-center">Freikaufpreis</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carInfos as $item)
                <tr>
                    <td class="text-center"><img src="{{asset('images/vehicles/Vehicle_'.$item->ModelID.'.jpg')}}" alt="Vehicle profile picture"></td>
                    <td class="text-center"><span>{{App\Http\Controllers\AdminController::getFuelName($item->TankArt)}}</span></td>
                    <td class="text-center"><span>{{$item->Verbrauch}}</span></td>
                    <td class="text-center"><span>{{$item->Liter}} Liter</span></td>
                    <td class="text-center"><span>{{$item->Freikaufpreis}} $</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $carInfos->links() }}
    </div>
</div>
@endsection