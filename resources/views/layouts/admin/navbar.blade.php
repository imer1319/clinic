<div class="nav_menu">
    <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
    </div>
    <nav class="nav navbar-nav">
        <ul class=" navbar-right">
            <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    @if(auth()->user()->profile->image)
                    <img src="{{ Storage::url( auth()->user()->profile->image) }}" alt="{{  auth()->user()->name }}" width="120px">
                    {{ auth()->user()->name }}
                    @else
                    <img src="{{ Avatar::create( auth()->user()->name )->toBase64() }}" alt="Avatar">
                    {{ auth()->user()->name }}
                    @endif
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item"><b>Rol:</b> {{ Auth::user()->getRoleDisplayNames() }}</a>
                    <a class="dropdown-item" href="{{ route('admin.profile.show') }}">
                        Perfil
                    </a>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Cerrar Sesión
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        <notificaciones :user="{{ Auth::user() }}" />
    </ul>
</nav>
</div>
