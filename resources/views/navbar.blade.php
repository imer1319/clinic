    <nav class="navbar navbar-expand-lg navbar-dark" style="background: #B43222;">
        <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                <a class="nav-link" href="/">Inicio</a>
            </li>
            <li class="nav-item {{ Request::is('about') ? 'active' : '' }}">
                <a class="nav-link" href="/about">UAJMS</a>
            </li>
            @guest
            <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
               <a class="nav-link" data-cy="login" href="/login">Iniciar sesión</a>
           </li>
           @else
           <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
               <a class="nav-link" href="/home">Dashboard</a>
           </li>
           @endguest
       </ul>
   </div>
</nav>