@extends('layouts.admin.layout')

@section('title', 'Detalle del usuario')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 border-right">
                @if($user->profile->image)
                <img src="{{ Storage::url( $user->profile->image ) }}" alt="{{ $user->name  }}" height="150">
                @else
                <img src="{{ Avatar::create( $user->name )->toBase64() }}" width="150"/>
                @endif
                <div class="mt-3">
                    <h5 class="text-muted"><b>Nombre:</b> {{ $user->name }}</h5>
                    <h5 class="text-muted"><b>Apellidos: </b>{{ $user->profile->surnames }}</h5>
                    <h5 class="text-muted"><b>Email: </b>{{ $user->email }}</h5>
                    <h5 class="text-muted"><b>Rol: </b>{{ $user->getRoleDisplayNames() }}</h5>
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="text-muted"><b>Ci:</b> {{ $user->profile->ci }}</h5>
                <h5 class="text-muted"><b>Fecha de nacimiento: </b>{{ $user->profile->nacimiento }}</h5>
                <h5 class="text-muted"><b>Edad: </b>{{ $edad }} años</h5>
                <h5 class="text-muted"><b>Celular: </b>{{ $user->profile->celular }}</h5>
                <h5 class="text-muted"><b>Direccion: </b>{{ $user->profile->address }}</h5>
                <h5 class="text-muted"><b>Genero: </b>{{ $user->profile->gender }}</h5>
                @if($user->hasRole('Doctor'))
                <h5 class="text-muted"><b>Especialidad: </b>{{ $user->profile->specialty ? $user->profile->specialty->description : ''}}</h5>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
