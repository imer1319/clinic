@extends('layouts.admin.layout')

@section('content')
    <notificaciones-list :notifications="{{ $notifications }}" />
@endsection
