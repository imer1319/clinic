@extends('layouts.admin.layout')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-body">
			<h5>Datos del paciente</h5>
			<hr>
			<div class="row">
				<div class="col-md-3">
					<h6><b>{{ $consultation->patient->name }}</b></h6>
					<div class="d-flex">
						<h6><b>{{ $edad }} años -</b></h6>
						<h6><b>&nbsp;{{ $consultation->patient->gender }}</b></h6>
					</div>
				</div>
				<div class="col-md-3">
					<h6><b>EXP: {{ $consultation->patient->id }}</b></h6>
					<h6><b>CEL: {{ $consultation->patient->celular }}</b></h6>
				</div>
				<div class="col-md-3">
					<h6><b> {{ $consultation->patient->address }}</b></h6>
					<h6><b>{{ $consultation->patient->city }}</b></h6>
				</div>
				<div class="col-md-3">
					<div class="d-flex">
						<a class="btn border d-flex align-items-center" data-toggle="modal" data-target="#modalArchive">
							<img src="/imagenes/clip.png" alt="clip" width="35">
						</a>
						<a href="{{ route('admin.patients.show', $consultation->patient->id) }}"
							class="btn border d-flex align-items-center">
							<img src="/imagenes/check.png" alt="clip" width="15">&nbsp;Terminar consulta
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="card mt-2">
		<div class="card-body">
			<ul class="nav nav-pills mb-3 d-flex justify-content-around w-100" id="pills-tab" role="tablist">
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-historial-tab" data-toggle="pill" data-target="#pills-historial"
					type="button" role="tab" aria-controls="pills-historial"
					aria-selected="false">Historial</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link active" id="pills-consulta-tab" data-toggle="pill"
					data-target="#pills-consulta" type="button" role="tab" aria-controls="pills-consulta"
					aria-selected="false">Consulta medica</button>
				</li>
				<li class="nav-item" role="presentation">
					<button class="nav-link" id="pills-receta-tab" data-toggle="pill" data-target="#pills-receta"
					type="button" role="tab" aria-controls="pills-receta" aria-selected="false">Receta
				medica</button>
			</li>
			<li class="nav-item" role="presentation">
				<button class="nav-link" id="pills-laboratorios-tab" data-toggle="pill"
				data-target="#pills-laboratorios" type="button" role="tab"
				aria-controls="pills-laboratorios" aria-selected="false">Pruebas laboratorio</button>
			</li>
		</ul>
		<hr>
		<div class="tab-content" id="pills-tabContent">
			<div class="tab-pane" id="pills-historial" role="tabpanel" aria-labelledby="pills-historial-tab">

				<tab-historial :consultation="{{ $consultation }}" />

			</div>
			<div class="tab-pane show active" id="pills-consulta" role="tabpanel"
			aria-labelledby="pills-consulta-tab">

			<tab-consulta :consultation="{{ $consultation->load('vitalSigns', 'patient') }}" />

			</div>
			<div class="tab-pane" id="pills-receta" role="tabpanel" aria-labelledby="pills-receta-tab">
				<tab-receta :consultation="{{ $consultation->load('medicalInstruction') }}" />
				</div>
				<div class="tab-pane" id="pills-laboratorios" role="tabpanel" aria-labelledby="pills-laboratorios-tab">

					<tab-estudio :consultation="{{ $consultation->load('studiosInstruction') }}" />

					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalArchive" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Arvhivos del paciente</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<archivo-paciente :patient="{{ $consultation->patient }}" />
						</div>
					</div>
				</div>
			</div>
		</div>
		@endsection

		@section('styles')
		<style>
			.nav-pills .nav-link {
				border-radius: 1.25rem;
				width: 170px;
			}

			.pre-scrollable {
				max-height: 35vh;
				overflow-y: scroll;
			}
		</style>
		@endsection
