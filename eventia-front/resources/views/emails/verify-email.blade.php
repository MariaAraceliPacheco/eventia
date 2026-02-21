<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifica tu cuenta en Eventia</title>
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
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(37, 228, 206, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #25e4ce 0%, #ba84f0 100%);
            padding: 40px 20px;
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
            font-size: 24px;
            margin-top: 0;
            color: #020d0c;
            text-align: center;
        }

        p {
            color: #49454F;
            font-size: 16px;
            text-align: center;
        }

        .button-container {
            text-align: center;
            margin: 30px 0;
        }

        .button {
            display: inline-block;
            padding: 16px 32px;
            background: linear-gradient(90deg, #25e4ce 0%, #ba84f0 100%);
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 12px;
            font-weight: bold;
            font-size: 16px;
            transition: transform 0.2s;
        }

        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #49454F;
            background-color: #f9f9f9;
        }

        .trouble {
            font-size: 11px;
            margin-top: 20px;
            color: #999;
            word-break: break-all;
        }

        .link {
            color: #ba84f0;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <img src="{{ $message->embed(public_path('images/EventiaLogo.png')) }}" alt="Logo" width="70"
                    height="70">
            </div>
        </div>
        <div class="content">
            <h1>¡Hola, {{ $user->nombre }}!</h1>
            <p>Estamos emocionados de tenerte en <strong>Eventia</strong>. Antes de empezar, necesitamos confirmar que
                esta dirección de correo te pertenece.</p>

            <div class="button-container">
                <a href="{{ $url }}" class="button">Verificar Correo Electrónico</a>
            </div>

            <p>Este enlace de verificación caducará en 60 minutos.</p>
            <p>Si no creaste una cuenta, no es necesario realizar ninguna acción.</p>

            <div class="trouble">
                Si tienes problemas para pulsar el botón, copia y pega el siguiente enlace en tu navegador: <br>
                <a href="{{ $url }}" class="link">{{ $url }}</a>
            </div>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} Eventia. Todos los derechos reservados.
        </div>
    </div>
</body>

</html>