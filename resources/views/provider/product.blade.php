@extends('layout')

@section('content')
    <h1>Productos</h1>
    <a href="{{ route('provider.create') }}">Entrgar Producto</a>
    <table>
        <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Producto</th>
                <th>Lote</th>
                <th>Cantidad</th>
                <th>Fecha de Vencimiento</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <th>{{ $product->id }}</th>
                    <td>{{ $product->product }}</td>
                    <td>{{ $product->lote }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ $product->expiration_date }}</td>
                    <td>{{ $product->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
