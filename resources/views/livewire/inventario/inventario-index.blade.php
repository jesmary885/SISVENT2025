<div class="w-full  p-2" >

 



    <div class="flex items-center mt-4 mx-auto w-3/4   justify-center ">   
        <label for="simple-search" class="sr-only">Search</label>

         
        <div class="relative w-full flex justify-between">

             
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                </svg>
            </div>
            <input autofocus wire:model="search" type="text" id="simple-search" class="focus:outline-none bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingrese nombre del producto a buscar..." required />
        
         @livewire('inventario.inventario-create', ['tipo' => 'agregar'])
        </div>
    
    </div>
    
        @if ($registros->count())

        <div class="mt-4 bg-white rounded-2xl p-4 mx-2 md:mx-4">
            <div class=" overflow-x-auto rounded-2xl border-2 border-gray-400  ">
                <table class=" text-sm   text-gray-700 min-w-full shadow-md">
                    <thead class="text-sm text-gray-60 uppercase bg-gray-300 ">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Nombre
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Cantidad
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Cód de barra
                            </th>

                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Marca
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Precio de venta
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Fecha de vencimiento
                            </th>
                        
                            <th  class="px-6 py-3 text-sm lg:text-md">
                            
                            </th>
                            <th  class="px-6 py-3 text-sm lg:text-md">
                            
                            </th>

                            
                            <th  class="px-6 py-3 text-sm lg:text-md">
                            
                            </th>
                            <th  class="px-6 py-3 text-sm lg:text-md">
                            
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
                                    {{$registro->cantidad}}
                                </td>
                            
                                <td class="px-2 py-2 text-sm lg:text-base text-center">
                                    {{$registro->cod_barra}}
                                </td>
                             
                                <td class="px-2 py-2 text-sm lg:text-base text-center">
                                {{$registro->marca->nombre}}
                                </td>
                                <td class="px-2 py-2 text-sm lg:text-base text-center">
                                {{$registro->precio_venta}}
                                </td>
                                <td class="px-2 py-2 text-sm lg:text-base text-center">
                                {{$registro->vencimiento}}
                                </td>
                        
                            <td class="mr-2 px-2 py-2" >
                                    @livewire('inventario.inventario-add', ['registro' => $registro],key(01.,'$registro->id'))
                                </td>

                                <td class="mr-2 px-2 py-2" >
                                    @livewire('inventario.inventario-create', ['registro' => $registro,'tipo' => 'editar'],key(01.,'$registro->id'))
                                </td>

                                <td  class="mr-2 px-2 py-2">
                                    @livewire('inventario.inventario-barcode', ['registro' => $registro],key(03.,'$registro->id'))
                                </td> 

                                <td class=" px-2 py-2">
                                    <button
                                        class="btn btn-danger btn-sm cursor-pointer" 
                                        wire:click="delete('{{$registro->id}}')"
                                        title="Eliminar">

                                        <img src="{{Storage::url('imagen/eliminar.png')}}" alt="icono" class=" w-10 h-10">

                                    
                                    </button>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>


        @else

         <div class="mt-4 bg-white rounded-2xl p-4 mx-2 md:mx-4 text-center ">

            <p  class="text-sm text-gray-700">No hay registros en sistema</p>

        </div>


       
        @endif
        
</div>