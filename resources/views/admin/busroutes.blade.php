@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Busrouten</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Busrouten</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="row">
    <div class="col-12">
        <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Anmerkung:</h5>
                Alle Busrouten können individuell gestaltet und angepasst werden. Es können maximal 20 Busrouten mit jeweils 15 Checkpoints erstellt werden.
                Eine Busroute muss mindestens aus 2 und maximal aus 15 Checkpoints bestehen. Die Anzahl kann variieren. Pro Route erhält ein Busfahrer automatisch
                sein Grundgehalt und dem für die jeweilige Route eingestellte Bonus. Desweiteren erhält ein Busfahrer pro Route ein EXP und dem zusätzlichen Bonus-EXP.
        </div>
    </div>
</div>
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Busrouten</h5>
    </div>
    <div class="card-tools">
        <button type="button" class="btn btn-success btn-sm m-2" data-toggle="modal" data-target="#modal-add-busroute">Hinzufügen</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Farbe</th>
                    <th class="text-center">Skill</th>
                    <th class="text-center">Bonus-Geld</th>
                    <th class="text-center">Bonus-Job-Exp</th>
                    <th class="text-center">Checkpoints</th>
                    <th class="text-center">Aktion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($busRoutes as $item)
                <tr>
                    <td class="text-center"><span class="badge badge-primary">{{$item->name}}</span></td>
                    <td class="text-center"><i class="fas fa-circle" style="color:#{{$item->color}}"></i></td>
                    <td class="text-center"><span>{{$item->skill}}</span></td>
                    <td class="text-center"><span>{{$item->bonusmoney}} $</span></td>
                    <td class="text-center"><span>{{$item->jobexpbonus}} Exp</span></td>
                    <td class="text-center"><span>{{$item->checkpoints->count()}} CPs</span></td>
                    <td class="text-center">
                        <a class="btn btn-warning btn-sm" href="{{route('busroutes_details', $item->id)}}"><i class="fa fa-edit"></i></a>
                        <a class="btn btn-danger btn-sm" href="{{route('busroutes_delete', $item->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{$busRoutes->links()}}
    </div>
</div>

<div class="modal fade" id="modal-add-busroute">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Busroute hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('busroutes_post')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="color">Farbe</label>
                        <div class="input-group colorpicker_form">
                            <input type="text" id="color" name="color" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-square"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name der Busroute">
                    </div>
                    <div class="form-group">
                        <label for="skill">Skill</label>
                        <input type="number" class="form-control" id="skill" name="skill" placeholder="ab Skill">
                    </div>
                    <div class="form-group">
                        <label for="bonusmoney">Bonus-Geld</label>
                        <input type="number" class="form-control" id="bonusmoney" name="bonusmoney" placeholder="Geld-Bonus für diese Busroute">
                    </div>
                    <div class="form-group">
                        <label for="jobexpbonus">Bonus-Job-Exp</label>
                        <input type="number" class="form-control" id="jobexpbonus" name="jobexpbonus" placeholder="Job-Exp-Bonus für diese Busroute">
                    </div>
                    <div class="form-group">
                        <label for="busRouteCps">Checkpoints der Busroute</label>
                        <textarea class="form-control" rows="5" placeholder="Eingabe der Koordinaten" id="busRouteCps" name="busRouteCps"></textarea>
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

@section('custom-header-scripts')
<link rel="stylesheet" href="{{asset('js/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')}}">
@endsection

@section('custom-footer-scripts')
<script src="{{asset('js/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<script>
  $(function () {
    $('.colorpicker_form').colorpicker()

    $('.colorpicker_form').on('colorpickerChange', function(event) {
      $('.colorpicker_form .fa-square').css('color', event.color.toString());
    })

  })
</script>
@endsection