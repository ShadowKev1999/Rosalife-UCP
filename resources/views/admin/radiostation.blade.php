@extends('layouts.master')
@section('header_content')
<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0 text-secondary">Radiosender</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item">Administration</li>
        <li class="breadcrumb-item active">Radiosender</li>
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('main_content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
        <h5>Radiosender</h5>
    </div>
    <div class="card-tools">
        <button type="button" class="btn btn-success btn-sm m-2" data-toggle="modal" data-target="#modal-add-radio">Hinzufügen</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Farbe</th>
                    <th class="text-center">Url</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aktion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($radioStations as $item)
                <tr>
                    <td class="text-center"><span class="badge badge-primary">{{$item->radioName}}</span></td>
                    <td class="text-center"><i class="fas fa-circle" style="color:#{{Illuminate\Support\Str::between($item->radioColor, '{', '}')}}"></i></td>
                    <td class="text-center"><span>{{$item->radioUrl}}</span></td>
                    <td class="text-center">
                        @if($item->radioActive)
                        <a href="{{route('radiostation_active', $item->id)}}"><span class="badge badge-success">aktiviert</span></a>
                        @else
                        <a href="{{route('radiostation_active', $item->id)}}"><span class="badge badge-danger">deaktiviert</span></a>
                        @endif
                    </td>
                    <td class="text-center">
                        <a class="btn btn-danger btn-sm" href="{{route('radiostation_delete', $item->id)}}"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal-add-radio">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Radiosender hinzufügen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{route('radiostation_post')}}">
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
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name des Senders">
                    </div>
                    <div class="form-group">
                        <label for="url">Url</label>
                        <input type="text" class="form-control" id="url" name="url" placeholder="URL des Senders">
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