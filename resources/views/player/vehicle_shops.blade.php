@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Autohäuser</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Autohäuser</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-primary card-outline card-outline-tabs">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Autohaus Los Santos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Motorradhandel Los Santos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Autohaus San Fierro</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Flugzeughandel Los Santos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-five-settings-tab" data-toggle="pill" href="#custom-tabs-five-settings" role="tab" aria-controls="custom-tabs-five-settings" aria-selected="false">Bootshandel Los Santos</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-five-tabContent">
            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Fahrzeug</th>
                            <th class="text-center">Preis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $item)
                        @if ($item->Autohaus != 1)
                            @continue
                        @endif
                        <tr>
                            <td>
                                <div class="text-center">
                                    <img src="{{asset('images/vehicles/Vehicle_'.$item->ModelID.'.jpg')}}" alt="Vehicle profile picture">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <h4><span class="badge badge-primary">{{$item->Preis}} $</span></h4>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Fahrzeug</th>
                            <th class="text-center">Preis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $item)
                        @if ($item->Autohaus != 2)
                            @continue
                        @endif
                        <tr>
                            <td>
                                <div class="text-center">
                                    <img src="{{asset('images/vehicles/Vehicle_'.$item->ModelID.'.jpg')}}" alt="Vehicle profile picture">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <h4><span class="badge badge-primary">{{$item->Preis}} $</span></h4>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Fahrzeug</th>
                            <th class="text-center">Preis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $item)
                        @if ($item->Autohaus != 3)
                            @continue
                        @endif
                        <tr>
                            <td>
                                <div class="text-center">
                                    <img src="{{asset('images/vehicles/Vehicle_'.$item->ModelID.'.jpg')}}" alt="Vehicle profile picture">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <h4><span class="badge badge-primary">{{$item->Preis}} $</span></h4>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Fahrzeug</th>
                            <th class="text-center">Preis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $item)
                        @if ($item->Autohaus != 4)
                            @continue
                        @endif
                        <tr>
                            <td>
                                <div class="text-center">
                                    <img src="{{asset('images/vehicles/Vehicle_'.$item->ModelID.'.jpg')}}" alt="Vehicle profile picture">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <h4><span class="badge badge-primary">{{$item->Preis}} $</span></h4>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="custom-tabs-five-settings" role="tabpanel" aria-labelledby="custom-tabs-five-settings-tab">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Fahrzeug</th>
                            <th class="text-center">Preis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vehicles as $item)
                        @if ($item->Autohaus != 5)
                            @continue
                        @endif
                        <tr>
                            <td>
                                <div class="text-center">
                                    <img src="{{asset('images/vehicles/Vehicle_'.$item->ModelID.'.jpg')}}" alt="Vehicle profile picture">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <h4><span class="badge badge-primary">{{$item->Preis}} $</span></h4>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection