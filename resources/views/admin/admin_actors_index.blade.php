@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Server Actors</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Server Actors</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Server Actors</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Koordinaten</th>
                    <th class="text-center">Skin</th>
                    <th class="text-center">Animation</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serverActors as $item)
                <tr>
                    <td class="text-center"><span>{{$item->id}}</span></td>
                    <td class="text-center"><span>{{$item->name}}</span></td>
                    <td class="text-center"><span>{{$item->x}}, {{$item->y}}, {{$item->z}}, {{$item->a}}</span></td>
                    <td class="text-center"><span><a rel="popover" data-img="{{asset('images/skins-avatar/'.$item->skin.'.png')}}">{{$item->skin}}</a></span></td>
                    <td class="text-center"><span>{{App\Http\Controllers\AdminController::getActorAnimationName($item->animation)}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$serverActors->links()}}
    </div>
</div>
@endsection

@section('custom-footer-scripts')
<script>
$('a[rel=popover]').popover({
    boundary:'window',
    html: true,
    trigger: 'hover',
    placement: 'bottom',
    content: function(){return '<img src="'+$(this).data('img') + '" />';}
});
</script>
@endsection