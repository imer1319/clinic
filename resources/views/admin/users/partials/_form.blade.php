    @csrf
    <div class="row">
        <div class="form-group col-md-6">
            <label for="name">Nombre:</label>
            <input name="name" value="{{ old('name') }}" type="text" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="username">Username:</label>
            <input name="username" value="{{ old('username') }}" type="text" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="email">Email:</label>
            <input name="email" value="{{ old('email') }}" type="email" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="password">Contraseña</label>
            <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
        </div>

        <div class="form-group col-md-6">
            <label for="password-confirm">Confirmar contraseña</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                autocomplete="new-password">
        </div>

        <div class="col-md-6">
            <label>Imagen</label>
            @if ($user->image)
                <span class="text-muted">Dejar en blanco si no quieres editar la imagen</span>
                <br>
                <img src="{{ Storage::url($user->image) }}" alt="{{ $user->image }}" width="120px">
            @endif
            <div class="custom-file">
                <input type="file" name="image" class="custom-file-input" id="image-doctor" accept="image/*">
                <label class="custom-file-label" for="image-doctor">Seleccionar imagen</label>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-6">
                <label>Roles</label>
                @include('admin.roles.checkboxes')
            </div>
        </div>
        <br>
    </div>
    <div class="form-group btn-group">
        <a href="{{ route('admin.users.index') }}" class="btn btn-dark">Regresar</a>
        <button class="btn btn-primary">Crear usuario</button>
    </div>
