@extends('layouts.admin.layout')

@section('title', 'Detalle del usuario')

@section('content')
<div class="card">
    <div class="card-body">
        <h3>Datos del {{ auth()->user()->getRoleDisplayNames() }}</h3>
        <div class="row">
            <div class="col-md-12">
                @if(auth()->user()->image)
                <img src="{{ Storage::url( auth()->user()->image ) }}" alt="{{ auth()->user()->name  }}" height="150">
                @else
                <img src="{{ Avatar::create( auth()->user()->name )->toBase64() }}" width="150"/>
                @endif
                <div class="text-center">
                    <h5 class="mt-3">{{ auth()->user()->name }}</h5>
                </div>
                <div class="">
                    <h5 class="text-muted">Nombre</h5>
                    <h6 class="text-dark">{{ auth()->user()->name }}</h6>
                </div>
                <div class="">
                    <h5 class="text-muted">Email</h5>
                    <h6 class="text-dark">{{ auth()->user()->email }}</h6>
                </div>
                <div class="">
                    <h5 class="text-muted">Rol</h5>
                    <h6 class="text-dark">{{ auth()->user()->getRoleDisplayNames() }}</h6>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
