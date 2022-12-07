@extends('layouts.admin.layout')

@section('title', 'Registrar paciente')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Crear paciente</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash-error')
                    <form action="{{ route('admin.patients.store') }}" method="POST" enctype="multipart/form-data">
                        @include('admin.patients.partials._form', ['text' => 'Crear paciente'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
