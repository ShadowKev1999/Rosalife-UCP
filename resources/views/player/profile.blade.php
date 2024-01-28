@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Profil</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Profil</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h3>Profil von {{Auth::guard('account')->user()->Name}}</h3>     
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div class="text-center">
                    <img style="width: 25%;" src="{{asset('images/skins/'.Auth::guard('account')->user()->SkinID.'.png')}}" alt="User profile picture">
                </div>
            </div>
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td class="text-bold">Level</td>
                            <td>{{Auth::guard('account')->user()->Level}}</td>
                        </tr>
                        <tr>
                            <td class="text-bold">Exp</td>
                            <td>{{Auth::guard('account')->user()->EXP}} / {{Auth::guard('account')->user()->EXPNeeded}} EXP</td>
                        </tr>
                        <tr>
                            <td class="text-bold">Registrierung</td>
                            <td>{{Auth::guard('account')->user()->Registerdatum}}</td>
                        </tr>
                        <tr>
                            <td class="text-bold">Alter</td>
                            <td>{{Auth::guard('account')->user()->Alter}}</td>
                        </tr>
                        <tr>
                            <td class="text-bold">Bargeld</td>
                            <td>{{Auth::guard('account')->user()->Bargeld}} $</td>
                        </tr>
                        <tr>
                            <td class="text-bold">Bankkonto</td>
                            <td>{{Auth::guard('account')->user()->Bankkonto}} $</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Autoschein</b> <a class="float-right">@if(Auth::guard('account')->user()->Autoschein) <i class="fas fa-check text-success"></i> @else <i class="fas fa-circle text-danger"></i> @endif</a>
                    </li>
                    <li class="list-group-item">
                        <b>Bootsschein</b> <a class="float-right">@if(Auth::guard('account')->user()->Bootsschein) <i class="fas fa-check text-success"></i> @else <i class="fas fa-circle text-danger"></i> @endif</a>
                    </li>
                    <li class="list-group-item">
                        <b>Waffenschein</b> <a class="float-right">@if(Auth::guard('account')->user()->Waffenschein) <i class="fas fa-check text-success"></i> @else <i class="fas fa-circle text-danger"></i> @endif</a>
                    </li>
                    <li class="list-group-item">
                        <b>Flugschein</b> <a class="float-right">@if(Auth::guard('account')->user()->Flugschein) <i class="fas fa-check text-success"></i> @else <i class="fas fa-circle text-danger"></i> @endif</a>
                    </li>
                    <li class="list-group-item">
                        <b>LKWschein</b> <a class="float-right">@if(Auth::guard('account')->user()->LKWschein) <i class="fas fa-check text-success"></i> @else <i class="fas fa-circle text-danger"></i> @endif</a>
                    </li>
                    <li class="list-group-item">
                        <b>Motorradschein</b> <a class="float-right">@if(Auth::guard('account')->user()->Motorradschein) <i class="fas fa-check text-success"></i> @else <i class="fas fa-circle text-danger"></i> @endif</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Fahrzeuge</h5>
            </div>
            <div class="card-body">
                @if(Auth::guard('account')->user()->vehicles->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Fahrzeug</th>
                            <th class="text-center">Kennzeichen</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::guard('account')->user()->vehicles as $item)
                        <tr>
                            <td>
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="{{asset('images/vehicles/Vehicle_'.$item->ModelID.'.jpg')}}" alt="Vehicle profile picture">
                                </div>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="badge badge-primary">{{$item->Kennzeichen}}</span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-danger" role="alert">
                    Du besitzt keine Fahrzeuge.
                </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Einnahmen</h5>
            </div>
            <div class="card-body">
                @if(!Auth::guard('account')->user()->transactionGet->count())
                <div class="alert alert-secondary" role="alert">
                    Du hast noch keine Einnahmen erzielt.
                </div>
                @else
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center">Von</th>
                            <th class="text-center">Betrag</th>
                            <th class="text-center">Verwendungszweck</th>
                            <th class="text-center">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::guard('account')->user()->transactionGet as $item)
                        <tr>
                            <td class="text-center">{{$item->Sender}}</td>
                            <td class="text-center">{{$item->Betrag}} $</td>
                            <td class="text-center">{{$item->Verwendungszweck}}</td>
                            <td class="text-center">{{$item->Datum}}, {{$item->Uhrzeit}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Ausgaben</h5>
            </div>
            <div class="card-body">
                @if(!Auth::guard('account')->user()->transactionSender->count())
                <div class="alert alert-secondary" role="alert">
                    Du hattest noch keine Ausgaben.
                </div>
                @else
                <table class="table table-bordered table-responsive">
                    <thead>
                        <tr>
                            <th class="text-center">An</th>
                            <th class="text-center">Betrag</th>
                            <th class="text-center">Verwendungszweck</th>
                            <th class="text-center">Datum</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::guard('account')->user()->transactionSender as $item)
                        <tr>
                            <td class="text-center">{{$item->Kontoinhaber}}</td>
                            <td class="text-center">{{$item->Betrag}} $</td>
                            <td class="text-center">{{$item->Verwendungszweck}}</td>
                            <td class="text-center">{{$item->Datum}}, {{$item->Uhrzeit}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection