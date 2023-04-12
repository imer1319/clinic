@foreach ($roles as $role)
<div class="checkbox">
    <label class="d-flex">
        <input name="roles[]" type="radio" value="{{ $role->name }}"
        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
        <span class="ml-2"><b>{{ $role->name }}</b></span>
    </label>
</div>
@endforeach
