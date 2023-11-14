<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo de Pago</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .logo {
            text-align: center;
        }

        .logo img {
            max-width: 100px;
            max-height: 100px;
        }

        .recibo {
            border: 1px solid #000;
            padding: 15px;
            margin-bottom: 20px;
        }

        .detalles {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }

        .informacion {
            margin-top: 10px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Primer Recibo -->
        <div class="recibo">
            <div class="logo">
                <img src="logo1.png" alt="Logo Empresa 1">
            </div>
            <h2>Recibo #001</h2>
            <p>Fecha: 14 de noviembre de 2023</p>

            <div class="informacion">
                <h3>Información del Pagador</h3>
                <p>Nombre: Juan Pérez</p>
                <p>Dirección: Calle 123, Ciudad</p>
                <p>Documento de Identidad: 123456789</p>
            </div>

            <div class="detalles">
                <p>Concepto: Servicio de Consultoría</p>
                <p>Monto: $500.00</p>
            </div>
        </div>

        <!-- Segundo Recibo -->
        <div class="recibo">
            <div class="logo">
                <img src="logo2.png" alt="Logo Empresa 2">
            </div>
            <h2>Recibo #002</h2>
            <p>Fecha: 14 de noviembre de 2023</p>

            <div class="informacion">
                <h3>Información del Pagador</h3>
                <p>Nombre: María Gómez</p>
                <p>Dirección: Ave. Principal, Pueblo</p>
                <p>Documento de Identidad: 987654321</p>
            </div>

            <div class="detalles">
                <p>Concepto: Diseño Gráfico</p>
                <p>Monto: $300.00</p>
            </div>
        </div>

        <footer>
            <p>Gracias por su pago. ¡Vuelva pronto!</p>
        </footer>
    </div>
</body>
</html>
