@extends('layouts.admin.layout')

@section('title', 'Editar rol')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Editar rol</h5>
                </div>
                <div class="card-body">
                    @include('admin.partials.flash-error')
                    <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                        @method('PUT')
                        @include('admin.roles.partials._form', ['text' => 'Actualizar rol'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
