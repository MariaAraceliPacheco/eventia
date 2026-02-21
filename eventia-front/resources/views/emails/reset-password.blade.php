<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña - Eventia</title>
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

        .steps-container {
            background-color: #f9f9f9;
            border-radius: 16px;
            padding: 20px;
            margin: 25px 0;
        }

        .step {
            margin-bottom: 12px;
            display: flex;
            align-items: flex-start;
        }

        .step-number {
            background-color: #25e4ce;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: inline-block;
            text-align: center;
            line-height: 24px;
            font-weight: bold;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .step-text {
            color: #49454F;
            font-size: 15px;
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
            <h1>Hola, {{ $user->nombre }}</h1>
            <p>Has recibido este correo porque solicitaste restablecer la contraseña de tu cuenta en
                <strong>Eventia</strong>.
            </p>

            <div class="steps-container">
                <div class="step">
                    <span class="step-number">1</span>
                    <span class="step-text">Pulsa el botón "Restablecer Contraseña" que aparece justo debajo.</span>
                </div>
                <div class="step">
                    <span class="step-number">2</span>
                    <span class="step-text">Serás redirigido a una página segura para elegir tu nueva contraseña.</span>
                </div>
                <div class="step">
                    <span class="step-number">3</span>
                    <span class="step-text">Una vez cambiada, podrás volver a iniciar sesión normalmente.</span>
                </div>
            </div>

            <div class="button-container">
                <a href="{{ $url }}" class="button">Restablecer Contraseña</a>
            </div>

            <p>Este enlace de recuperación caducará en 60 minutos.</p>
            <p>Si tú no has solicitado este cambio, puedes ignorar este correo; tu contraseña seguirá siendo la misma.
            </p>

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