@csrf
<div class="row">
    <div class="form-group col-md-6">
        <label for="name">Nombre:</label>
        <input name="name" value="{{ old('name', $doctor->name) }}" class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="surnames">Apellidos:</label>
        <input name="surnames" value="{{ old('surnames', $doctor->surnames) }}" type="text"
        class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="ci">CI:</label>
        <input name="ci" value="{{ old('ci', $doctor->ci) }}" type="text"
        class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="image">Imagen</label>
        <div class="custom-file">
            <input type="file" name="image" class="custom-file-input" id="image-doctor">
            <label class="custom-file-label" for="image-doctor">Seleccionar imagen</label>
        </div>
        @if($doctor->image)
        <span class="text-muted">Dejar en blanco si no quieres editar la imagen</span>
        <br>
        <img src="{{ Storage::url($doctor->image->image) }}" alt="{{ $doctor->image->image }}" width="120px">
        @endif
    </div>
</div>
<div class="form-group btn-group">
    <a href="{{ route('admin.doctors.index') }}" class="btn btn-dark">Regresar</a>
    <button class="btn btn-primary">{{ $text }}</button>
</div>
