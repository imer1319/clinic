<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Historial</title>

	<link rel="icon" href="{{ asset('icono.png') }}" type="image/x-icon" />

	<style>
		body {
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			text-align: center;
			color: #777;
		}

		body h1 {
			font-weight: 300;
			margin-bottom: 0px;
			padding-bottom: 0px;
			color: #000;
		}

		body h3 {
			font-weight: 300;
			margin-top: 10px;
			margin-bottom: 20px;
			font-style: italic;
			color: #555;
		}

		body a {
			color: #06f;
		}

		.invoice-box {
			max-width: 800px;
			margin: auto;
			padding: 30px;
			border: 1px solid #eee;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
			font-size: 16px;
			line-height: 24px;
			font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
			color: #555;
		}

		.invoice-box table {
			width: 100%;
			line-height: inherit;
			text-align: left;
			border-collapse: collapse;
		}

		.invoice-box table td {
			padding: 5px;
			vertical-align: top;
		}

		.invoice-box table tr td:nth-child(2) {
			text-align: right;
		}

		.invoice-box table tr.top table td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.top table td.title {
			font-size: 45px;
			line-height: 45px;
			color: #333;
		}

		.invoice-box table tr.information table td {
			padding-bottom: 40px;
		}

		.invoice-box table tr.heading th {
			background: #eee;
			border-bottom: 1px solid #ddd;
			font-weight: bold;
			padding:10px 0px;
		}

		.invoice-box table tr.details td {
			padding-bottom: 20px;
		}

		.invoice-box table tr.item td {
			border-bottom: 1px solid #eee;
		}

		.invoice-box table tr.item.last td {
			border-bottom: none;
		}

		.invoice-box table tr.total td:nth-child(2) {
			border-top: 2px solid #eee;
			font-weight: bold;
		}

		@media only screen and (max-width: 600px) {
			.invoice-box table tr.top table td {
				width: 100%;
				display: block;
				text-align: center;
			}

			.invoice-box table tr.information table td {
				width: 100%;
				display: block;
				text-align: center;
			}
		}
		.line1{
			width: 100%;
			background-color: #102562;
			height: 10px;
		}
		.line2{
			width: 100%;
			background-color: #DA5649;
			height: 10px;
		}
	</style>
</head>
<body>
	<div class="line1"></div>
	<div class="line2"></div>
	<h2 style="color:#181A49">CENTRO DE DIAGNOSTICO POR IMAGEN Y SERVICIO DE SALUD <br>
		<b>X RAY MED S.R.L.</b>
	</h2>
	<div class="invoice-box">
		<table>
			<tr>
				<th colspan="2"><h2>Historial medico</h2></th>
			</tr>
			<tr class="top">
				<td colspan="2">
					<table>
						<tr>
							<td class="title">
								<img src="data:image/jpg;base64,{{ base64_encode(file_get_contents(public_path('/icono.png'))) }}" style="height: 130px;" alt="Company logo" >
							</td>

							<td>
								EXP #: {{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}<br />
								Fecha: {{ date('M d Y') }}<br />
								Hora: {{ date('H:i A') }}
							</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr class="information">
				<td colspan="2">
					<table>
						<tr>
							<td>
								Paciente<br />
								Género<br />
								Edad<br />
								Fecha de Nacimiento<br />
							</td>

							<td>
								{{ $patient->name }}<br />
								{{ $patient->profile->gender }}<br />
								{{ $edad }} años<br />
								<span class="h6 text-capitalize">
									{{ $patient->profile->nacimiento }}
								</span>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			@foreach($histories as $history)
			<tr class="heading">
				<th colspan="2">{{ $history->title }}</th>
			</tr>
			@foreach($history->historyQuestions as $question)
			<tr>
				<td colspan="1">{{ $question->question }}</td>
				<td colspan="1">{{ $question->historyPatient ? $question->historyPatient->answer : '' }}</td>
			</tr>
			@endforeach
			@endforeach
		</table>
	</div>
</body>
</html>
