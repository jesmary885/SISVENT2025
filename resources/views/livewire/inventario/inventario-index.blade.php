<div class="w-full p-4 bg-gradient-to-br bg-gray-200 ">
    <!-- Header Mejorado -->
    <div class="text-center mb-8">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg mb-4">
            <i class="fas fa-boxes text-2xl text-blue-600"></i>
        </div>
        <h1 class="text-4xl font-bold text-gray-800 mb-3">Gestión de Inventario</h1>
        <p class="text-gray-600 text-lg">Controla y administra tu stock de productos</p>
    </div>

    <!-- Barra de Búsqueda Mejorada -->
    <div class=" mx-auto mb-8">
        <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-200">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <!-- Buscador -->
                <div class="flex-1 relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input 
                        wire:model="search"
                        type="text" 
                        class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-lg transition-all duration-300"
                        placeholder="Buscar producto por nombre..."
                    />
                </div>
                
                <!-- Botón Agregar -->
                <div class="w-full lg:w-auto">
                    @livewire('inventario.inventario-create', ['tipo' => 'agregar'])
                </div>
            </div>
        </div>
    </div>

    @if($registros->count())
    <!-- Tabla Mejorada -->
    <div class=" mx-auto">
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <!-- Header de la tabla -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <i class="fas fa-list text-white text-xl mr-3"></i>
                        <h2 class="text-xl font-bold text-white">Productos Registrados</h2>
                    </div>
                    <span class="bg-white text-blue-600 px-3 py-1 rounded-full text-sm font-bold">
                        {{ $registros->count() }} productos
                    </span>
                </div>
            </div>

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold text-gray-700">Producto</th>
                            <th class="px-6 py-4 text-center font-semibold text-gray-700">Stock</th>
                            <th class="px-6 py-4 text-center font-semibold text-gray-700">Código</th>
                            <th class="px-6 py-4 text-center font-semibold text-gray-700">Marca</th>
                            <th class="px-6 py-4 text-center font-semibold text-gray-700">Precio</th>
                            <th class="px-6 py-4 text-center font-semibold text-gray-700">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($registros as $registro)
                        <tr class="hover:bg-blue-50 transition-colors duration-200 group">
                            <!-- Producto -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                                        <i class="fas fa-box text-white"></i>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-800 group-hover:text-blue-600">{{ $registro->nombre }}</p>
                                        <p class="text-sm text-gray-500">ID: {{ $registro->id }}</p>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Stock -->
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold 
                                    {{ $registro->cantidad > 20 ? 'bg-green-100 text-green-800' : 
                                       ($registro->cantidad > 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    <i class="fas fa-cubes mr-2"></i>
                                    {{ $registro->cantidad }} unidades
                                </span>
                            </td>
                            
                            <!-- Código -->
                            <td class="px-6 py-4 text-center">
                                <code class="bg-gray-100 text-gray-800 px-3 py-1 rounded-lg font-mono text-sm">
                                    {{ $registro->cod_barra }}
                                </code>
                            </td>
                            
                            <!-- Marca -->
                            <td class="px-6 py-4 text-center">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-lg font-medium">
                                    {{ $registro->marca->nombre }}
                                </span>
                            </td>
                            
                            <!-- Precio -->
                            <td class="px-6 py-4 text-center">
                                <p class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-3 py-2 rounded-lg font-bold text-sm">
                                    Bs {{$this->total_venta_bs($registro->precio_venta)}}

                                    <span class="bg-green-200 text-green-800 text-xs font-medium px-2 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400"> ${{ number_format($registro->precio_venta, 2) }}</span>
                                </p>




                                    
                                    

                            </td>
                            
                            <!-- Acciones -->
                            <td class="px-6 py-4">
                                <div class="flex justify-center space-x-2">
                                    @livewire('inventario.inventario-add', ['registro' => $registro], key('add-'.$registro->id))
                                    
                                    @livewire('inventario.inventario-create', ['registro' => $registro,'tipo' => 'editar'], key('edit-'.$registro->id))
                                    
                                    @livewire('inventario.inventario-barcode', ['registro' => $registro], key('barcode-'.$registro->id))
                                    
                                    <button
                                        wire:click="delete('{{$registro->id}}')"
                                        class="w-10 h-10 bg-red-500 cursor-pointer hover:bg-red-600 text-white rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110"
                                        title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <!-- Estado vacío mejorado -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-xl p-12 text-center border border-gray-200">
            <div class="w-24 h-24 bg-gradient-to-br from-gray-200 to-gray-300 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-box-open text-gray-500 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Inventario Vacío</h3>
            <p class="text-gray-600 mb-6 text-lg">No hay productos registrados en el sistema. Comienza agregando tu primer producto.</p>
            <div class="flex justify-center">
                @livewire('inventario.inventario-create', ['tipo' => 'agregar'])
            </div>
        </div>
    </div>
    @endif
</div>