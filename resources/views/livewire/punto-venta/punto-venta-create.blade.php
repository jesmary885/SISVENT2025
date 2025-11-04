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
<div class=" bg-gray-200 flex items-center justify-center ">
    <div class=" w-full mx-auto py-2">
        <div class="flex flex-col lg:flex-row w-full lg:space-x-2 space-y-2 lg:space-y-0 mb-2 lg:mb-4">

            <div class="w-full lg:w-1/5">
                <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-purple-400">
                    <div class="flex items-center">
                        <div class="icon w-14 p-3.5 bg-purple-400 text-white rounded-full mr-3">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-lg">230k</div>
                            <div class="text-sm text-gray-400">Sales</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/5">
                <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-blue-400">
                    <div class="flex items-center">
                        <div class="icon w-14 p-3.5 bg-blue-400 text-white rounded-full mr-3">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-lg">3456</div>
                            <div class="text-sm text-gray-400">Customers</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/5">
                <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-yellow-400">
                    <div class="flex items-center">
                        <div class="icon w-14 p-3.5 bg-yellow-400 text-white rounded-full mr-3">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-lg">3456</div>
                            <div class="text-sm text-gray-400">Products</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/5">
                <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-red-400">
                    <div class="flex items-center">
                        <div class="icon w-14 p-3.5 bg-red-400 text-white rounded-full mr-3">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-lg">12658</div>
                            <div class="text-sm text-gray-400">Orders</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/5">
                <div class="widget w-full p-4 rounded-lg bg-white border-l-4 border-green-400">
                    <div class="flex items-center">
                        <div class="icon w-14 p-3.5 bg-green-400 text-white rounded-full mr-3">
                            <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-center">
                            <div class="text-lg">$948'560</div>
                            <div class="text-lg text-gray-800 font-bold">TOTAL A PAGAR</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

		<div class="  px-1 lg:p-1 rounded-md">

            <div class=" w-full h-full">
                <div class="container mx-auto">
        
                        <div aria-label="action panel"  tabindex="0" class="focus:outline-none w-full shadow-xl py-4 px-4 bg-white dark:bg-gray-800 rounded-md">

                            <div class="flex" >

                                <p tabindex="0" class="focus:outline-none text-lg text-gray-800 dark:text-gray-100 font font-semibold pb-3 mr-3">Cliente general</p>
                                <div class="w-12 h-6 cursor-pointer rounded-full relative shadow-sm">
                                    <input aria-label="subscribe"
                                    type="checkbox"
                                    value='1'
                                    name="cliente_general"
                                    wire:model.defer="cliente_general"
                                    id="cliente_general"
                                    class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-600 focus:outline-none checkbox w-4 h-4 rounded-full bg-white absolute m-1 shadow-sm appearance-none cursor-pointer" />
                                    <label for="cliente_general" class="toggle-label bg-gray-200 block w-12 h-6 overflow-hidden rounded-full bg-gray-300 cursor-pointer"></label>
                                </div>

                            </div>

                            <hr class="text-gray-300" >

                            <div class="mt-4">
                                <input wire:model="search" type="text" id="simple-search" class="focus:outline-none bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-t-2xl  focus:ring-blue-500 focus:border-blue-500 block w-full ps-3 px-1 py-2  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingrese el nombre o código de barra del producto" required />
                                
                                 <div class="hidden" :class="{ 'hidden' : !$wire.open }" @click.away="$wire.open = false">
                                    <div class="rounded-b-lg bg-amber-200 shadow-2xl">
                                        <div class="px-3 py-2"> <!-- Reducido padding -->
                                            @forelse ($registros as $registro)
                                                <div class="flex items-center justify-between mb-2 p-3 bg-white/20 backdrop-blur-lg rounded-xl border border-white/30 hover:bg-white/25 transition-all"> <!-- Reducido padding -->
                                                    <div class="flex-1 min-w-0"> <!-- Added min-w-0 for text truncation -->
                                                        <h3 class=" font-semibold text-sm truncate">{{$registro->nombre}}</h3> <!-- Texto más pequeño -->
                                                        <div class="flex items-center gap-3  text-xs mt-1"> <!-- Texto más pequeño -->
                                                            <span class="font-bold">Bs {{$this->precio_bolivares($registro->precio_venta)}}</span>
                                                            <span class=" bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">REF {{$registro->precio_venta}}</span>
                                                        </div>
                                                    </div>
                                                    
                                                    <!-- Componente de cantidades adaptado -->
                                                    <div class="text-white ml-2">
                                                        @livewire('punto-venta.punto-venta-cantidades', ['registro' => $registro], key($registro->id))
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="text-center py-4 bg-white/30 backdrop-blur rounded-xl"> <!-- Reducido padding -->
                                                    <p class="text-gray-700 text-sm font-semibold">Sin registros</p> <!-- Texto más pequeño -->
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>

                                 {{-- @if ($registros )


                                    <div class=" bg-white ">
                                        <div class=" overflow-x-auto rounded-b-2xl  border-2 border-gray-300  ">
                                                <table class=" text-sm   text-gray-700 min-w-full shadow-md">
                                                    <thead class="text-sm text-gray-60 uppercase bg-gray-300 ">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-1 text-sm lg:text-md">
                                                                Producto
                                                            </th>
                                                     
                                                           
                                                            <th scope="col" class="px-6 py-1 text-sm lg:text-md">
                                                                Precio
                                                            </th>
                                                   
                                                        
                                                            <th  class="px-6 py-1 text-sm lg:text-md">
                                                            
                                                            </th>
                                                    
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($registros as $registro)
                                                                    
                                                            <tr class="bg-white text-center   hover:bg-gray-100 dark:hover:bg-gray-600">
                                                                <th scope="row" class="px-2 py-2 break-words max-w-xs whitespace-normal  text-center font-medium text-gray-900 dark:text-white text-sm md:text-base">
                                                                    {{$registro->nombre}}
                                                                </th>
                                      
                                                           
                                                                <td class="px-2 py-2 text-sm lg:text-base text-center">

                                                                    <p class="font-semibold inline ">  Bs {{$this->precio_bolivares($registro->precio_venta)}}</p>
                                                                    <span class="bg-green-200 text-green-800 text-xs font-medium px-2 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400"> {{$registro->precio_venta}}$</span>


                                                               
                                                                </td>
                                                             
                                                                <td class="mr-2 px-2 py-2" >

                                                                      @livewire('punto-venta.punto-venta-cantidades', ['registro' => $registro],key(01.,'$registro->id'))
                                                                  
                                                                </td>


                                                                
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                        </div>

                                    </div>

                                @endif --}}
                            
                            
                            
                                </div>
                            
                            
                        </div>

                </div>
            </div>


		</div>


		<div class=" px-1 lg:p-1 rounded-md">

            <div class=" w-full h-full">
                <div class="container mx-auto">

                    {{-- <div class="bg-red-100 justify-center text-center text-red-800   text-2xl font-medium px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300" >
                        FACTURACIÓN
                    </div> --}}

                    

                      @if ($registros_carro )


                                    <div class=" bg-white ">
                                        <div class=" overflow-x-auto rounded-t-2xl border-2 border-gray-300  ">
                                                <table class=" text-sm   text-gray-700 min-w-full shadow-md">
                                                    <thead class="text-sm text-gray-60 uppercase bg-gray-300 ">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-1 text-sm lg:text-md">
                                                                Producto
                                                            </th>
                                                            <th scope="col" class="px-6 py-1 text-sm lg:text-md">
                                                                Cantidad
                                                            </th>
                                                           
                                                            <th scope="col" class="px-6 py-1 text-sm lg:text-md">
                                                                Subtotal
                                                            </th>
                                                   
                                                        
                                                            <th  class="px-6 py-1 text-sm lg:text-md">
                                                            
                                                            </th>
                                                    
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($registros_carro as $registro_c)
                                                                    
                                                            <tr class="bg-white text-center   hover:bg-gray-100 dark:hover:bg-gray-600 border-b-2 border-gray-200">
                                                                <th scope="row" class="px-2 py-1 break-words max-w-xs whitespace-normal  text-center font-medium text-gray-900 dark:text-white text-sm md:text-base">
                                                                    {{$registro_c->producto->nombre}}
                                                                </th>
                                                                <td class="px-2 py-1 text-sm lg:text-base text-center">
                                                                    {{$registro_c->cantidad}}
                                                                </td>
                                                            
                                                           
                                                                <td class="px-2 py-1 text-sm lg:text-base text-center">

                                                                     <p class="font-semibold inline ">  Bs {{$this->subtotal_bol($registro_c->producto_id,$registro_c->cantidad)}}</p>
                                                                    <span class="bg-green-200 text-green-800 text-xs font-medium px-2 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">{{$this->subtotal_dol($registro_c->producto_id,$registro_c->cantidad)}}$</span>

                                                                
                                                                </td>
                                                             
                                                                <td class="mr-2 px-2 py-1" >
                                                                    <button
                                                                        class="btn btn-danger btn-sm cursor-pointer" 
                                                                        wire:click="delete('{{$registro_c->id}}')"
                                                                        wire:loading.class="text-red-600 opacity-25"
                                                                        title="Eliminar">
                                                                        

                                                                        <img src="{{Storage::url('imagen/eliminar.png')}}" alt="icono" class=" w-8 h-8">

                                                                    
                                                                    </button>
                                                                </td>



                                                                
                                                            </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                
                                                
                                        </div>
                                        <div class="rounded-b-2xl bg-gray-100 flex px-3 py-2 justify-end border-2 border-gray-300 w-full ">

                                                    <p class="font-bold text-xl mr-4 mt-1 " >
                                                        TOTAL A PAGAR 
                                                    </p>

                                                    <div class="bg-yellow-100 text-yellow-800 text-xl font-medium  px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">
                                                             <p class="font-semibold inline mr-1">  Bs {{$this->total_pagar_bs()}}</p>
                                                    <span class="bg-green-200 text-green-800 text-xs font-medium px-2 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">{{$this->total_pagar_global()}}$</span>
                                                    </div>

                                                   

                                                </div>

                                    </div>

                                @endif

                </div>
            </div>




		
		</div>
	{{-- </div> --}}

    



</div>
