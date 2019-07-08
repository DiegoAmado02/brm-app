@extends('layout')

@section('content')

            <h1>Comprar producto</h1>

            <form role="form" method="POST" action="{{ url('/cliente/pagar') }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div>
                    <label for="product">Producto</label>
                    <select id="product" name="product">
                        <option selected="selected">Seleccione</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"> {{ $product->product }}</option>
                        @endforeach
                    </select><span id="contador"></span>
                    <br>
                    <label for="quantity">cantidad</label>
                    <input type="number" name="quantity" id="quantity" value=""/>
                    <br>
                    <label for="expiration_date">FV</label>
                    <input type="date" name="expiration_date" id="expiration_date" value="{{ old('expiration_date') }}"
                           readonly/>
                    <hr>
                    <button id="boton" type="submit"> Comprar</button>
                    <input type="hidden" id="cantidad" nombre="cantidad">
                    <input type="hidden" id="precio" nombre="precio">
                </div>
                <div id="mensaje">

                </div>
                <div id="total">

                </div>
            </form>

@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function () {
        $("#quantity").prop("disabled", true);
        $("#boton").prop("disabled", true);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#product").change(function (e) {
            e.preventDefault();
            $("#quantity").val('');
            $("#total").html("");

            if ($("#product").val() == 'Seleccione') {
                $("#quantity").prop("disabled", true);
                $("#boton").prop("disabled", true);
            } else {
                $("#quantity").prop("disabled", false);
                $("#boton").prop("disabled", false);
            }

            $.ajax({
                type: 'POST',
                url: '/cliente/compra',
                data: {
                    'product_id': $("select[name=product]").val()
                },
                success: function (data) {
                    $("input[name=expiration_date]").val(data[0][0]['expiration_date']);
                    var output = fechaHoy();
                    var fecha = $("input[name=expiration_date]").val();
                    $("#cantidad").val(data[0][0]['quantity']);
                    $("#precio").val(data[0][0]['price']);
                    $("#contador").html("Inventario: " + data[0][0]['quantity']);

                    var f1 = new Date(output);
                    var f2 = new Date(fecha);

                    if (f1.getDate() === f2.getDate() && f1.getMonth() === f2.getMonth() && f1.getFullYear() === f2.getFullYear()) {
                        $("#mensaje").html("<p>Fecha vencida, seleccione otro producto</p>");
                        $("#boton").prop("disabled", true);
                    } else {
                        $("#mensaje").html("");
                        $("#boton").prop("disabled", false);
                    }
                }
            });
        });

        $("#quantity").keydown(function (e) {
            contador();
        });
        $("#quantity").keyup(function (e) {
            contador();
        });


        function contador() {

            var cantidad = $("#cantidad").val();
            var precio = $("#precio").val();

            console.log($("#quantity").val() + " " + $("#cantidad").val());

            if (parseInt($("#quantity").val()) > parseInt($("#cantidad").val())) {
                $("#mensaje").html("<p>Lo sentimos, no tenemos esa cantidad</p>");
                $("#total").html("");
                $("#boton").prop("disabled", true);
            } else {
                var total = precio * $("#quantity").val();
                html = "<h3>Total a pagar<h3>";
                html = html + "<p>" + "<strong>" + total + " </strong>" +
                    "</p>"
                $("#mensaje").html("");
                $("#total").html(html);
                $("#boton").prop("disabled", false);
            }

            $("#contador").html("Inventario: " + (cantidad - $("#quantity").val()));
        }

        function fechaHoy() {
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate();

            var output = d.getFullYear() + '-' +
                (month < 10 ? '0' : '') + month + '-' +
                (day < 10 ? '0' : '') + day;

            return output;
        }
    });
</script>
