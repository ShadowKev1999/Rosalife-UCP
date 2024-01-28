@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Immobilien - Ammunations</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Immobilien - Ammunations</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Immobilien - Ammunations</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Besitzer</th>
                    <th class="text-center">Preis</th>
                    <th class="text-center">Position</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ammunations as $item)
                <tr>
                    <td class="text-center"><span>{{$item->ID}}</span></td>
                    <td class="text-center">
                        @if(\Illuminate\Support\Str::length($item->Besitzer) > 2)
                        <span class="badge badge-primary">{{$item->Besitzer}}</span>
                        @else
                        <span class="badge badge-secondary">Staat</span>
                        @endif
                    </td>
                    <td class="text-center"><span>{{$item->Preis}} $</span></td>
                    <td class="text-center"><span>{{$item->Pos_X}}, {{$item->Pos_Y}}, {{$item->Pos_Z}}</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$ammunations->links()}}
    </div>
</div>
@endsection