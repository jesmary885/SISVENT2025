 <div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 p-6">
        <!-- Header Elegante -->


        <!-- Stats Cards Mejoradas - Mismas variables -->
        <div class="mx-auto">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                
                <!-- Ganancias del Día -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500 to-purple-600 rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-300"></div>
                    <div class="relative bg-white rounded-2xl p-6 shadow-lg border border-purple-100 transform transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mr-4 shadow-md">
                                <i class="fas fa-chart-line text-white text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-bold text-gray-800 text-lg">Bs {{$ganancia_dia_bs}}</span>
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded border border-yellow-300">
                                        $ {{$ganancia_dia_dol}}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500 font-medium">Ganancias del día</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ganancias del Mes -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-300"></div>
                    <div class="relative bg-white rounded-2xl p-6 shadow-lg border border-blue-100 transform transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mr-4 shadow-md">
                                <i class="fas fa-calendar-alt text-white text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="font-bold text-gray-800 text-lg">Bs {{$ganancia_mes_bs}}</span>
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded border border-yellow-300">
                                        $ {{$ganancia_mes_dol}}
                                    </span>
                                </div>
                                <div class="text-sm text-gray-500 font-medium">Ganancias del mes</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Ventas del Día -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-300"></div>
                    <div class="relative bg-white rounded-2xl p-6 shadow-lg border border-green-100 transform transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mr-4 shadow-md">
                                <i class="fas fa-shopping-cart text-white text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-2xl font-bold text-gray-800 mb-1">{{$ventas_dia}}</div>
                                <div class="text-sm text-gray-500 font-medium">Ventas del día</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tasa del Día -->
                <div class="group relative">
                    <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-red-600 rounded-2xl blur opacity-20 group-hover:opacity-30 transition duration-300"></div>
                    <div class="relative bg-white rounded-2xl p-6 shadow-lg border border-red-100 transform transition-all duration-300 group-hover:scale-105 group-hover:shadow-xl">
                        <div class="flex items-center">
                            <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mr-4 shadow-md">
                                <i class="fas fa-exchange-alt text-white text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="text-2xl font-bold text-gray-800 mb-1">{{$tasa_dia}}</div>
                                <div class="text-sm text-gray-500 font-medium">Tasa Bs / USD</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Secciones adicionales opcionales -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Ventas Recientes -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-star text-yellow-600   mr-2"></i>
                        Productos más vendidos
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-bolt text-white text-xs"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">Venta rápida</div>
                                    <div class="text-xs text-gray-500">Hace 15 min</div>
                                </div>
                            </div>
                            <div class="text-green-600 font-bold text-sm">+$45</div>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-users text-white text-xs"></i>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-800">Cliente frecuente</div>
                                    <div class="text-xs text-gray-500">Hace 1 hora</div>
                                </div>
                            </div>
                            <div class="text-green-600 font-bold text-sm">+$120</div>
                        </div>
                    </div>
                </div>

                <!-- Acciones Rápidas -->
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-200">
                    <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-rocket text-purple-500 mr-2"></i>
                        Acciones Rápidas
                    </h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="p-3 bg-blue-50 hover:bg-blue-100 rounded-lg transition duration-200 flex items-center justify-center flex-col">
                            <i class="fas fa-plus-circle text-blue-500 text-lg mb-1"></i>
                            <span class="text-sm font-medium text-gray-700">Nueva Venta</span>
                        </button>
                        <button class="p-3 bg-green-50 hover:bg-green-100 rounded-lg transition duration-200 flex items-center justify-center flex-col">
                            <i class="fas fa-box text-green-500 text-lg mb-1"></i>
                            <span class="text-sm font-medium text-gray-700">Inventario</span>
                        </button>
                        <button class="p-3 bg-purple-50 hover:bg-purple-100 rounded-lg transition duration-200 flex items-center justify-center flex-col">
                            <i class="fas fa-chart-bar text-purple-500 text-lg mb-1"></i>
                            <span class="text-sm font-medium text-gray-700">Reportes</span>
                        </button>
                        <button class="p-3 bg-orange-50 hover:bg-orange-100 rounded-lg transition duration-200 flex items-center justify-center flex-col">
                            <i class="fas fa-cog text-orange-500 text-lg mb-1"></i>
                            <span class="text-sm font-medium text-gray-700">Configuración</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Animaciones suaves */
        .group:hover .transform {
            transform: translateY(-2px);
        }
    </style>