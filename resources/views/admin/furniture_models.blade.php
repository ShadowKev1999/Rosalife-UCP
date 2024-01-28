@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Möbel-Model</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Möbel-Model</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Möbel-Model zu {{$furnitureCategory->name}}</h5>
    </div>
    <div class="card-tools">
        <button type="button" class="btn btn-success btn-sm m-2" data-toggle="modal" data-target="#modal-add-model">Hinzufügen</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Model ID</th>
                    <th class="text-center">Gewicht in Kg</th>
                    <th class="text-center">Preis</th>
                    <th class="text-center">Aktion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($furnitureCategory->models as $item)
                <tr>
                    <td class="text-center"><span>{{$item->id}}</span></td>
                    <td class="text-center"><span class="badge badge-primary">{{$item->name}}</span></td>
                    <td class="text-center"><span>{{$item->modelid}}</span></td>
                    <td class="text-center"><span>{{$item->weight}} Kg</span></td>
                    <td class="text-center"><span>{{$item->price}} $</span></td>
                    <td class="text-center">
                        <a class="btn btn-danger btn-sm" href="{{route('furniture_model_delete', $item->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-add-model">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Möbel-Model hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('furniture_model_post')}}">
                @csrf
                <input type="hidden" id="catalogid" name="catalogid" value="{{$furnitureCategory->id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name des Models">
                    </div>
                    <div class="form-group">
                        <label for="modelid">Model ID</label>
                        <input type="number" class="form-control" id="modelid" name="modelid" placeholder="Objekt ID des Models">
                    </div>
                    <div class="form-group">
                        <label for="weight">Gewicht in Kg</label>
                        <input type="number" step="0.01" class="form-control" id="weight" name="weight" placeholder="Gewicht in Kg (z.B. 0.2 kg)">
                    </div>
                    <div class="form-group">
                        <label for="price">Preis</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Verkaufswert des Models">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-success">Hinzufügen</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection