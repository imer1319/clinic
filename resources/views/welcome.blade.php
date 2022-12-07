@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex py-5 align-items-center justify-content-center">
        <img src="{{ asset('icono.png') }}" height="200px" alt="icono1">
        <div>
            <h2 class="text-center title">CENTRO DE DIAGNOSTICO POR IMAGEN <br> Y SERVICIOS DE SALUD</h2>
            <img src="{{ asset('icono1.png') }}" height="125px" width="450px" alt="icono1">
        </div>
    </div>
    <h2 class="subtitle">Ofrece Servicios de:</h2>
    <div class="row">
        <div class="col-md-6 sub">
            <h2>- Radiografias</h2>
            <h2>- Ecografias</h2>
            <h2>- Laboratorio Clinico</h2>
        </div>
        <div class="col-md-6 sub">
            <h2>- Consulta Medica Gral. y Especializada</h2>
            <div class="ml-5">
                <h2>- Medicina Interna</h2>
                <h2>- Ginecologia y Obstreticia</h2>
                <h2>- Pediatria</h2>
                <h2>- Cirugia Gral.</h2>
                <h2>- Traumatologia</h2>
                <h2>- Cardiologia</h2>
                <h2>- Anestesiologia</h2>
                <h2>- Reanimacion y Dolor</h2>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .title{
        font-weight: 999;
        color: #B43222;
    }
    .subtitle {
        -webkit-text-stroke: 1.2px #B43222;
        font-family: arial; color: white;
    }
    .sub{
        -webkit-text-stroke: 1.2px #0C0F31;
        font-family: arial; color: white;
    }
</style>
@endsection