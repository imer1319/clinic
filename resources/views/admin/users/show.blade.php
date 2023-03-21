@extends('layouts.admin.layout')

@section('title', 'Detalle del usuario')

@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h4>Datos del usuario</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="text-center">
                        <img src="{{ Storage::url($user->image) }}" alt="{{ $user->image }}" height="80">
                        <h5 class="mt-3">{{ $user->name }}</h5>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="text-muted">Nombre</h5>
                            <h6 class="text-dark">{{ $user->name }}</h6>
                        </div>
                        <div class="col-4">
                            <h5 class="text-muted">Email</h5>
                            <h6 class="text-dark">{{ $user->email }}</h6>
                        </div>
                        <div class="col-4">
                            <h5 class="text-muted">Rol</h5>
                            <h6 class="text-dark">{{ $user->getRoleDisplayNames() }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
