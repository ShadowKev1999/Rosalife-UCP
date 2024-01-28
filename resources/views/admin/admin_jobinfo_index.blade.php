@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Job-Informationen</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Job-Informationen</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Job-Informationen</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Gehalt</th>
                    <th class="text-center">EXP</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobInfos as $item)
                <tr>
                    <td class="text-center"><span>{{$item->ID}}</span></td>
                    <td class="text-center"><span>{{$item->jobName}}</span></td>
                    <td class="text-center"><span>{{$item->Gehalt}} $</span></td>
                    <td class="text-center"><span>{{$item->EXP}} Exp</span></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$jobInfos->links()}}
    </div>
</div>
@endsection