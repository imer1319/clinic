@extends('layouts.admin.layout')

@section('title', 'Registrar servicio')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Crear servicio</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash-error')
                    <form action="{{ route('admin.services.store') }}" method="POST">
                        @include('admin.services.partials._form', ['text' => 'Crear servicio'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
