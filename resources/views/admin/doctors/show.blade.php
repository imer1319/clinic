@extends('layouts.admin.layout')

@section('title', 'Detalle del doctor')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    @if($user->profile->image)
                    <img src="{{ Storage::url( $user->profile->image ) }}" alt="{{ $user->name  }}" height="80">
                    @else
                    <img src="{{ Avatar::create( $user->name )->toBase64() }}" width="80"/>
                    @endif
                    <div class="ml-3 d-flex flex-column">
                        <h2>{{ $user->name }}</h2>
                        <p>{{ $user->nacimiento }} - {{ $edad }} años </p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="mt-3">
                        <h5 class="text-muted"><b>Nombre:</b> {{ $user->name }}</h5>
                        <h5 class="text-muted"><b>Apellidos: </b>{{ $user->profile->surnames }}</h5>
                        <h5 class="text-muted"><b>Email: </b>{{ $user->email }}</h5>
                        <h5 class="text-muted"><b>Rol: </b>{{ $user->getRoleDisplayNames() }}</h5>
                        <h5 class="text-muted"><b>Ci:</b> {{ $user->profile->ci }}</h5>
                        <h5 class="text-muted"><b>Nacimiento: </b>{{ $user->profile->nacimiento }}</h5>
                        <h5 class="text-muted"><b>Celular: </b>{{ $user->profile->celular }}</h5>
                        <h5 class="text-muted"><b>Direccion: </b>{{ $user->profile->address }}</h5>
                        <h5 class="text-muted"><b>Genero: </b>{{ $user->profile->gender }}</h5>
                        <h5 class="text-muted"><b>Especialidad: </b>{{ $user->profile->specialty ? $user->profile->specialty->description : '' }}</h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h5 class="text-center mb-3">Proximas citas medicas</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($diaries as $diary)
                        <tr>
                            <td width="10">{{ $loop->iteration }}</td>
                            <td>{{ $diary->patient->name }} {{ $diary->patient->profile->surnames }}</td>
                            <td>{{ $diary->date_cita->format('M d') }}</td>
                            <td>{{ $diary->hora_cita->format('H:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <h5 class="text-center mb-3">Ultimas consultas realizadas</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Paciente</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($consultations as $consultation)
                        <tr>
                            <td width="10">{{ $loop->iteration }}</td>
                            <td>{{ $consultation->patient->name }} {{ $consultation->patient->profile->surnames }}</td>
                            <td>{{ $consultation->created_at->format('d M Y') }}</td>
                            <td>{{ $consultation->created_at->format('H:i A') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No hay data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
