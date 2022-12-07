@extends('layouts.admin.layout')

@section('title', 'Listado de roles')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Roles</h5>
                    @can('roles_create')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Crear nuevo</a>
                    @endcan
                </div>
                <table class="table" id="table-roles">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Display_name</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<!-- Datatables -->
<link href="{{ asset('admin/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('admin/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
rel="stylesheet">
<link href="{{ asset('admin/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
rel="stylesheet">
<link href="{{ asset('admin/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('scripts')
<!-- Datatables -->
<script src="{{ asset('admin/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
<script src="{{ asset('admin/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
<script src="{{ asset('admin/vendors/jszip/dist/jszip.min.js') }}"></script>
<script src="{{ asset('admin/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#table-roles').DataTable({
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "»",
                    "previous": "«"
                }
            },
            "processing": true,
            "serverSide": true,
            "ajax": "/api/roles",
            "columns": [{
                data: 'id'
            },
            {
                data: 'name'
            },
            {
                data: 'display_name'
            },
            {
                data: 'btn',
                "orderable": false,
                "searchable": false
            },
            ]
        });
    });
</script>
@endsection
