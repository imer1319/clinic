@csrf
<div class="form-group">
    <label>Nombre:</label>
    <input name="name" value="{{ old('name', $role->name) }}" class="form-control">
</div>

<div class="form-group">
    <label>Permisos</label>
    <div class="row">
        @include('admin.permissions.checkboxes', ['model' => $role])
    </div>
</div>

<div class="form-group btn-group">
    <a href="{{ route('admin.roles.index') }}" class="btn btn-dark">Regresar</a>
    <button class="btn btn-primary">{{ $text }}</button>
</div>
