@extends('layouts.admin.layout')

@section('title', 'Editar paciente')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Editar paciente</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash-error')
                    <form action="{{ route('admin.patients.update', $patient) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.patients.partials._form', ['text' => 'Actualizar paciente'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
