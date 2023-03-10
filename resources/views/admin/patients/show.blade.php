@extends('layouts.admin.layout')

@section('title', 'Detalle del paciente')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <div class="text-center">
                        @if ($patient->image)
                            <img src="{{ Storage::url($patient->image->image) }}" alt="{{ $patient->image->image }}"
                                width="200">
                        @else
                            <span>No tiene imagen</span>
                        @endif
                    </div>
                    <h5 class="text-center mt-3">{{ $patient->name }} {{ $patient->surnames }}</h5>
                    <h5 class="text-center mt-3">CI: {{ $patient->ci }}</h5>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-4">
                            <h5 class="text-muted">Genero</h5>
                            <h6 class="text-dark">{{ $patient->gender }}</h6>
                        </div>
                        <div class="col-4">
                            <h5 class="text-muted">Fecha de nacimiento</h5>
                            <h6 class="text-dark">{{ $patient->nacimiento }}</h6>
                        </div>
                        <div class="col-4">
                            <h5 class="text-muted">Telefono</h5>
                            <h6 class="text-dark">{{ $patient->phone }}</h6>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <h5 class="text-muted">Peso</h5>
                            <h6 class="text-dark">{{ $patient->peso }}</h6>
                        </div>
                        <div class="col-4">
                            <h5 class="text-muted">Altura</h5>
                            <h6 class="text-dark">{{ $patient->altura }}</h6>
                        </div>
                        <div class="col-4">
                            <h5 class="text-muted">Presion</h5>
                            <h6 class="text-dark">{{ $patient->presion }}</h6>
                        </div>
                        <div class="col-12">
                            <h5 class="text-muted">Direccion</h5>
                            <h6 class="text-dark">{{ $patient->address }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha</th>
                                <th>Medico</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($patient->appointments as $appointment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ Carbon\Carbon::parse($appointment->start)->format('d-m-Y') }}
                                    </td>
                                    <td>{{ $appointment->doctor->name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="3">No tiene registradas citas
                                        medicas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <ul class="list-unstyled timeline">
                        <li>
                            <div class="block">
                                <div class="tags bg-primary">clear
                                    <a href="" class="tag">
                                        <span>Entertainment</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                    </h2>
                                    <div class="byline">
                                        <span>13 hours ago</span> by <a>Jane Smith</a>
                                    </div>
                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They
                                        were where you met the producers that could fund your project, and if the buyers
                                        liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="" class="tag">
                                        <span>Entertainment</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                    </h2>
                                    <div class="byline">
                                        <span>13 hours ago</span> by <a>Jane Smith</a>
                                    </div>
                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They
                                        were where you met the producers that could fund your project, and if the buyers
                                        liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="" class="tag">
                                        <span>Entertainment</span>
                                    </a>
                                </div>
                                <div class="block_content">
                                    <h2 class="title">
                                        <a>Who Needs Sundance When You’ve Got&nbsp;Crowdfunding?</a>
                                    </h2>
                                    <div class="byline">
                                        <span>13 hours ago</span> by <a>Jane Smith</a>
                                    </div>
                                    <p class="excerpt">Film festivals used to be do-or-die moments for movie makers. They
                                        were where you met the producers that could fund your project, and if the buyers
                                        liked your flick, they’d pay to Fast-forward and… <a>Read&nbsp;More</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="mt-3">
                        <a href="{{ route('admin.patients.index') }}" class="btn btn-dark">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
