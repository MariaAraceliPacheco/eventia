<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Entrada - {{ $ticket->evento->nombre_evento }}</title>
    <style>
        @page {
            margin: 0;
            size: 600pt 250pt;
        }
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2fdfd;
            color: #020d0c;
        }
        .ticket-container {
            width: 100%;
            height: 100%;
            position: relative;
            overflow: hidden;
            display: table;
        }
        .main-section {
            display: table-cell;
            width: 70%;
            vertical-align: top;
            padding: 20px;
            border-right: 2px dashed #ba84f0;
        }
        .stub-section {
            display: table-cell;
            width: 30%;
            vertical-align: middle;
            background-color: #ffffff;
            text-align: center;
            padding: 20px;
        }
        .header {
            background-color: #25e4ce;
            padding: 10px 15px;
            margin: -20px -20px 20px -20px;
        }
        .header h1 {
            color: white;
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
        }
        .event-details {
            margin-bottom: 10px;
        }
        .event-details h2 {
            margin: 0;
            font-size: 18px;
            color: #ba84f0;
        }
        .info-grid {
            margin-top: 15px;
        }
        .info-item {
            margin-bottom: 8px;
        }
        .label {
            font-size: 10px;
            color: #49454F;
            text-transform: uppercase;
            font-weight: bold;
        }
        .value {
            font-size: 14px;
            font-weight: bold;
        }
        .qr-code {
            width: 120px;
            height: 120px;
            margin: 0 auto 10px auto;
            image-rendering: pixelated;
        }
        .ticket-id {
            font-family: monospace;
            font-size: 11px;
            background: #f2fdfd;
            padding: 4px;
            border-radius: 4px;
            word-break: break-all;
            color: #020d0c;
        }
        .footer {
            margin-top: 20px;
            font-size: 8px;
            color: #49454F;
            font-style: italic;
        }
        .category-badge {
            display: inline-block;
            background-color: #ea57de;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="ticket-container">
        <div class="main-section">
            <div class="header">
                <h1>EVENTIA FESTIVAL</h1>
            </div>
            
            <div class="event-details">
                <h2>{{ $ticket->evento->nombre_evento }} <span class="category-badge">{{ $ticket->categoria }}</span></h2>
            </div>
            
            <div class="info-grid">
                <div class="info-item">
                    <span class="label">ASISTENTE:</span><br>
                    <span class="value">{{ auth()->user()->nombre }}</span>
                </div>
                <div class="info-item" style="display: inline-block; width: 45%;">
                    <span class="label">FECHA:</span><br>
                    <span class="value">{{ \Carbon\Carbon::parse($ticket->evento->fecha_inicio)->format('d/m/Y') }}</span>
                </div>
                <div class="info-item" style="display: inline-block; width: 45%;">
                    <span class="label">UBICACIÓN:</span><br>
                    <span class="value">{{ $ticket->evento->localidad }}, {{ $ticket->evento->provincia }}</span>
                </div>
            </div>
            
            <div class="footer">
                VIVE LA EXPERIENCIA EVENTIA - Este documento es válido para el acceso al recinto.
            </div>
        </div>
        
        <div class="stub-section">
            <div class="label" style="margin-bottom: 15px;">ACCESO QR</div>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $ticket->codigo_ticket }}&margin=0&ecc=M" class="qr-code">
            <div class="ticket-id">{{ $ticket->codigo_ticket }}</div>
            <div style="margin-top: 15px; font-size: 10px; color: #ba84f0; font-weight: bold;">
                TOTAL: {{ number_format($ticket->precio_total, 2) }}€
            </div>
        </div>
    </div>
</body>
</html>
