@extends('layout')

@section('content')
    <h1>Crear producto</h1>
    <form role="form" method="POST" action="{{ url('/proveedor/nuevo') }}">
        {{ csrf_field() }}
        <div>
            <label for="product">Producto</label>
            <input type="text" name="product" id="product" value="{{ old('product') }}"/>
            <br>
            <label for="lote">Lote</label>
            <input type="text" name="lote" id="lote" value="{{ old('lote') }}"/>
            <br>
            <label for="quantity">cantidad</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"/>
            <br>
            <label for="expiration_date">FV</label>
            <input type="date" name="expiration_date" id="expiration_date" value="{{ old('expiration_date') }}"/>
            <br>
            <label for="price">Precio</label>
            <input type="number" id="price" name="price" value="{{ old('price') }}"/>
            <hr>
            <button type="submit"> Crear Producto</button>
        </div>
    </form>
@endsection
