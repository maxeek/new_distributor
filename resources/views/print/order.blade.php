<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Recibo</title>

    <!-- Bootstrap 3.3.7 -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.17/css/AdminLTE.min.css"
        integrity="sha256-CLodobC7fgR0RShlxB54DX9wYKPWx723C3EGPwtZGEE=" crossorigin="anonymous" />


    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>
    <div class="row">


        <div class="col-xs-12">
            <div class="text-center text-bold">
                <h3># Orden: {{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}</h3>

            </div>
        </div>
    </div>
    <section class="invoice">
        <!--CABECERA-->
        <div class="row">
            <!--DATOS DEL CLIENTE-->
            <div class="col-xs-8">
                <div class="col-xs-12 margin-bottom-sm">
                    <p><strong>Fecha:</strong> {{ $order->date }}</p>
                    <p><strong>Empresa:</strong> {{ $order->client->business_name }}</p>
                    <p><strong>Titular:</strong> {{ $order->client->surname . ', ' . $order->client->name }}</p>
                    <p><strong>Tel&eacutefono:</strong> {{ $order->client->phone }}</p>
                    <p><strong>Direcci&oacuten:</strong> {{ $order->client->address . ', ' . $order->client->cities->name }}
                    </p>
                </div>
            </div>

            <div class="col-xs-4">
                <div class="text-center text-bold margin-bottom-print">
                    <p>Distribuidora Florentino S.R.L.</p>
                    <p>Ruc: 20545708303</p>
                    <p>Tel&eacutefono: +51 924 457 100</p>
                    <p>Correo: pedidos.distriflorentino@hotmail.com</p>
                </div>
            </div>


        </div>
        <div class="row">
            <p class="text-center text-bold margin-bottom-print">
                ____________________________________________________________________________________</p>
        </div>





        <!--MATRICULA DETALLE-->
        <div class="row">
            <div class="col-xs-12 table-responsive no-margin">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align:left; font-size:11px; padding-top:5px;">Cant</th>
                            <th colspan="4" style="text-align:left; font-size:11px; padding-top:5px;">Descripci&oacuten
                            </th>
                            <th colspan="4" style="text-align:left; font-size:11px; padding-top:5px;">Precio</th>
                            <th colspan="4" style="text-align:right; font-size:11px; padding-top:5px;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->details as $detail)
                            <tr>
                                <td colspan="4" style="text-align:left; font-size:11px; padding-top:5px;">
                                    {{ $detail->qty }}</td>
                                <td colspan="4" style="text-align:left; font-size:11px; padding-top:5px;">
                                    {{ $detail->product->title }}</td>
                                <td colspan="4" style="text-align:left; font-size:11px; padding-top:5px;">$
                                    {{ $detail->up }}</td>
                                <td colspan="4" style="text-align:right; font-size:11px; padding-top:5px;">$
                                    {{ $detail->amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-xs-12 table-responsive">
                <table class="table" cellspacing="0" style="margin-bottom:8px;">
                    <tbody>
                        <tr>
                            <td colspan="4" style="text-align:left; font-weight:bold; padding-top:5px;">Subtotal
                            </td>
                            <td colspan="4" style="padding-top:5px; text-align:right; font-weight:bold;">$
                                {{ $order->subtotal }}</td>
                        </tr>

                        <tr>
                            <td colspan="4" style="text-align:left; font-weight:bold; padding-top:5px;">Descuento
                            </td>
                            <td colspan="4" style="padding-top:5px; text-align:right; font-weight:bold;">$
                                {{ $order->discount }}</td>
                        </tr>

                        <tr>
                            <td colspan="4" style="text-align:left; font-weight:bold; padding-top:5px;">Total</td>
                            <td colspan="4" style="padding-top:5px; text-align:right; font-weight:bold;">$
                                {{ $order->total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>



        <div class="row margin-top-sm">
            <div class="col-xs-12">
                <p><strong>Entrega pautada:</strong> {{ $order->day . ' ' . $order->hour }} | <strong>Estado:</strong>
                    {{ $order->status->name }}</p>

                <p><strong>Observaci&oacuten: </strong> {{ $order->observation }}</p>
                <p></p>
            </div>
        </div>

    </section>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $(document).ready(function() {

            setTimeout(() => {
                window.print();
            }, 1500);
        });
    </script>
</body>

</html>
