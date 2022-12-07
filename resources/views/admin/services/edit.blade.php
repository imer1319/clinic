@extends('layouts.admin.layout')

@section('title', 'Editar servicio')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Editar servicio</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash-error')
                    <form action="{{ route('admin.services.update', $service) }}" method="POST">
                        @method('PUT')
                        @include('admin.services.partials._form', ['text' => 'Actualizar servicio'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
