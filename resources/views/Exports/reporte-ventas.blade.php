<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas - {{ $fechaInicio }} al {{ $fechaFin }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #4F46E5;
            margin: 0;
            font-size: 24px;
        }
        .periodo {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
        }
        .metricas {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .metrica {
            display: table-cell;
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            background-color: #f8fafc;
        }
        .metrica.ingresos { background-color: #dbeafe; }
        .metrica.costo { background-color: #fee2e2; }
        .metrica.ganancia { background-color: #dcfce7; }
        .metrica.gastos { background-color: #ffedd5; }
        .metrica h3 {
            margin: 0 0 5px 0;
            font-size: 12px;
            color: #666;
        }
        .metrica .valor {
            font-size: 16px;
            font-weight: bold;
            color: #1f2937;
        }
        .seccion {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .seccion h2 {
            background-color: #4F46E5;
            color: white;
            padding: 8px 12px;
            margin: 0 0 10px 0;
            font-size: 14px;
            border-radius: 4px;
        }
        .tabla {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        .tabla th {
            background-color: #f1f5f9;
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-weight: bold;
        }
        .tabla td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .tabla .total {
            background-color: #f8fafc;
            font-weight: bold;
        }
        .resumen-rentabilidad {
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .resumen-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        .resumen-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        .resumen-item.total {
            font-weight: bold;
            border-top: 2px solid #4F46E5;
            padding-top: 10px;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
        .page-break {
            page-break-before: always;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .bg-success { background-color: #dcfce7; }
        .bg-danger { background-color: #fee2e2; }
        .bg-warning { background-color: #fef3c7; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Ventas y Rentabilidad</h1>
        <div class="periodo">
            Período: {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
        </div>
        <div class="periodo">
            Generado el: {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}
        </div>
    </div>

    <!-- Métricas Principales -->
    <div class="metricas">
        <div class="metrica ingresos">
            <h3>Ingresos Totales</h3>
            <div class="valor">${{ number_format($datos['ingresosTotales'], 2) }}</div>
            <small>{{ $datos['totalVentasPeriodo'] }} ventas</small>
        </div>
        <div class="metrica costo">
            <h3>Costo Mercancía</h3>
            <div class="valor">${{ number_format($datos['costoVentas'], 2) }}</div>
            <small>Costo promedio</small>
        </div>
        <div class="metrica ganancia">
            <h3>Ganancia Bruta</h3>
            <div class="valor">${{ number_format($datos['gananciaBruta'], 2) }}</div>
            <small>{{ $datos['ingresosTotales'] > 0 ? number_format(($datos['gananciaBruta'] / $datos['ingresosTotales']) * 100, 1) : 0 }}% margen</small>
        </div>
        <div class="metrica gastos">
            <h3>Inversión Inventario</h3>
            <div class="valor">${{ number_format($datos['gastosCompras'], 2) }}</div>
            <small>Compras del período</small>
        </div>
    </div>

    <!-- Resumen de Rentabilidad -->
    <div class="seccion">
        <h2>Análisis de Rentabilidad</h2>
        <div class="resumen-rentabilidad">
            <div class="resumen-item">
                <span>Ingresos por Ventas:</span>
                <span>${{ number_format($datos['ingresosTotales'], 2) }}</span>
            </div>
            <div class="resumen-item">
                <span>- Costo Mercancía Vendida:</span>
                <span>${{ number_format($datos['costoVentas'], 2) }}</span>
            </div>
            <div class="resumen-item" style="border-bottom: 2px solid #4F46E5;">
                <span>= Ganancia Bruta:</span>
                <span>${{ number_format($datos['gananciaBruta'], 2) }}</span>
            </div>
            <div class="resumen-item">
                <span>- Inversión Nuevo Inventario:</span>
                <span>${{ number_format($datos['gastosCompras'], 2) }}</span>
            </div>
            <div class="resumen-item total">
                <span>= Flujo de Caja Neto:</span>
                <span>${{ number_format($datos['gananciaNeta'], 2) }}</span>
            </div>
        </div>
    </div>

    <!-- Métricas de Desempeño -->
    <div class="seccion">
        <h2>Métricas de Desempeño</h2>
        <table class="tabla">
            <tr>
                <td>Total de Ventas</td>
                <td class="text-right">{{ $datos['totalVentasPeriodo'] }}</td>
            </tr>
            <tr>
                <td>Ticket Promedio</td>
                <td class="text-right">${{ number_format($datos['promedioVenta'], 2) }}</td>
            </tr>
            <tr>
                <td>Margen Bruto</td>
                <td class="text-right">{{ $datos['ingresosTotales'] > 0 ? number_format(($datos['gananciaBruta'] / $datos['ingresosTotales']) * 100, 1) : 0 }}%</td>
            </tr>
            <tr>
                <td>Rentabilidad Neta</td>
                <td class="text-right">{{ $datos['ingresosTotales'] > 0 ? number_format(($datos['gananciaNeta'] / $datos['ingresosTotales']) * 100, 1) : 0 }}%</td>
            </tr>
            <tr>
                <td>ROI del Período</td>
                <td class="text-right">{{ $datos['gastosCompras'] > 0 ? number_format(($datos['gananciaNeta'] / $datos['gastosCompras']) * 100, 1) : 0 }}%</td>
            </tr>
        </table>
    </div>

    <!-- Producto Más Vendido -->
    @if($datos['productoMasVendido'])
    <div class="seccion">
        <h2>Producto Más Vendido</h2>
        <table class="tabla">
            <tr>
                <th>Producto</th>
                <th>Unidades Vendidas</th>
                <th>Ingresos Generados</th>
            </tr>
            <tr>
                <td>{{ $datos['productoMasVendido']->nombre }}</td>
                <td class="text-right">{{ $datos['productoMasVendido']->total_vendido }}</td>
                <td class="text-right">${{ number_format($datos['productoMasVendido']->total_ingresos, 2) }}</td>
            </tr>
        </table>
    </div>
    @endif

    <!-- Ventas por Método de Pago -->
    @if(count($datos['ventasPorMetodoPago']) > 0)
    <div class="seccion">
        <h2>Ventas por Método de Pago</h2>
        <table class="tabla">
            <tr>
                <th>Método de Pago</th>
                <th>Transacciones</th>
                <th>Monto Total</th>
                <th>Porcentaje</th>
            </tr>
            @foreach($datos['ventasPorMetodoPago'] as $metodo)
            <tr>
                <td>{{ ucfirst($metodo->metodo_pago) }}</td>
                <td class="text-right">{{ $metodo->cantidad }}</td>
                <td class="text-right">${{ number_format($metodo->total_dolares, 2) }}</td>
                <td class="text-right">{{ number_format(($metodo->total_dolares / max($datos['ingresosTotales'], 1)) * 100, 1) }}%</td>
            </tr>
            @endforeach
        </table>
    </div>
    @endif

    <!-- Compras del Período -->
    <div class="seccion">
        <h2>Resumen de Compras</h2>
        <table class="tabla">
            <tr>
                <td>Total Invertido en Compras</td>
                <td class="text-right">${{ number_format($datos['gastosCompras'], 2) }}</td>
            </tr>
            <tr>
                <td>Retorno sobre Inversión (ROI)</td>
                <td class="text-right">{{ $datos['gastosCompras'] > 0 ? number_format(($datos['gananciaNeta'] / $datos['gastosCompras']) * 100, 1) : 0 }}%</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Reporte generado automáticamente por el Sistema de Gestión<br>
        {{ config('app.name', 'Laravel') }}
    </div>
</body>
</html>