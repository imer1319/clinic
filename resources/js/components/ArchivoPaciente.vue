<template>
	<div>
		<error-component :errors="errors" />
		<div class="row">
			<div class="col-md-6">
				<input type="text" v-model="form.title" class="form-control" placeholder="Titulo">
			</div>
			<div class="col-md-6">
				<div class="custom-file">
					<input type="file" @change="selectFile" class="custom-file-input" accept="image/*">
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
					<tr v-for="archive in archives" :key="archive.id">
						<td>{{ archive.id }}</td>
						<td @click.prevent="showArchive(archive)" data-toggle="modal" data-target="#modalShowArchive">{{ archive.title }}</td>
						<td>{{ archive.created_at }}</td>
						<td @click.prevent="eliminarArchivo(archive.id)">
							<h5><i class="fa fa-trash text-danger cursor-pointer"></i></h5>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<archivo-show-paciente :data="form" />
	</div>
</template>	
<script>
export default{
	props:['patient'],
	mounted(){
		this.getArchivos()
		this.form.patient_id = this.patient.id
	},
	data(){
		return {
			archives:[],
			form:{
				title:'',
				image:null,
				patient_id:'',
				fecha:''
			},
			errors:[]
		}
	},
	methods:{
		getArchivos(){
			axios.get('/api/archives/'+this.patient.id)
			.then(res => {
				this.archives = res.data
			})
		},
		selectFile(event){
			this.form.image = event.target.files[0]		
		},
		showArchive(archive){
			this.form.title = archive.title
			this.form.fecha = archive.created_at
			this.form.image = archive.image
			$('#modalShowArchive').modal('show');
		},
		saveArchive(){
			let forms = new FormData();
			for (let key in this.form){
				forms.append(key, this.form[key])
			}

			axios.post('/api/archives', forms)
			.then(()=> {
				this.getArchivos()
				this.errors = []
				this.form = {
					title:'',
					image:null,
					patient_id:'',
					fecha:''
				}
			}).catch(err => {
				this.errors.push(err.response.data.errors);
			})
		},
		eliminarArchivo(id){
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
	}
}
</script>