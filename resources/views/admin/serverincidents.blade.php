@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Serverereignisse</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Serverereignisse</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Serverereignisse</h5>
    </div>
    <div class="card-tools">
        <button type="button" class="btn btn-success btn-sm m-2" data-toggle="modal" data-target="#modal-add-incicent">Hinzufügen</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 10px">#</th>
                    <th class="text-center">Titel</th>
                    <th class="text-center">Beschreibung</th>
                    <th class="text-center">Job</th>
                    <th class="text-center">Fraktion</th>
                    <th class="text-center">Spielerlevel</th>
                    <th class="text-center">Menge</th>
                    <th class="text-center">Minuten</th>
                    <th class="text-center">Aktion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($serverIncidents as $item)
                <tr>
                    <td class="text-center" style="width: 10px"><span>{{$item->id}}</span></td>
                    <td class="text-center"><span class="badge badge-primary">{{$item->title}}</span></td>
                    <td class="text-center"><span>{{$item->description}}</span></td>
                    <td class="text-center"><span>{{App\Http\Controllers\AdminController::getJobName($item->jobId)}}</span></td>
                    <td class="text-center"><span>{{App\Http\Controllers\AdminController::getFactionName($item->factionId)}}</span></td>
                    <td class="text-center"><span>{{$item->playerLevel}}</span></td>
                    <td class="text-center"><span>{{$item->amount}}</span></td>
                    <td class="text-center"><span>{{$item->minutes}}</span></td>
                    <td class="text-center">
                        <a class="btn btn-danger btn-sm" href="{{route('serverincidents_delete', $item->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$serverIncidents->links()}}
    </div>
</div>

<div class="modal fade" id="modal-add-incicent">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Serverereignis hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('serverincidents_post')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titel</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Titel eingeben">
                    </div>
                    <div class="form-group">
                        <label>Beschreibung</label>
                        <textarea class="form-control" rows="5" placeholder="Beschreibung eingeben" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Job</label>
                        <select class="form-control" name="jobId" id="jobId">
                            <option value="0">Keiner</option>
                            <option value="1">Trucker</option>
                            <option value="2">Pizzabote</option>
                            <option value="3">KM-Fahrer</option>
                            <option value="4">Pilot</option>
                            <option value="5">Busfahrer</option>
                            <option value="6">Muellmann</option>
                            <option value="7">Landwirt</option>
                            <option value="8">D-</option>
                            <option value="9">W-</option>
                            <option value="10">Geldlieferant</option>
                            <option value="11">Elektriker</option>
                            <option value="12">Drogendealer</option>
                            <option value="13">Waffendealer</option>
                            <option value="14">Zugfahrer</option>
                            <option value="15">Detektiv</option>
                            <option value="16">Langstreckenfahrer</option>
                            <option value="17">Fluglieferant</option>
                            <option value="18">Hochseefischer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fraktion</label>
                        <select class="form-control" name="factionId" id="factionId">
                            <option value="0">Keine</option>
                            <option value="1">Regierung</option>
                            <option value="2">Los Santos Polizei</option>
                            <option value="3">Central Defensive Marshallas Service</option>
                            <option value="4">Feuerwehr</option>
                            <option value="5">Rettungsdienst</option>
                            <option value="6">Federal Bureau of Investigation</option>
                            <option value="7">San Andreas Ordnungsamt</option>
                            <option value="8">San News</option>
                            <option value="9">Grove Street Families</option>
                            <option value="10">Rolling High Ballas</option>
                            <option value="11">Los Santos Vagos</option>
                            <option value="12">Los Aztecas</option>
                            <option value="13">San Fierro Rifa</option>
                            <option value="14">Triaden</option>
                            <option value="15">Yakuza</option>
                            <option value="16">Camorra</option>
                            <option value="17">La Cosa Nostra</option>
                            <option value="18">Russian Mafia</option>
                            <option value="19">International Contract Agency</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="playerLevel">Spielerlevel</label>
                        <input type="number" class="form-control" id="playerLevel" name="playerLevel" placeholder="ab Spielerlevel">
                    </div>
                    <div class="form-group">
                        <label for="amount">Anzahl zum Erfüllen des Ereignis</label>
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="Anzahl">
                    </div>
                    <div class="form-group">
                        <label for="minutes">Ereignisdauer</label>
                        <input type="number" class="form-control" id="minutes" name="minutes" placeholder="Dauer des Ereignis (in Minuten)">
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