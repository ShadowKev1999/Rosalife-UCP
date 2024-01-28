@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Dashboard</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $users }}</h3>
                <p>Registrierte Spieler</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $vehicles }}</h3>
                <p>Fahrzeuge</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-car"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $houses }}</h3>
                <p>Häuser</p>
            </div>
            <div class="icon">
                <i class="ion ion-home"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $factions }}</h3>
                <p>Fraktionen</p>
            </div>
            <div class="icon">
                <i class="ion ion-android-archive"></i>
            </div>
        </div>
    </div>
</div>
<div class="card card-outline card-primary">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                     <h5 class="description-header">{{$playerRecord->Rekord}}</h5>
                    <span class="description-text">SPIELER REKORD</span>
                </div>
            </div>

            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <h5 class="description-header">{{$bannedPlayers}}</h5>
                    <span class="description-text">GEBANNTE SPIELER</span>
                </div>
            </div>

            <div class="col-sm-3 col-6">
                <div class="description-block border-right">
                    <h5 class="description-header">{{$robberies}}</h5>
                    <span class="description-text">RAUB ÜBERFÄLLE</span>
                </div>
            </div>

            <div class="col-sm-3 col-6">
                <div class="description-block">
                    <h5 class="description-header">{{$serverIncidents}}</h5>
                    <span class="description-text">SERVER EREIGNISSE</span>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrationen</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    {!! $chart->container() !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Spielerverteilung bei Fraktionen</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    {!! $chart2->container() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
</div>
@endsection
@section('custom-footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart->script() !!}
{!! $chart2->script() !!}
@endsection