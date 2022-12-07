@extends('layouts.admin.layout')

@section('title', 'Editar doctor')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Editar doctor</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash-error')
                    <form action="{{ route('admin.doctors.update', $doctor) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @include('admin.doctors.partials._form', ['text' => 'Actualizar doctor'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
