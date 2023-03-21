@extends('layouts.admin.layout')

@section('title', 'Detalle del doctor')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="x_panel">
                <div class="x_title">
                    <div class="d-flex align-items-center">
                        <img src="{{ Storage::url($doctor->user->image) }}" alt="{{ $doctor->user->image }}" height="80">
                        <div class="ml-3 d-flex flex-column">
                            <h2>{{ $doctor->user->name }}</h2>
                            <p>{{ $doctor->nacimiento }} - {{ $edad }} años </p>
                        </div>
                    </div>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="d-flex justify-content-center">
                        <p class="pr-3">Genero</p>
                        <p>{{ $doctor->gender }}</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="pr-3">CI</p>
                        <p>{{ $doctor->ci }}</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="pr-3">Correo</p>
                        <p>{{ $doctor->user->email }}</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="pr-3">Celular</p>
                        <p>{{ $doctor->celular }}</p>
                    </div>
                    <div class="d-flex justify-content-center">
                        <p class="pr-3">Direccion</p>
                        <p>{{ $doctor->address }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-center mb-3">Mis citas medicas</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->doctor->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
