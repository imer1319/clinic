@extends('layouts.admin.layout')

@section('title', 'Registrar rol')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Crear doctor</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash-error')
                    <form action="{{ route('admin.doctors.store') }}" method="POST" enctype="multipart/form-data">
                        @include('admin.doctors.partials._form', ['text' => 'Crear doctor'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
