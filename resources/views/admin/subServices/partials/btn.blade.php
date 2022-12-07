@can('subservices_show')
<a href="{{ route('admin.subservices.show', $id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
@endcan

@can('subservices_edit')
<a href="{{ route('admin.subservices.edit', $id) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
@endcan

@can('subservices_destroy')
<form action="{{ route('admin.subservices.destroy', $id) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" name="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')"><i
        class="fa fa-trash-o"></i>
    </button>
</form>
@endcan
