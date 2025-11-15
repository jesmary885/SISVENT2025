<div class="space-y-6">
    <!-- Filtros por Fecha -->
    <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
        <div class="flex flex-col lg:flex-row gap-4 items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <i class="fas fa-chart-pie text-purple-500 mr-2"></i>
                Dashboard de Rentabilidad
            </h2>
            
            <div class="flex flex-col sm:flex-row gap-3">
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-medium text-gray-700">Desde:</label>
                    <input type="date" wire:model="fechaInicio" 
                           class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex items-center space-x-2">
                    <label class="text-sm font-medium text-gray-700">Hasta:</label>
                    <input type="date" wire:model="fechaFin" 
                           class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

                <!-- Botón de exportación -->
            <button wire:click="exportarPDF" 
                    wire:loading.attr="disabled"
                    class="bg-green-600 hover:bg-green-700 cursor-pointer text-white px-4 py-2 rounded-lg font-semibold transition duration-200 flex items-center space-x-2">
                <i class="fas fa-file-pdf"></i>
                <span wire:loading.remove>Exportar a PDF</span>
                <span wire:loading>
                    <i class="fas fa-spinner fa-spin"></i>
                    Generando...
                </span>
            </button>
        </div>
    </div>

    <!-- MÉTRICAS PRINCIPALES DE RENTABILIDAD -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Ingresos Totales -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Ingresos Totales</p>
                    <p class="text-2xl font-bold">${{ number_format($ingresosTotales, 2) }}</p>
                    <p class="text-blue-100 text-xs mt-1">{{ $totalVentasPeriodo }} ventas</p>
                </div>
                <i class="fas fa-money-bill-wave text-2xl opacity-80"></i>
            </div>
        </div>

        <!-- Costo Real -->
        <div class="bg-gradient-to-r from-red-500 to-red-600 text-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm">Costo Mercancía</p>
                    <p class="text-2xl font-bold">${{ number_format($costoVentas, 2) }}</p>
                    <p class="text-red-100 text-xs mt-1">Costo Promedio Real</p>
                </div>
                <i class="fas fa-boxes text-2xl opacity-80"></i>
            </div>
        </div>

        <!-- Ganancia Bruta -->
        <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-100 text-sm">Ganancia Bruta</p>
                    <p class="text-2xl font-bold">${{ number_format($gananciaBruta, 2) }}</p>
                    <p class="text-green-100 text-xs mt-1">
                        {{ $ingresosTotales > 0 ? number_format(($gananciaBruta / $ingresosTotales) * 100, 1) : 0 }}% margen
                    </p>
                </div>
                <i class="fas fa-chart-line text-2xl opacity-80"></i>
            </div>
        </div>

        <!-- Gastos en Compras -->
        <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-2xl p-6 shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm">Inversión Inventario</p>
                    <p class="text-2xl font-bold">${{ number_format($gastosCompras, 2) }}</p>
                    <p class="text-orange-100 text-xs mt-1">Compras del período</p>
                </div>
                <i class="fas fa-shopping-bag text-2xl opacity-80"></i>
            </div>
        </div>
    </div>

    <!-- GRÁFICAS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Gráfica Mensual -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-chart-line text-blue-500 mr-2"></i>
                        Ventas del Mes Actual
                    </h3>
                    <p class="text-gray-600 text-sm">
                        {{ \Carbon\Carbon::create()->month($mesActual)->translatedFormat('F Y') }}
                    </p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-blue-600">
                        ${{ number_format($totalMensualDolares, 2) }}
                    </div>
                    <div class="text-sm text-gray-500">Total en dólares</div>
                </div>
            </div>
            <div class="h-80">
                <canvas id="graficaMensual" wire:ignore></canvas>
            </div>
        </div>

        <!-- Gráfica Anual -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-800 flex items-center">
                        <i class="fas fa-chart-bar text-green-500 mr-2"></i>
                        Ventas del Año {{ $añoActual }}
                    </h3>
                    <p class="text-gray-600 text-sm">Comparativo mensual</p>
                </div>
                <div class="text-right">
                    <div class="text-2xl font-bold text-green-600">
                        ${{ number_format($totalAnualDolares, 2) }}
                    </div>
                    <div class="text-sm text-gray-500">Total en dólares</div>
                </div>
            </div>
            <div class="h-80">
                <canvas id="graficaAnual" wire:ignore></canvas>
            </div>
        </div>
    </div>

    <!-- ANÁLISIS DE RENTABILIDAD -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Desglose de Rentabilidad -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-calculator text-blue-500 mr-2"></i>
                Análisis de Rentabilidad
            </h3>
            
            <div class="space-y-4">
                <!-- Explicación del método -->
                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <h4 class="font-bold text-green-800 mb-2 text-sm">📊 MÉTODO DE CÁLCULO</h4>
                    <p class="text-xs text-green-700">
                        <strong>Costo Real:</strong> Se calcula usando el precio de compra promedio de cada producto. 
                        Para productos sin compras registradas, se estima un costo del 60% del precio de venta.
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                        <span class="font-semibold text-gray-700">Ingresos por Ventas</span>
                        <span class="font-bold text-blue-600">${{ number_format($ingresosTotales, 2) }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                        <span class="font-semibold text-gray-700">- Costo Mercancía Vendida</span>
                        <span class="font-bold text-red-600">${{ number_format($costoVentas, 2) }}</span>
                    </div>
                    
                    <div class="border-t border-gray-300 pt-2">
                        <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                            <span class="font-semibold text-gray-700">= Ganancia Bruta Real</span>
                            <span class="font-bold text-green-600">${{ number_format($gananciaBruta, 2) }}</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-orange-50 rounded-lg">
                        <span class="font-semibold text-gray-700">- Inversión Nuevo Inventario</span>
                        <span class="font-bold text-orange-600">${{ number_format($gastosCompras, 2) }}</span>
                    </div>
                    
                    <div class="border-t border-gray-300 pt-2">
                        <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                            <span class="font-semibold text-gray-700">= Flujo de Caja Neto</span>
                            <span class="font-bold text-purple-600">${{ number_format($gananciaNeta, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Métricas de Eficiencia -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-tachometer-alt text-purple-500 mr-2"></i>
                Métricas de Desempeño
            </h3>
            
            <div class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-gray-800">{{ $totalVentasPeriodo }}</div>
                        <div class="text-sm text-gray-600">Total Ventas</div>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-4 text-center">
                        <div class="text-2xl font-bold text-blue-600">${{ number_format($promedioVenta, 2) }}</div>
                        <div class="text-sm text-blue-600">Ticket Promedio</div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                        <span class="font-semibold text-gray-700">Margen Bruto</span>
                        <span class="font-bold text-green-600">
                            {{ $ingresosTotales > 0 ? number_format(($gananciaBruta / $ingresosTotales) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-purple-50 rounded-lg">
                        <span class="font-semibold text-gray-700">Rentabilidad Neta</span>
                        <span class="font-bold text-purple-600">
                            {{ $ingresosTotales > 0 ? number_format(($gananciaNeta / $ingresosTotales) * 100, 1) : 0 }}%
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-orange-50 rounded-lg">
                        <span class="font-semibold text-gray-700">ROI del Período</span>
                        <span class="font-bold text-orange-600">
                            {{ $gastosCompras > 0 ? number_format(($gananciaNeta / $gastosCompras) * 100, 1) : 0 }}%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- INFORMACIÓN ADICIONAL -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Producto Más Vendido -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-trophy text-yellow-500 mr-2"></i>
                Producto Más Vendido
            </h3>
            @if($productoMasVendido)
            <div class="flex items-center justify-between p-4 bg-yellow-50 rounded-xl border border-yellow-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center mr-4">
                        <i class="fas fa-crown text-white"></i>
                    </div>
                    <div>
                        <div class="font-bold text-gray-800">{{ $productoMasVendido->nombre }}</div>
                        <div class="text-sm text-gray-600">{{ $productoMasVendido->total_vendido }} unidades vendidas</div>
                    </div>
                </div>
                <div class="text-right">
                    <div class="font-bold text-green-600">${{ number_format($productoMasVendido->total_ingresos, 2) }}</div>
                    <div class="text-sm text-gray-500">Total generado</div>
                </div>
            </div>
            @else
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-box-open text-3xl mb-2"></i>
                <p>No hay datos de productos vendidos</p>
            </div>
            @endif
        </div>

        <!-- Métodos de Pago -->
        <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-credit-card text-purple-500 mr-2"></i>
                Ventas por Método de Pago
            </h3>
            <div class="space-y-3">
                @forelse($ventasPorMetodoPago as $metodo)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-money-bill text-white text-sm"></i>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-800 capitalize">{{ $metodo->metodo_pago }}</div>
                            <div class="text-xs text-gray-500">{{ $metodo->cantidad }} transacciones</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="font-bold text-purple-600">${{ number_format($metodo->total_dolares, 2) }}</div>
                        <div class="text-xs text-gray-500">{{ number_format(($metodo->total_dolares / max($ingresosTotales, 1)) * 100, 1) }}%</div>
                    </div>
                </div>
                @empty
                <div class="text-center py-4 text-gray-500">
                    <p>No hay datos de métodos de pago</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
// Esperar a que Livewire esté listo
document.addEventListener('livewire:init', function () {
    console.log('✅ Livewire inicializado - Creando gráficas');
    
    if (typeof Chart === 'undefined') {
        console.error('❌ Chart.js no está cargado');
        return;
    }
    
    crearGraficas();
});

function crearGraficas() {
    console.log('🎨 Creando gráficas de rentabilidad...');
    
    // Datos de Livewire
    const ventasMensuales = @json($ventasMensuales);
    const ventasAnuales = @json($ventasAnuales);
    
    console.log('📈 Datos para gráficas:', {ventasMensuales, ventasAnuales});

    // GRÁFICA MENSUAL - VENTAS POR DÍA
    const ctxMensual = document.getElementById('graficaMensual');
    if (ctxMensual) {
        try {
            // Limpiar gráfica anterior
            if (ctxMensual.chart) {
                ctxMensual.chart.destroy();
            }
            
            // Crear array para todos los días del mes (1-31)
            const diasMes = 31;
            const labelsMensual = [];
            const dataMensual = [];
            
            // Inicializar todos los días con 0
            for (let dia = 1; dia <= diasMes; dia++) {
                labelsMensual.push('Día ' + dia);
                dataMensual.push(0);
            }
            
            // Llenar con datos reales
            ventasMensuales.forEach(venta => {
                const dia = parseInt(venta.dia) - 1; // -1 porque los arrays empiezan en 0
                if (dia >= 0 && dia < diasMes) {
                    dataMensual[dia] = parseFloat(venta.total_dolares) || 0;
                }
            });
            
            console.log('📊 Datos gráfica mensual:', dataMensual);
            
            ctxMensual.chart = new Chart(ctxMensual, {
                type: 'line',
                data: {
                    labels: labelsMensual,
                    datasets: [{
                        label: 'Ventas Diarias ($)',
                        data: dataMensual,
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Ventas: $${context.parsed.y.toFixed(2)}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value;
                                }
                            },
                            title: {
                                display: true,
                                text: 'Monto en Dólares'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Días del Mes'
                            }
                        }
                    }
                }
            });
            
            console.log('✅ Gráfica mensual creada');
        } catch (error) {
            console.error('❌ Error en gráfica mensual:', error);
        }
    }

    // GRÁFICA ANUAL - VENTAS POR MES
    const ctxAnual = document.getElementById('graficaAnual');
    if (ctxAnual) {
        try {
            // Limpiar gráfica anterior
            if (ctxAnual.chart) {
                ctxAnual.chart.destroy();
            }
            
            const meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            
            // Inicializar todos los meses con 0
            const dataAnual = Array(12).fill(0);
            
            // Llenar con datos reales
            ventasAnuales.forEach(venta => {
                const mesIndex = parseInt(venta.mes) - 1; // -1 porque los arrays empiezan en 0
                if (mesIndex >= 0 && mesIndex < 12) {
                    dataAnual[mesIndex] = parseFloat(venta.total_dolares) || 0;
                }
            });
            
            console.log('📊 Datos gráfica anual:', dataAnual);
            
            ctxAnual.chart = new Chart(ctxAnual, {
                type: 'bar',
                data: {
                    labels: meses,
                    datasets: [{
                        label: 'Ventas Mensuales ($)',
                        data: dataAnual,
                        backgroundColor: meses.map((_, index) => {
                            // Color diferente para el mes actual (Noviembre)
                            return index === 10 ? 'rgba(239, 68, 68, 0.8)' : 'rgba(34, 197, 94, 0.8)';
                        }),
                        borderColor: meses.map((_, index) => {
                            return index === 10 ? 'rgba(239, 68, 68, 1)' : 'rgba(34, 197, 94, 1)';
                        }),
                        borderWidth: 2,
                        borderRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `Ventas: $${context.parsed.y.toFixed(2)}`;
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return '$' + value;
                                }
                            },
                            title: {
                                display: true,
                                text: 'Monto en Dólares'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Meses del Año'
                            }
                        }
                    }
                }
            });
            
            console.log('✅ Gráfica anual creada');
        } catch (error) {
            console.error('❌ Error en gráfica anual:', error);
        }
    }
}

// También crear gráficas cuando el DOM esté listo
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', crearGraficas);
} else {
    crearGraficas();
}

// Recargar gráficas cuando Livewire actualice
Livewire.hook('morph.updated', (el) => {
    console.log('🔄 Livewire actualizado - Recargando gráficas');
    setTimeout(crearGraficas, 500);
});

// Manejar cambios de fecha específicamente
Livewire.hook('request', ({ succeed }) => {
    succeed(({ status, json }) => {
        // Si fue una actualización de propiedades (como cambiar fechas)
        setTimeout(crearGraficas, 300);
    });
});
</script>