<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Compra - Eventia</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2fdfd;
            margin: 0;
            padding: 0;
            color: #020d0c;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(37, 228, 206, 0.1);
            border: 1px solid #e0f2f1;
        }

        .header {
            background: linear-gradient(135deg, #25e4ce 0%, #ba84f0 100%);
            padding: 50px 20px;
            text-align: center;
        }

        .logo {
            background-color: #ffffff;
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: inline-block;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .content {
            padding: 40px;
            line-height: 1.6;
        }

        h1 {
            font-size: 28px;
            font-weight: 900;
            margin-top: 0;
            color: #020d0c;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .status-badge {
            display: inline-block;
            padding: 6px 16px;
            background-color: #e8f5f3;
            color: #25e4ce;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .event-card {
            background-color: #f8fafb;
            border-radius: 24px;
            padding: 24px;
            margin: 30px 0;
            border: 1px dashed #d1d5db;
        }

        .event-title {
            font-size: 20px;
            font-weight: 800;
            color: #020d0c;
            margin-bottom: 8px;
        }

        .event-detail {
            font-size: 14px;
            color: #49454F;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .summary th {
            text-align: left;
            font-size: 12px;
            color: #9ca3af;
            text-transform: uppercase;
            padding-bottom: 10px;
        }

        .summary td {
            font-weight: 700;
            font-size: 16px;
            padding: 10px 0;
            border-top: 1px solid #f3f4f6;
        }

        .total {
            font-size: 24px !important;
            color: #25e4ce;
            font-weight: 900 !important;
        }

        .button-container {
            text-align: center;
            margin: 40px 0;
        }

        .button {
            display: inline-block;
            padding: 18px 40px;
            background: linear-gradient(90deg, #25e4ce 0%, #ba84f0 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 16px;
            font-weight: 900;
            font-size: 16px;
            box-shadow: 0 10px 20px rgba(37, 228, 206, 0.3);
            transition: all 0.3s;
        }

        .footer {
            padding: 30px;
            text-align: center;
            font-size: 13px;
            color: #9ca3af;
            background-color: #f9fdfd;
            border-top: 1px solid #e0f2f1;
        }

        .social-links {
            margin-bottom: 20px;
        }

        .social-links a {
            color: #25e4ce;
            margin: 0 10px;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ $message->embed(public_path('images/EventiaLogo.png')) }}" alt="Logo" width="70" height="70">
            </div>
            <div
                style="color: white; font-weight: 800; font-size: 14px; text-transform: uppercase; letter-spacing: 2px;">
                Eventia Experience</div>
        </div>
        <div class="content">
            <div style="text-align: center;">
                <span class="status-badge">Pago confirmado</span>
            </div>
            <h1>¡Gracias por tu compra, {{ $entrada->usuario->nombre }}!</h1>
            <p>Tu entrada para <strong>{{ $entrada->evento->nombre_evento }}</strong> está lista. Prepárate para vivir
                una experiencia inolvidable.</p>

            <div class="event-card">
                <div class="event-title">{{ $entrada->evento->nombre_evento }}</div>
                <div class="event-detail">📅
                    {{ \Carbon\Carbon::parse($entrada->evento->fecha_inicio)->format('d \d\e F, Y') }}</div>
                <div class="event-detail">📍 {{ $entrada->evento->localidad }}, {{ $entrada->evento->provincia }}</div>

                <table class="summary">
                    <thead>
                        <tr>
                            <th>Entrada</th>
                            <th>Cantidad</th>
                            <th style="text-align: right;">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $entrada->categoria }}</td>
                            <td>x{{ $entrada->cantidad }}</td>
                            <td style="text-align: right;">{{ number_format($entrada->precio_total, 2) }}€</td>
                        </tr>
                        <tr>
                            <td colspan="2" style="border-top: 2px solid #25e4ce; padding-top: 15px;">TOTAL</td>
                            <td class="total"
                                style="text-align: right; border-top: 2px solid #25e4ce; padding-top: 15px;">
                                {{ number_format($entrada->precio_total, 2) }}€</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="button-container">
                <a href="{{ route('public.area') }}" class="button">Ver mis entradas</a>
            </div>

            <p style="font-size: 14px; font-style: italic; color: #9ca3af;">Recuerda que puedes descargar tu ticket en
                PDF desde tu área privada en cualquier momento.</p>
        </div>
        <div class="footer">
            <div class="social-links">
                <a href="#">Instagram</a>
                <a href="#">Twitter</a>
                <a href="#">Web</a>
            </div>
            &copy; {{ date('Y') }} Eventia. La plataforma líder en gestión cultural.<br>
            Has recibido este correo electrónico porque realizaste una compra en Eventia.
        </div>
    </div>
</body>

</html>