@csrf
<div class="row">
    <div class="form-group col-md-4">
        <label for="name">Nombre:</label>
        <input name="name" value="{{ old('name', $patient->name) }}" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="surnames">Apellidos:</label>
        <input name="surnames" value="{{ old('surnames', $patient->surnames) }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="ci">CI:</label>
        <input name="ci" value="{{ old('ci', $patient->ci) }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="celular">Celular:</label>
        <input name="celular" id="celular" value="{{ old('celular', $patient->celular) }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="nacimiento">Fecha de nacimiento</label>
        <input type="date" name="nacimiento" id="nacimiento" value="{{ old('nacimiento', $patient->nacimiento) }}" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="address">Direccion:</label>
        <input name="address" value="{{ old('address', $patient->address) }}" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label>Ciudad</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $patient->city) }}">
    </div>

    <div class="form-group col-md-4">
        <label for="image">Imagen</label>
        <div class="custom-file">
            <input type="file" name="image" class="custom-file-input" id="image-patient">
            <label class="custom-file-label" for="image-patient">Choose file</label>
        </div>
        @if ($patient->image)
            <span class="text-muted">Dejar en blanco si no quieres editar la imagen</span>
            <br>
            <img src="{{ Storage::url($patient->image) }}" alt="{{ $patient->image }}" width="120px">
        @endif
    </div>
    

    <div class="form-group col-md-4">
        <label for="gender">Genero :</label>
        <br>
        <label class="mr-3">
            <input type=radio name="gender" value="Masculino" {{ old('gender',$patient->gender) == 'Masculino' ? 'checked' : '' }}>
            <b>Hombre</b>
        </label>
        <label>
            <input type=radio name="gender" value="Femenino" {{ old('gender',$patient->gender) == 'Femenino' ? 'checked' : '' }}>
            <b>Mujer</b>
        </label>
    </div>
    <div class="form-group col-md-4">
        <label>Notas internas</label>
        <textarea name="notas" rows="3" class="form-control"style="background-color:#FFF7E6; border:2px solid #FCE2AA !important">{{ old('notas', $patient->notas) }}</textarea>
    </div>
</div>
<div class="form-group btn-group">
    <a href="{{ route('admin.patients.index') }}" class="btn btn-dark">Regresar</a>
    <button class="btn btn-primary">{{ $text }}</button>
</div>
