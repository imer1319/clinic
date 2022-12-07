@can('subservices_create')
<a href="{{ route('admin.subservices.create', $id) }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i></a>
@endcan

@can('services_edit')
<a href="{{ route('admin.services.edit', $id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
@endcan

@can('services_destroy')
<form action="{{ route('admin.services.destroy', $id) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" name="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i
        class="fa fa-trash-o"></i>
    </button>
</form>
@endcan
