@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Entbannungsantrag</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Entbannungsantrag</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-primary card-outline direct-chat direct-chat-primary">
            <div class="card-header text-center">
                <h5>Entbannungsantrag</h5>
            </div>
            <div class="card-body">
                <div class="direct-chat-messages">
                    @foreach($banDetails->comments as $item)
                    <div class="direct-chat-msg {{ $loop->even ? 'right' : '' }}">
                        <div class="direct-chat-infos clearfix">
                            <span class="direct-chat-name {{ $loop->even ? 'float-left' : 'float-right' }}">{{$item->userData->Name}}</span>
                            <span class="direct-chat-timestamp {{ $loop->even ? 'float-right' : 'float-left' }}">{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y, H:i')}}</span>
                        </div>
                        <img class="direct-chat-img" src="{{asset('images/skins-avatar/'.$item->userData->SkinID.'.png')}}" alt="Message User Image">

                        <div class="direct-chat-text">
                            {{$item->commentText}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <form action="{{route('unban_request_post')}}" method="post">
                    @csrf
                    <input type="hidden" id="banId" name="banId" value="{{$banDetails->ID}}">
                    <div class="input-group">
                        <input type="text" name="commentText" id="commentText" placeholder="Nachricht" class="form-control">
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-primary">Absenden</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-widget widget-user-2">
            <div class="widget-user-header bg-danger">
                <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{asset('images/skins-avatar/'.Auth::guard('account')->user()->SkinID.'.png')}}" alt="User Avatar">
                </div>
                <h3 class="widget-user-username">{{Auth::guard('account')->user()->Name}}</h3>
                <h5 class="widget-user-desc">Ban Informationen</h5>
            </div>
            <div class="card-footer p-0">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Teammitglied <span class="float-right badge bg-primary">{{$banDetails->Teammitglied}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Grund <span class="float-right badge bg-danger">{{$banDetails->Bangrund}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Datum <span class="float-right badge bg-warning">{{$banDetails->Datum}}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            Uhrzeit <span class="float-right badge bg-info">{{$banDetails->Uhrzeit}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection