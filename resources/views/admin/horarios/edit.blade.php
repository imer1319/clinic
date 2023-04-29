@extends('layouts.admin.layout')

@section('title', 'Registrar rol')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if(session('errors'))
        <div class="alert alert-danger" role="alert">
            Los cambios se han guardado, pero se encontraron las siguientes novedades
            <ul>
                @foreach(session('errors') as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if (session('flash'))
        <div class="alert alert-success" role="alert">
            {{ session('flash') }}
        </div>
        @endif
        <div class="card">
            <form action="{{ route('admin.horarios.update', $doctor) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="m-3 d-flex justify-content-between align-items-center">
                    <h5 class="text-center">Actualizar horarios del Dr. {{ $doctor->name }}</h5>
                    <button class="btn btn-primary" type="submit">Actualizar horario</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Dia</th>
                                <th>Activo</th>
                                <th>Turno mañana</th>
                                <th>Turno tarde</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horarios as $key => $horario)
                            <tr>
                                <td>{{ $dias[$key] }}</td>
                                <td>
                                    <input type="checkbox" name="active[]" value="{{ $key }}"
                                    @if($horario->active) checked @endif
                                    />
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <select name="morning_start[]" class="form-control">
                                                @for ($i = 6; $i <= 12; $i++)
                                                <option value="{{ ($i < 10 ? '0' : '') . $i }}:00" @if (($i < 10 ? '0' : '') . $i . ':00:00' == $horario->morning_start) selected @endif>
                                                {{ $i }}:00 AM</option>
                                                <option value="{{ ($i < 10 ? '0' : '') . $i }}:30" @if (($i < 10 ? '0' : '') . $i . ':30:00' == $horario->morning_start) selected @endif>
                                                {{ $i }}:30 AM</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="morning_end[]" class="form-control">
                                                @for ($i = 6; $i <= 12; $i++)
                                                <option value="{{ ($i < 10 ? '0' : '') . $i }}:00" @if (($i < 10 ? '0' : '') . $i . ':00:00' == $horario->morning_end) selected @endif>
                                                {{ $i }}:00 AM</option>
                                                <option value="{{ ($i < 10 ? '0' : '') . $i }}:30" @if (($i < 10 ? '0' : '') . $i . ':30:00' == $horario->morning_end) selected @endif>
                                                {{ $i }}:30 AM</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col">
                                            <select name="afternoon_start[]" class="form-control">
                                                @for ($i = 12; $i <= 18; $i++)
                                                <option value="{{ ($i < 10 ? '0' : '') . $i }}:00" @if (($i < 10 ? '0' : '') . $i . ':00:00' == $horario->afternoon_start) selected @endif>
                                                {{ $i }}:00 AM</option>
                                                <option value="{{ ($i < 10 ? '0' : '') . $i }}:30" @if (($i < 10 ? '0' : '') . $i . ':30:00' == $horario->afternoon_start) selected @endif>
                                                {{ $i }}:30 AM</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select name="afternoon_end[]" class="form-control">
                                                @for ($i = 12; $i <= 18; $i++)
                                                <option value="{{ ($i < 10 ? '0' : '') . $i }}:00" @if (($i < 10 ? '0' : '') . $i . ':00:00' == $horario->afternoon_end) selected @endif>
                                                {{ $i }}:00 AM</option>
                                                <option value="{{ ($i < 10 ? '0' : '') . $i }}:30" @if (($i < 10 ? '0' : '') . $i . ':30:00' == $horario->afternoon_end) selected @endif>
                                                {{ $i }}:30 AM</option>
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
        border-radius: 20px;
        box-shadow: inset 0 0 5px rgba(255, 0, 0, 0.2);
        transition: 0.5s;
    }

    input:checked[type="checkbox"] {
        background: #03a9f4;
    }

    input[type="checkbox"]:before {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        border-radius: 20px;
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
