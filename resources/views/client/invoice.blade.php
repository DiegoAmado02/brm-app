<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Factura</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">

                        <table class="table table-condensed">
                            <thead>
                            <tr>
                                <td><strong>Producto</strong></td>
                                <td class="text-center"><strong>Precio</strong></td>
                                <td class="text-center"><strong>Cantidad</strong></td>
                                <td class="text-right"><strong>Total</strong></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $producto }}</td>
                                <td class="text-center">${{ $precio }}</td>
                                <td class="text-center">{{ $cantidad }}</td>
                                <td class="text-right">${{ $precio * $cantidad }}</td>
                            </tr>
                            <tr>
                                <td class="highrow"></td>
                                <td class="highrow"></td>
                                <td class="highrow"></td>
                                <td class="highrow"></td>
                            </tr>
                            <tr>
                                <td class="emptyrow"></td>
                                <td class="emptyrow"></td>
                                <td class="emptyrow"></td>
                                <td class="emptyrow"></td>
                            </tr>
                            <tr>
                                <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                <td class="emptyrow"></td>
                                <td class="emptyrow text-center"><strong>Total</strong></td>
                                <td class="emptyrow text-right">$ {{ $precio * $cantidad }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<a href="{{ route('cliente.products') }}">Volver a productos</a>
<style>
    .height {
        min-height: 200px;
    }

    .icon {
        font-size: 47px;
        color: #5CB85C;
    }

    .iconbig {
        font-size: 77px;
        color: #5CB85C;
    }

    .table > tbody > tr > .emptyrow {
        border-top: none;
    }

    .table > thead > tr > .emptyrow {
        border-bottom: none;
    }

    .table > tbody > tr > .highrow {
        border-top: 3px solid;
    }
</style>

</body>
</html>
