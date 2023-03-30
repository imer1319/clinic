@if (session('flash'))
    <div class="alert alert-success" role="alert">
        {{ session('flash') }}
    </div>
@endif
