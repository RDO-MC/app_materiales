@extends('adminlte::page')
@section('title', 'MATERIALES ITSZ')
@section('content_header')
    <h1 class="text-center">BIENES A CARGO</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Asignaciones</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>TIPO DE BIEN</th>
                                    <th>FECHA DE ASIGNACION</th>
                                    <th>ORIGEN DE SALIDA</th>
                                    <th>LUGAR DE ASIGNACION</th>
                                    <th>ESTADO</th>
                                    <th>NOTAS</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($asignaciones as $asignacion)
                                <tr>
                                    <td>{{ $asignacion->id }}</td>
                                    <td>{{ getNombreBien($asignacion) }}</td>
                                    <td>{{ getDescripcionBien($asignacion) }}</td>
                                    <td>{{ getTipoBien($asignacion) }}</td>
                                    <td>{{ $asignacion->fecha_de_asignacion }}</td>
                                    <td>{{ $asignacion->origen_salida }}</td>
                                    <td>{{ $asignacion->lugar_asignacion }}</td>
                                    <td>{{ $asignacion->estado }}</td>
                                    <td>{{ $asignacion->notas }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Préstamos</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-primary">
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>TIPO DE BIEN</th>
                                    <th>LUGAR DE PRESTAMO</th>
                                    <th>FECHA DE PRESTAMO</th>
                                    <th>FECHA DE DEVOLUCION</th>
                                    <th>Notas</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($prestamos as $prestamo)
                                <tr>
                                    <td>{{ $prestamo->id }}</td>
                                    <td>{{ getNombreBien($prestamo) }}</td>
                                    <td>{{ getDescripcionBien($prestamo) }}</td>
                                    <td>{{ getTipoBien($prestamo) }}</td>
                                    <td>{{ $prestamo->lugar_de_prestamo }}</td>
                                    <td>{{ $prestamo->fecha_de_prestamo }}</td>
                                    <td>{{ $prestamo->fecha_de_devolucion }}</td>
                                    <td>{{ $prestamo->notas }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('styles')
<style>
    body, .content, .wrapper {
        background-color: #d2f4cd !important; /* Verde claro */
    }

    h1, h3 {
        color: #3498db;
    }

    .table thead th {
        background-color: #34495e;
        color: white;
    }

    .table tbody tr:hover {
        background-color: #ecf0f1;
    }

    .card-header {
        border-bottom: 2px solid #3498db;
    }

    .card {
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }
</style>
@endpush

@php
// Funciones getNombreBien, getDescripcionBien
