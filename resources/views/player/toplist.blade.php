@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Topliste</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Topliste</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Meisten Paintball-Kills</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Anzahl</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mostKills as $item)
                        <tr>
                            <td class="text-center"><span class="badge badge-primary">{{$item->Name}}</span></td>
                            <td class="text-center"><span>{{$item->PBKills}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Meisten Paintball-Tode</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Anzahl</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mostDeaths as $item)
                        <tr>
                            <td class="text-center"><span class="badge badge-primary">{{$item->Name}}</span></td>
                            <td class="text-center"><span>{{$item->PBTode}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Höchstes Level</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($highestLevel as $item)
                        <tr>
                            <td class="text-center"><span class="badge badge-primary">{{$item->Name}}</span></td>
                            <td class="text-center"><span>{{$item->Level}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection