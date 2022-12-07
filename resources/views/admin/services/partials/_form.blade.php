@csrf
<div class="form-group">
    <label for="name">Nombre:</label>
    <input name="name" value="{{ old('name', $service->name) }}" class="form-control">
</div>

<div class="form-group btn-group">
    <a href="{{ route('admin.services.index') }}" class="btn btn-dark">Regresar</a>
    <button class="btn btn-primary">{{ $text }}</button>
</div>
