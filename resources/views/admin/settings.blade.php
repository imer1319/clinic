@extends('layouts.admin.layout')

@section('title', 'Configuraciones')

@section('content')
    <h5>Configuraciones del sistema</h5>
    <settings-component></settings-component>
@endsection

@section('styles')
<style>
    .pre-scrollable {
        max-height: 40vh;
        overflow-y: scroll;
    }

    .table-responsive {
        height: 400px;
        overflow: scroll;
    }

    thead tr:nth-child(1) th {
        background: white;
        position: sticky;
        top: 0;
        z-index: 10;
        border: 0px;
    }
</style>
@endsection
