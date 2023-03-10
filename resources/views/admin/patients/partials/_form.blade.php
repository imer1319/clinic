@csrf
<div class="row">
    <div class="form-group col-md-6">
        <label for="name">Nombre:</label>
        <input name="name" value="{{ old('name', $patient->name) }}" class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="surnames">Apellidos:</label>
        <input name="surnames" value="{{ old('surnames', $patient->surnames) }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="ci">CI:</label>
        <input name="ci" value="{{ old('ci', $patient->ci) }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="gender">Genero :</label>
        <br>
        <label class="mr-3">
            <input type=radio name="gender" value="male" {{ old('gender',$patient->gender) == 'male' ? 'checked' : '' }}>
            <b>Hombre</b>
        </label>
        <label>
            <input type=radio name="gender" value="female" {{ old('gender',$patient->gender) == 'female' ? 'checked' : '' }}>
            <b>Mujer</b>
        </label>
    </div>

    <div class="form-group col-md-6">
        <label for="peso">Peso:</label>
        <input type="number" name="peso" value="{{ old('peso', $patient->peso) }}" type="text"
            class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="presion">Presion:</label>
        <input type="number" name="presion" value="{{ old('presion', $patient->presion) }}" type="text"
            class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="altura">Altura:</label>
        <input type="number" name="altura" value="{{ old('altura', $patient->altura) }}" type="text"
            class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="phone">Telefono:</label>
        <input name="phone" id="phone" value="{{ old('phone', $patient->phone) }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="image">Imagen</label>
        <div class="custom-file">
            <input type="file" name="image" class="custom-file-input" id="image-patient">
            <label class="custom-file-label" for="image-patient">Choose file</label>
        </div>
        @if ($patient->image)
            <span class="text-muted">Dejar en blanco si no quieres editar la imagen</span>
            <br>
            <img src="{{ Storage::url($patient->image->image) }}" alt="{{ $patient->image->image }}" width="120px">
        @endif
    </div>

    <div class="form-group col-md-6">
        <label for="nacimiento">Fecha de nacimiento</label>
        <input type="date" name="nacimiento" id="nacimiento" value="{{ old('nacimiento', $patient->nacimiento) }}" class="form-control">
    </div>

    <div class="form-group col-md-6">
        <label for="address">Direccion:</label>
        <textarea name="address" id="address" rows="2" class="form-control">{{ old('address', $patient->address) }}</textarea>
    </div>
</div>
<div class="form-group btn-group">
    <a href="{{ route('admin.patients.index') }}" class="btn btn-dark">Regresar</a>
    <button class="btn btn-primary">{{ $text }}</button>
</div>
