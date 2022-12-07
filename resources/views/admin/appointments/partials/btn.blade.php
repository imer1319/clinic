@can('invoce_show')
<a href="{{ route('admin.cita.pdf', $id) }}" class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
@endcan

@can('appointments_show')
<a href="{{ route('admin.appointments.show', $id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
@endcan

@can('appointments_destroy')
<form action="{{ route('admin.appointments.destroy', $id) }}" method="POST" style="display:inline">
    @csrf
    @method('DELETE')
    <button type="submit" name="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminarlo?')"><i
        class="fa fa-trash-o"></i>
    </button>
</form>
@endcan
