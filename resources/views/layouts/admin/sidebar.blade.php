<div class="menu_section">
    <h3>General</h3>
    <ul class="nav side-menu">
        @can('dashboard_show')
        <li>
            <a href="{{ route('home') }}">
                <i class="fa fa-home"></i> Inicio
            </a>
        </li>
        @endcan

        {{--  @can('appointments_index')
        <li>
            <a data-cy="cita">
                <i class="fa fa-calendar"></i>
                Citas medicas
                <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
                @can('appointments_create')
                <li>
                    <a data-cy="create-cita" href="{{ route('admin.appointments.create') }}">
                        Crear citas medicas
                    </a>
                </li>
                @endcan
                <li>
                    <a data-cy="index-cita" href="{{ route('admin.appointments.index') }}">
                        Listar citas medicas
                    </a>
                </li>
            </ul>
        </li>
        @endcan --}}

        @can('users_index')
        <li>
            <a>
                <i class="fa fa-user"></i>
                Usuarios
                <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
                @can('users_create')
                <li>
                    <a href="{{ route('admin.users.create') }}">
                        Registrar usuario
                    </a>
                </li>
                @endcan
                <li>
                    <a href="{{ route('admin.users.index') }}">
                        Listar usuarios
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can('roles_index')
        <li>
            <a>
                <i class="fa fa-wrench"></i>
                Roles
                <span class="fa fa-chevron-down"></span>
            </a>
            <ul class="nav child_menu">
                @can('roles_create')
                <li>
                    <a href="{{ route('admin.roles.create') }}">
                        Registrar rol
                    </a>
                </li>
                @endcan
                <li>
                    <a href="{{ route('admin.roles.index') }}">
                        Listar roles
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can('doctors_index')
        <li>
            <a href="{{ route('admin.doctors.index') }}">
                <i class="fa fa-user-md"></i> Doctores
            </a>
        </li>
        @endcan

        @can('patients_index')
        <li>
            <a href="{{ route('admin.patients.index') }}">
                <i class="fa fa-wheelchair"></i> Pacientes
            </a>
        </li>
        @endcan

        @if (auth()->user()->hasRole('Doctor'))
        <li>
            <a href="{{ route('admin.mis-citas') }}">
                <i class="fa fa-wheelchair"></i> Mis citas
            </a>
        </li>
        @endif

        @if (auth()->user()->hasRole('Paciente'))
        <li>
            <a href="{{ route('admin.mis-archivos') }}">
                <i class="fa fa-wheelchair"></i> Mis Archivos
            </a>
        </li>
        @endif
        
        @can('settings_index')
        <li>
            <a href="{{ route('admin.settings') }}">
                <i class="fa fa-cog"></i> Configuraciones
            </a>
        </li>
        @endcan
    </ul>
</div>
