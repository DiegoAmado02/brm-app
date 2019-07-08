<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title>BRM</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sticky-footer-navbar/">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.css"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }


    </style>
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/floating-labels.css') }}" rel="stylesheet">
</head>
<body class="d-flex flex-column h-100">
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">BRM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/cliente/productos') }}">Cliente <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/proveedor/productos') }}">Productos</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<main role="main" class="flex-shrink-0">
    <div class="">
        <div class="col-12">
            @yield('content')
        </div>
    </div>
</main>
<footer class="footer mt-auto py-3">
    <div class="container">
        <span class="text-muted">Place sticky footer content here.</span>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

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
</body>


</html>

