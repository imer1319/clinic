@extends('layouts.admin.layout')

@section('title', 'Detalle de la cita')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="text-center">Cita medica</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Fecha</th>
                                    <td>{{ $appointment->start }}</td>
                                </tr>
                                <tr>
                                    <th>Paciente</th>
                                    <td>{{ $appointment->patient->name }}</td>
                                </tr>
                                <tr>
                                    <th>Doctor</th>
                                    <td>{{ $appointment->doctor->name }}</td>
                                </tr>
                                <tr>
                                    <th>Hora de inicio</th>
                                    <td>{{ $appointment->time_start }}</td>
                                </tr>
                                <tr>
                                    <th>Hora de salida</th>
                                    <td>{{ $appointment->time_end }}</td>
                                </tr>
                                <tr>
                                    <th>Observaciones</th>
                                    <td>{{ $appointment->observations }}</td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>{{ $appointment->status }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th>Total</th>
                                <td>{{ $appointment->total }}</td>
                            </tr>
                            <tr>
                                <th>Total pagos</th>
                                <td>{{ $appointment->total_debts }}</td>
                            </tr>
                            <tr>
                                <th>Total Deuda</th>
                                <td>{{ $appointment->total - $appointment->total_debts }}</td>
                            </tr>
                            <tr>
                                <th>Pagos</th>
                                <td>
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Monto</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($appointment->debts as $debt)
                                            <tr>
                                                <td>{{ $debt->id }}</td>
                                                <td>{{ $debt->amount }}</td>
                                                <td>{{ $debt->created_at->format('d-m-Y H:i') }}</td>
                                                <td>
                                                    <form action="{{ route('admin.debts.destroy', $debt) }}" method="POST" style="display:inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" name="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminarlo?')"><i
                                                            class="fa fa-trash-o"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No hay pagos</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            @if($appointment->total - $appointment->total_debts !== 0)
                            <tr>
                                <th>Pagar</th>
                                <td>
                                    <div class="ml-1">
                                        <form action="{{ route('admin.debts.store', $appointment) }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $appointment->total_debts }}" name="total_debts">
                                            <input type="hidden" value="{{ $appointment->total }}" name="total">
                                            <div class="form-group">
                                                <label for="amount">Monto</label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="submit">Pagar
                                                        </button>
                                                    </div>
                                                    @error('amount')
                                                    <span class="invalid-feedback d-block" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
                <div class="form-group">
                    <a href="{{ route('admin.appointments.index') }}" class="btn btn-dark">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
