<template>
	<div>
		<error-component :errors="errors" />
		<div class="row">
			<div class="col-md-6">
				<input type="text" v-model="form.title" class="form-control" placeholder="Titulo">
			</div>
			<div class="col-md-6">
				<div class="custom-file">
					<input type="file" id="fileInput" @change="selectFile" class="custom-file-input" accept="image/*">
					<label class="custom-file-label" for="inputGroupFile04">Choose file</label>
				</div>
			</div>
		</div>
		<div class="d-flex justify-content-end my-3">
			<button @click.prevent="saveArchive" class="btn border text-success">
				<i class="fa fa-plus"></i>&nbsp;Agregar
			</button>
		</div>
		<div class="pre-scrollable">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nombre</th>
						<th>Fecha</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="archive, index in archives" :key="archive.id">
						<td>{{ index + 1 }}</td>
						<td @click.prevent="showArchive(archive)" data-toggle="modal" data-target="#modalShowArchive">{{
							archive.title }}</td>
						<td>{{ archive.created_at | fechaFormateada }}</td>
						<td @click.prevent="eliminarArchivo(archive.id)">
							<h5><i class="fa fa-trash text-danger cursor-pointer"></i></h5>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<archivo-show-paciente :data="showArchiveForm" />
	</div>
</template>
<script>
import moment from 'moment';
export default {
	props: ['patient','consultation'],
	mounted() {
		this.getArchivos()
	},
	data() {
		return {
			archives: [],
			form: {
				title: '',
				image: null,
				patient_id: '',
				fecha: ''
			},
			image: null,
			errors: [],
			showArchiveForm: {}
		}
	},
	methods: {
		getArchivos() {
			axios.get('/api/archives/' + this.consultation.id)
				.then(res => {
					this.archives = res.data
				})
		},
		selectFile(event) {
			this.image = event.target.files[0]
		},
		showArchive(archive) {
			this.showArchiveForm = {
				title: archive.title,
				fecha: archive.created_at,
				image: archive.image,
			}
			$('#modalShowArchive').modal('show');
		},
		saveArchive() {
			this.form.image = this.image
			this.form.patient_id = this.patient.id
			this.form.consultation_id = this.consultation.id
			let forms = new FormData();
			for (let key in this.form) {
				forms.append(key, this.form[key])
			}
			axios.post('/api/archives', forms)
				.then(() => {
					this.getArchivos()
					this.$toastr.s("SE AGREGÓ CORRECTMENTE", "");
					this.errors = []
					this.form = {
						title: '',
						patient_id: this.patient.id,
						fecha: ''
					}
					document.querySelector('#fileInput').value = ''
				}).catch(err => {
					this.errors.push(err.response.data.errors);
				})
		},
		eliminarArchivo(id) {
			axios.delete('/api/archives/' + id)
				.then(() => {
					this.getArchivos()
					this.errors = []
					this.$toastr.s("SE ELIMINÓ CORRECTMENTE", "");
				}).catch(err => {
					this.errors.push(err.response.data.errors);
					this.$toastr.e("HUBO ERRORES AL ELIMINAR");
				})
		}
	},
	filters: {
		fechaFormateada(fecha) {
			return moment(new Date(fecha)).format('DD-MM-YYYY HH:mm A')
		}
	}
}
</script>
