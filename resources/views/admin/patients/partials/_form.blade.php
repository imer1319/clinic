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
</div>
<div class="form-group btn-group">
    <a href="{{ route('admin.patients.index') }}" class="btn btn-dark">Regresar</a>
    <button class="btn btn-primary">{{ $text }}</button>
</div>
