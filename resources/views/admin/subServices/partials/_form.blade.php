@csrf

<div class="form-group">
    <label for="name">Nombre:</label>
    <input name="name" value="{{ old('name', $subservice->name) }}" class="form-control">
</div>

<div class="form-group">
    <label for="price">Precio:</label>
    <input type="number" name="price" value="{{ old('price', $subservice->price) }}" class="form-control">
</div>

<div class="form-check">
    <label>
        <input type="radio" class="form-check-input" name="status" value="ACTIVE" {{ 'ACTIVE' == old('status', $subservice->status) ? 'checked' : '' }} checked>Activo
    </label>
    <br>
    <label>
        <input type="radio" class="form-check-input" name="status" value="DISABLED" {{ 'DISABLED' == old('status', $subservice->status) ? 'checked' : '' }}>Desactivado
    </label>
</div>

<div class="form-group btn-group">
    <a href="{{ route('admin.subservices.index') }}" class="btn btn-dark">Regresar</a>
    <button class="btn btn-primary">{{ $text }}</button>
</div>
