@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Server Feed</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Server Feed</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="row">
    <div class="col-sm-6">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Server Feed</h5>
            </div>
            <div class="card-body">
                <div class="timeline timeline-inverse">
                    @foreach($timelineData as $item)
                    @if ($loop->first)
                    <div class="time-label">
                        <span class="bg-danger">{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</span>
                    </div>
                    @php
                    $dateItem = \Carbon\Carbon::parse($item->created_at)->format('d.m.Y');
                    @endphp
                    @else
                        @if($dateItem != \Carbon\Carbon::parse($item->created_at)->format('d.m.Y'))
                            @php
                            $dateItem = \Carbon\Carbon::parse($item->created_at)->format('d.m.Y');
                            @endphp
                        <div class="time-label">
                            <span class="bg-danger">{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y')}}</span>
                        </div>
                        @endif
                    @endif
                    <div>
                        <i class="fas {{App\Http\Controllers\PlayerController::getServerFeedIcon($item->tagId)}} bg-primary"></i>
                        <div class="timeline-item">
                            <span class="time"><i class="far fa-clock"></i> {{\Carbon\Carbon::parse($item->created_at)->format('H:i')}}</span>
                            <h3 class="timeline-header">
                                @if($item->userId != -1)
                                <span class="badge badge-primary">{{$item->userData->Name}}</span>
                                @else
                                <span class="badge badge-secondary">SERVER</span>
                                @endif
                            </h3>
                            <div class="timeline-body">
                                {{$item->description}}
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div>
                        <i class="far fa-clock bg-gray"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <h5>Spieler auf dem Gameserver</h5>
            </div>
            <div class="card-body">
                @if($onlinePlayers->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Name</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($onlinePlayers as $item)
                        <tr>
                            <td class="text-center"><span class="badge badge-primary">{{$item->Name}}</span></td>
                            <td class="text-center"><span>{{App\Http\Controllers\PlayerController::getAdminName($item->Admin)}}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-secondary" role="alert">
                    Derzeit befindet sich kein Spieler auf dem Gameserver.
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection