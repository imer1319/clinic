@csrf
<div class="row">
    <div class="form-group col-md-4">
        <label for="ci">CI:</label>
        <input name="ci" value="{{ old('ci', $doctor->ci) }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="name">Nombre:</label>
        <input name="name" value="{{ old('name', $doctor->name) }}" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="surnames">Apellidos:</label>
        <input name="surnames" value="{{ old('surnames', $doctor->surnames) }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="nacimiento">Fecha de nacimiento</label>
        <input name="nacimiento" value="{{ old('nacimiento', $doctor->nacimiento) }}" type="date"
            class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="celular">Celular</label>
        <input name="celular" value="{{ old('celular', $doctor->celular) }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="image">Imagen</label>
        <div class="custom-file">
            <input type="file" name="image" class="custom-file-input" id="image-doctor" accept="image/*">
            <label class="custom-file-label" for="image-doctor">Seleccionar imagen</label>
        </div>
        @if ($doctor->image)
            <span class="text-muted">Dejar en blanco si no quieres editar la imagen</span>
            <br>
            <img src="{{ Storage::url($doctor->image->image) }}" alt="{{ $doctor->image->image }}" width="120px">
        @endif
    </div>
    <div class="form-group col-md-4">
        <label>Direccion</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $doctor->address) }}">
    </div>
    <div class="form-group col-md-4">
        <label for="specialty_id">Especialidad:</label>
        <select id="specialty_id" name="specialty_id" class="form-control @error('doctor_id') is-invalid @enderror">
            <option value="">Seleccionar especialidad</option>
            @foreach ($specialties as $specialty)
                <option value="{{ $specialty->id }}" {{ (old('specialty_id')==$specialty->id)? 'selected':'' }}>
                    {{ $specialty->description }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="gender">Genero :</label>
        <br>
        <label class="mr-3">
            <input type=radio name="gender" value="Masculino"
                {{ old('gender', $doctor->gender) == 'Masculino' ? 'checked' : '' }}>
            <b>Hombre</b>
        </label>
        <label>
            <input type=radio name="gender" value="Femenino"
                {{ old('gender', $doctor->gender) == 'Femenino' ? 'checked' : '' }}>
            <b>Mujer</b>
        </label>
    </div>
</div>
<h5 class="mt-3">Datos del usuario</h5>
<div class="row">
    <div class="form-group col-md-4">
        <label for="username">Username:</label>
        <input name="username" value="{{ old('username') }}" type="text" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="email">Email:</label>
        <input name="email" value="{{ old('email') }}" type="email" class="form-control">
    </div>

    <div class="form-group col-md-4">
        <label for="password">Contraseña</label>
        <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
    </div>

    <div class="form-group col-md-4">
        <label for="password-confirm">Confirmar contraseña</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
            autocomplete="new-password">
    </div>
</div>
<div class="form-group btn-group">
    <a href="{{ route('admin.doctors.index') }}" class="btn btn-dark">Regresar</a>
    <button class="btn btn-primary">{{ $text }}</button>
</div>
