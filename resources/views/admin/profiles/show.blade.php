@extends('layouts.admin.layout')

@section('title', 'Detalle del usuario')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 border-right">
                @if(auth()->user()->profile->image)
                <img src="{{ Storage::url( auth()->user()->profile->image ) }}" alt="{{ auth()->user()->name  }}" height="150">
                @else
                <img src="{{ Avatar::create( auth()->user()->name )->toBase64() }}" width="150"/>
                @endif
                <div class="mt-3">
                    <h5 class="text-muted"><b>Nombre:</b> {{ auth()->user()->name }}</h5>
                    <h5 class="text-muted"><b>Apellidos: </b>{{ auth()->user()->profile->surnames }}</h5>
                    <h5 class="text-muted"><b>Email: </b>{{ auth()->user()->email }}</h5>
                    @if(!auth()->user()->hasRole('Paciente'))
                    <h5 class="text-muted"><b>Rol: </b>{{ auth()->user()->getRoleDisplayNames() }}</h5>
                    @endif
                </div>
                @can('profiles_edit')
                <div>
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-warning"><i class="fa fa-edit"></i> Editar perfil</a>
                </div>
                @endcan
            </div>
            <div class="col-md-6">
                <h5 class="text-muted"><b>Ci:</b> {{ auth()->user()->profile->ci }}</h5>
                <h5 class="text-muted"><b>Fecha de nacimiento: </b>{{ auth()->user()->profile->nacimiento }}</h5>
                <h5 class="text-muted"><b>Celular: </b>{{ auth()->user()->profile->celular }}</h5>
                <h5 class="text-muted"><b>Direccion: </b>{{ auth()->user()->profile->address }}</h5>
                <h5 class="text-muted"><b>Genero: </b>{{ auth()->user()->profile->gender }}</h5>
                @if(auth()->user()->hasRole('Doctor'))
                <h5 class="text-muted"><b>Especialidad: </b>{{ auth()->user()->profile->specialty->description }}</h5>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
