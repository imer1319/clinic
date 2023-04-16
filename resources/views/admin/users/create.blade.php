@extends('layouts.admin.layout')

@section('title', 'Registrar usuario')

@section('content')
<div class="mt-5">
    @include('admin.partials.flash-error')
</div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="text-center">Crear usuario</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @include('admin.users.partials._form', ['text' => 'Crear usuario'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
