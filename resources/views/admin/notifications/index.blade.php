@extends('layouts.admin.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            @foreach ($notifications as $notification)
                <div>
                    <h5>{{ $notification->body }}</h5>
                </div>
            @endforeach
        </div>
    </div>
@endsection