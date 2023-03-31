@extends('layouts.admin.layout')

@section('content')
<div class="card">
    <div class="card-body">
        @if (session('errors'))
        <div class="alert alert-danger" role="alert">
            Los cambios se han guardado, pero se encontraron las siguientes novedades:
            <ul>
                @foreach (session('errors') as $error)
                <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @include('admin.partials.flash-success')
        <form action="{{ route('admin.horarios.update', $doctor) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="d-flex justify-content-between align-items-center">
                <h5>Horario del Dr. {{ $doctor->user->name }}</h5>
                <button type="submit" class="btn btn-primary" style="float: right">Guardar cambios</button>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="">
                        <th>Dia</th>
                        <th>Activo</th>
                        <th>Turno mañana</th>
                        <th>Turno tarde</th>
                    </thead>
                    <tbody>
                        @foreach ($horarios as $key => $horario)
                        <tr>
                            <th>{{ $dias[$key] }}</th>
                            <td>
                                <div>
                                    <label>
                                        <input type="checkbox" name="status[]" value="{{ $key }}"
                                        @if ($horario->status == 'SI') checked @endif />
                                    </label>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <select class="form-control" name="morning_start[]">
                                            @for ($i = 8; $i <= 12; $i++)
                                            <option value="{{ ($i < 10 ? '0' : '') . $i }}:00"
                                            @if (($i < 10 ? '0' : '') . $i . ':30' == $horario->morning_start) selected @endif>
                                            {{ $i }}:00 AM
                                        </option>
                                        <option value="{{ ($i < 10 ? '0' : '') . $i }}:30"
                                        @if (($i < 10 ? '0' : '') . $i . ':30' == $horario->morning_start) selected @endif>
                                        {{ $i }}:30 AM
                                    </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-control" name="morning_end[]">
                                    @for ($i = 8; $i <= 12; $i++)
                                    <option value="{{ ($i < 10 ? '0' : '') . $i }}:00"
                                    @if (($i < 10 ? '0' : '') .  $i . ':00' == $horario->morning_end) selected @endif>
                                    {{ $i }}:00 AM
                                </option>
                                <option value="{{ ($i < 10 ? '0' : '') . $i }}:30"
                                @if (($i < 10 ? '0' : '') . $i . ':30' == $horario->morning_end) selected @endif>
                                {{ $i }}:30 AM
                            </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </td>
            <td>
                <div class="row">
                    <div class="col">
                        <select class="form-control" name="afternoon_start[]">
                            @for ($i = 13; $i <= 20; $i++)
                            <option value="{{ $i }}:00"
                            @if ($i . ':00' == $horario->afternoon_start) selected @endif>
                            {{ $i }}:00 PM
                        </option>
                        <option value="{{ $i }}:30"
                        @if ( $i . ':30' == $horario->afternoon_start) selected @endif>
                        {{ $i }}:30 PM
                    </option>
                    @endfor
                </select>
            </div>
            <div class="col">
                <select class="form-control" name="afternoon_end[]">
                    @for ($i = 13; $i <= 20; $i++)
                    <option value="{{  $i }}:00"
                    @if ( $i . ':00' == $horario->afternoon_end) selected @endif>
                    {{ $i }}:00 PM
                </option>
                <option value="{{  $i }}:30"
                @if ( $i . ':30' == $horario->afternoon_end) selected @endif>
                {{ $i }}:30 PM
            </option>
            @endfor
        </select>
    </div>
</div>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</form>
</div>
</div>
@endsection

@section('styles')
<style>
    input[type="checkbox"] {
        position: relative;
        width: 40px;
        height: 20px;
        -webkit-appearance: none;
        background: #c6c6c6;
        outline: none;
        border-radius: 10px;
        box-shadow: inset 0 0 5px rgba(255, 0, 0, 0.2);
        transition: 0.7s;
    }

    input:checked[type="checkbox"] {
        background: #03a9f4;
    }

    input[type="checkbox"]:before {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 10px;
        top: 0;
        left: 0;
        background: #ffffff;
        transform: scale(1.1);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: .5s;
    }

    input:checked[type="checkbox"]:before {
        left: 20px;
    }
</style>
@endsection
