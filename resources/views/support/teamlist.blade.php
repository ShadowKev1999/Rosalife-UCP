@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Teamübersicht</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Support</li>
        <li class="breadcrumb-item active">Teamübersicht</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="row">
    @foreach($teamList as $item)
    <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-header text-muted border-bottom-0">
                {{App\Http\Controllers\AdminController::getAdminName($item->Admin)}}
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col-7">
                        <h2 class="lead"><b>{{$item->Name}}</b></h2>
                        <p class="text-muted text-sm"><b>Online: </b> @if($item->Online)<i class="fas fa-circle text-success"></i>@else <i class="fas fa-circle text-danger"></i> @endif</p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-book"></i></span> Level: {{$item->Level}}</li>
                            <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Handy: @if($item->Handy) {{$item->Handy}} @else {{'-'}} @endif</li>
                        </ul>
                    </div>
                    <div class="col-5 text-center">
                        <img src="{{asset('images/skins-avatar/'.$item->SkinID.'.png')}}" alt="user-avatar" class="img-circle img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection