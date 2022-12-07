@extends('layouts.app')

@section('content')
<section class="text-center py-5">
    <div>
        <img src="{{ asset('icono.png') }}" height="85px" alt="icono1">
        <img src="{{ asset('icono1.png') }}" height="85px" alt="icono1">
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="d-flex flex-column align-items-center">
            <div class="form-group col-md-4 mt-4">
                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required placeholder="Username"  autofocus>

                @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group col-md-4">
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Contraseña">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-success">
                 Iniciar sesión
             </button>
         </div>
     </div>
 </form>
</section>
@endsection