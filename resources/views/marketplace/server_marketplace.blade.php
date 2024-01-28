@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Marktplatz - Angebote</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Marktplatz</li>
        <li class="breadcrumb-item active">Angebote</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Marktplatz - Angebote</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Angebot von</th>
                    <th class="text-center">Erstellt am</th>
                    <th class="text-center">Typ</th>
                    <th class="text-center">Angebotstyp</th>
                    <th class="text-center">Info</th>
                    <th class="text-center">Ende</th>
                    <th class="text-center">Gebote</th>
                    <td class="text-center">Aktion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($offers as $item)
                <tr>
                    <td class="text-center"><span>{{$item->id}}</span></td>
                    <td class="text-center">
                        @if($item->userId == -1)
                        <span class="badge badge-secondary">SERVER</span>
                        @else
                        <span class="badge badge-primary">{{$item->player->Name}}</span>
                        @endif
                    </td>
                    <td class="text-center"><span>{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y, H:i')}}</span></td>
                    <td class="text-center">
                        @if($item->goodsType == 0)
                        <span><a rel="popover" data-img="{{asset('images/vehicles/Vehicle_'.$item->goodsId.'.jpg')}}">{{App\Http\Controllers\MarketplaceController::goodsType($item->goodsType)}}</a></span>
                        @else
                        <span>{{App\Http\Controllers\MarketplaceController::goodsType($item->goodsType)}}</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->offerType)
                        <span class="badge badge-primary">SOFORTKAUF</span>
                        @else
                        <span class="badge badge-primary">BIETEN</span>
                        @endif
                    </td>
                    <td class="text-center">
                        @if($item->offerType)
                        <span>Sofortkauf: {{$item->buyNow}}</span>
                        @else
                        <ul>
                            <li class="list-group list-group-unbordered"><span>Sofortkauf: {{$item->buyNow}} $</span></li>
                            <li class="list-group list-group-unbordered"><span>Startgebot: {{$item->biddingStart}} $</span></li>
                            <li class="list-group list-group-unbordered"><span>Bietschritte: {{$item->biddingSteps}} $</span></li>
                        </ul>
                        @endif
                    </td>
                    <td class="text-center"><span>{{\Carbon\Carbon::parse($item->endDate)->format('d.m.Y, H:i')}}</span></td>
                    <td class="text-center"><span>{{$item->bidding->count()}}</span></td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="#" data-toggle="tooltip" data-placement="left" title="Angebot einsehen"><i class="fa fa-folder-open"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$offers->links()}}
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

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
});
</script>
@endsection