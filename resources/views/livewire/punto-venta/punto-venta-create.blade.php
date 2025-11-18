<div>

    <style>
                                .checkbox:checked {
                                    /* Apply class right-0*/
                                    right: 0;
                                }
                                .checkbox:checked + .toggle-label {
                                    /* Apply class bg-indigo-700 */
                                    background-color: #4c51bf;
                                }
                            </style>
  

    {{-- <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:gap-4 "> --}}

        <!-- component -->
        <div class="bg-gray-200  flex items-center justify-center">
            <div class="w-full mx-auto py-2">
                <div class="flex flex-col sm:flex-col md:flex-row w-full md:space-x-2 space-y-2 md:space-y-0 mb-2 md:mb-4">
                    
                    <!-- Primera caja -->
                    <div class="w-full sm:w-full md:w-1/4 min-h-[100px] sm:min-h-[110px] md:min-h-[120px] flex">
                        <div class="widget w-full p-3 sm:p-4 rounded-lg bg-white border-l-4 border-purple-400 flex items-center flex-1">
                            <div class="flex items-center w-full">
                                <div class="icon w-10 sm:w-12 md:w-14 lg:w-20 p-2 sm:p-3 md:p-3.5 bg-purple-400 text-white rounded-full mr-2 sm:mr-3">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col justify-center flex-1">
                                    <div class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-800 text-center font-bold">VENTA NRO.</div>
                                    <div class="text-xs sm:text-sm md:text-lg text-gray-400 text-center">{{$venta_nro}}</div>
                                </div>
                            </div>
                        </div>
                    </div>

         

                    <!-- Tercera caja -->
                    <div class="w-full sm:w-full md:w-1/4 min-h-[100px] sm:min-h-[110px] md:min-h-[120px] flex">
                        <div class="widget w-full p-3 sm:p-4 rounded-lg bg-white border-l-4 border-yellow-400 flex items-center flex-1">
                            <div class="flex items-center w-full">
                                <div class="icon w-10 sm:w-12 md:w-14 lg:w-20 p-2 sm:p-3 md:p-3.5 bg-yellow-400 text-white rounded-full mr-2 sm:mr-3">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </div>
                                <div class="flex flex-col justify-center flex-1">
                                    <div class="text-sm sm:text-base md:text-xl text-gray-800 text-center font-bold mb-1 sm:mb-2">CANTIDAD</div>
                                    @if($cant_producto)
                                    <div class="text-xs sm:text-sm md:text-lg text-gray-400 text-center">{{$cant_producto}} productos</div>
                                    @else
                                    <div class="text-xs sm:text-sm md:text-lg text-gray-400 text-center">NO HAY VENTA ACTIVA</div>

                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cuarta caja (Total) -->
                  

                    <!-- Quinta caja (Botón) -->
                    <div class="w-full sm:w-full md:w-1/4 min-h-[100px] sm:min-h-[110px] md:min-h-[120px] flex">
                        <div class="widget w-full  rounded-lg bg-white border-l-4 border-purple-700  flex items-center justify-center flex-1">
                            @if($cant_producto)
                            @livewire('punto-venta.punto-venta-finalizar')
                            @else

                            <div class="text-xs sm:text-sm md:text-lg text-gray-400 text-center">NO HAY VENTA ACTIVA</div>

                            @endif
                        </div>
                    </div>


                      <div class="w-full sm:w-full md:w-1/4 min-h-[100px] sm:min-h-[110px] md:min-h-[120px] flex ">
                        <div class="widget w-full p-2 sm:p-3 rounded-lg bg-white border-l-4 border-green-400 flex items-center flex-1">
                            <div class="flex flex-col justify-center w-full text-center">
                                <div class="text-sm sm:text-base md:text-xl text-gray-800 font-bold mb-1 sm:mb-2">TOTAL A PAGAR</div>
                                <div class="bg-yellow-100 text-yellow-800 shadow-sm text-sm sm:text-base md:text-lg font-medium px-1 sm:px-2 py-1 rounded-sm border border-yellow-300">
                                   <p class="font-bold text-xs sm:text-sm md:text-2xl">Bs {{ number_format($this->total_bs, 2, ',', '.') }}</p>
                                    <span class="bg-green-200 text-green-800 text-md md:text-xl font-medium px-1 sm:px-2 rounded-sm border border-green-400">
                                        REF. {{ number_format($this->total_global, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

		<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-2 lg:p-3 bg-gray-50 rounded-xl">
    
    <!-- Panel de Búsqueda y Productos -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-4 lg:p-6">
        <!-- Header con Toggle -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-3">
                <i class="fas fa-user text-blue-500 text-lg"></i>
                <p class="text-xl font-bold text-gray-800">Cliente General</p>
            </div>
            <div class="relative inline-block w-12 h-6">
                <input 
                    type="checkbox"
                    value='1'
                    name="cliente_general"
                    wire:model.defer="cliente_general"
                    id="cliente_general"
                    class="sr-only"
                />
                <label 
                    for="cliente_general" 
                    class="block w-12 h-6 rounded-full cursor-pointer transition-all duration-300 ease-in-out
                           {{ $cliente_general ? 'bg-blue-500' : 'bg-gray-300' }}"
                >
                    <span class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full transition-all duration-300 ease-in-out
                                 {{ $cliente_general ? 'transform translate-x-6' : '' }}"></span>
                </label>
            </div>
        </div>

        <hr class="border-gray-200 mb-6">

        <!-- Barra de Búsqueda -->
           <div class="relative mb-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <!-- Agregar debounce -->
                <!-- Cerrar con ESC -->
                <input 
                    wire:model.debounce.300ms="search" 
                    wire:keydown.escape="open = false"   
                    type="text" 
                    class="w-full pl-10 pr-4 py-4 bg-gray-100 border-0 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg transition-all duration-300 placeholder-gray-500 shadow-sm"
                    placeholder="Buscar producto por nombre o código..."
                />
            </div>

        <!-- Lista de Productos -->
        <div class="{{ $open ? '' : 'hidden' }}" x-show="$wire.open" @click.away="$wire.open = false">
            <div class="mt-2 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl shadow-lg border border-amber-200">
                <div class="p-4 max-h-96 overflow-y-auto">
                    @forelse ($registros as $registro)
                        <div class="flex items-center justify-between mb-3 p-4 bg-white/80 backdrop-blur-sm rounded-xl border border-amber-100 hover:bg-white hover:shadow-md transition-all duration-300 group">
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-800 text-sm truncate group-hover:text-blue-600">{{$registro->nombre}}</h3>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="font-bold text-gray-900">Bs {{ number_format($this->precio_bolivares($registro->precio_venta), 2, ',', '.') }}</span>
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-medium px-3 py-1 rounded-full border border-yellow-300">
                                        $ {{ number_format($registro->precio_venta, 2, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Componente de cantidades -->
                            <div class="ml-3">
                                @livewire('punto-venta.punto-venta-cantidades', ['registro' => $registro], key($registro->id))
                            </div>
                        </div>
                    @empty
                        @if($search) <!-- Solo mostrar vacío si hay búsqueda -->
                            <div class="text-center py-6 bg-white/50 rounded-xl">
                                <i class="fas fa-search text-gray-400 text-2xl mb-2"></i>
                                <p class="text-gray-600 font-semibold">No se encontraron productos</p>
                            </div>
                        @endif
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Carrito de Compras -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-4 lg:p-6">
        @if ($registros_carro)
            <div class="mb-4 flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-shopping-cart text-green-500 text-lg"></i>
                    <h2 class="text-xl font-bold text-gray-800">Carrito de Compras</h2>
                </div>
                <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                    {{ count($registros_carro) }} items
                </span>
            </div>

            <div class="overflow-hidden rounded-2xl border border-gray-200 shadow-sm">
                <table class="w-full text-sm text-gray-700">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100 text-gray-700 uppercase">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-sm">Producto</th>
                            <th class="px-4 py-3 text-center font-semibold text-sm">Cantidad</th>
                            <th class="px-4 py-3 text-center font-semibold text-sm">Subtotal</th>
                            <th class="px-4 py-3 text-center font-semibold text-sm">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($registros_carro as $registro_c)
                            <tr class="bg-white hover:bg-blue-50 transition-colors duration-200 group">
                                <td class="px-4 py-3">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center mr-3">
                                            <i class="fas fa-box text-white text-xs"></i>
                                        </div>
                                        <span class="font-medium text-gray-800 text-sm">{{$registro_c->producto->nombre}}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-800">
                                        {{$registro_c->cantidad}}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex flex-col items-center space-y-1">
                                        <!-- En el carrito -->
                                        <span class="font-bold text-gray-900">Bs {{ number_format($this->subtotal_bol($registro_c->producto_id,$registro_c->cantidad), 2, ',', '.') }}</span>
                                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2 py-1 rounded-full border border-green-300">
                                            REF. ${{ number_format($this->subtotal_dol($registro_c->producto_id,$registro_c->cantidad), 2, ',', '.') }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <button
                                        wire:click="delete('{{$registro_c->id}}')"
                                        wire:loading.class="opacity-50"
                                        class="w-10 h-10 bg-red-500 hover:bg-red-600 text-white rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 group-hover:shadow-lg"
                                        title="Eliminar del carrito"
                                    >
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else
            <!-- Estado vacío del carrito -->
            <div class="text-center py-12">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shopping-cart text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-600 mb-2">Carrito Vacío</h3>
                <p class="text-gray-500 text-sm">Agrega productos desde el panel de búsqueda</p>
            </div>
        @endif
    </div>
</div>
</div>
