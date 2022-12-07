@extends('layouts.admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card px-3 border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>                        
                            <h5>Total usuarios</h5>
                            <h3>{{ $users }}</h3>
                        </div>
                        <h1><i class="fa fa-user"></i></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>                        
                            <h5>Total pacientes</h5>
                            <h3>{{ $patients }}</h3>
                        </div>
                        <h1><i class="fa fa-user"></i></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>                        
                            <h5>Total servicios</h5>
                            <h3>{{ $services }}</h3>
                        </div>
                        <h1><i class="fa fa-user"></i></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>                        
                            <h5>Total Doctores</h5>
                            <h3>{{ $doctors }}</h3>
                        </div>
                        <h1><i class="fa fa-user"></i></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <canvas id="patients-for-month" height="150px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <canvas id="patient_year" height="190px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5>Cuentas por cobrar</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Paciente</th>
                                <th>Doctor</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->id }}</td>
                                <td>{{ $appointment->patient->name }}</td>
                                <td>{{ $appointment->doctor->name }}</td>
                                <td>{{ $appointment->created_at }}</td>
                                <td>{{ $appointment->status }}</td>
                                <td>
                                    <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-success btn-sm">Pagar</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay deudas por pagar</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('admin/vendors/Chart.js/dist/Chart.min.js') }}"></script>
<script>
    let patientsForMonth = {
        labels: @json($meses),
        datasets: [{
            label: 'Pacientes',
            data: @json($patientMonth),
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgb(227, 34, 205, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgb(0, 113, 206, 0.2)',
            'rgba(240, 208, 225, 0.2)',
            'rgba(145, 116, 201, 0.2)',
            'rgba(80, 146, 169, 0.2)',
            'rgba(0, 0, 246, 0.2)',
            'rgba(247, 139, 5, 0.2)',
            'rgba(145, 0, 247, 0.2)',
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(227, 34, 205)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(0, 113, 206)',
            'rgb(240, 208, 225)',
            'rgb(145, 116, 201)',
            'rgb(80, 146, 169)',
            'rgb(0, 0, 246)',
            'rgb(247, 139, 5)',
            'rgb(145, 0, 247)',
            ],
            borderWidth: 1
        }]
    };
    let patientsForYear = {
        labels: @json($year),
        datasets: [{
            label: 'pacientes',
            data: @json($patientYear),
            backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgb(227, 34, 205, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
            'rgb(255, 99, 132)',
            'rgb(227, 34, 205)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(0, 113, 206)',
            ],
            borderWidth: 1
        }]
    };

    window.onload = function() {
        let ctx = document.getElementById("patients-for-month").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: patientsForMonth,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Pacientes registrados por mes'
                }
            }
        });
        let ctx_user = document.getElementById("patient_year").getContext("2d");
        window.myBar = new Chart(ctx_user, {
            type: 'bar',
            data: patientsForYear,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Pacientes registrados por año'
                }
            }
        });
    };
</script>
@endsection