<div>
   @if ($registros->count())

        <div class="mt-4 bg-white rounded-2xl p-4 mx-2 md:mx-4">
            <div class=" overflow-x-auto rounded-2xl border-2 border-gray-400  ">
                <table class=" text-sm   text-gray-700 min-w-full shadow-md">
                    <thead class="text-sm text-gray-60 uppercase bg-gray-300 ">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Fecha
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Cant. de productos
                            </th>
                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Método de pago
                            </th>

                            <th scope="col" class="px-6 py-3 text-sm lg:text-md">
                                Total
                            </th>
  
                            <th  class="px-6 py-3 text-sm lg:text-md">
                            
                            </th>
              
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($registros as $registro)
                                    
                            <tr class="bg-white text-center   hover:bg-gray-100 dark:hover:bg-gray-600">
                                <th scope="row" class="px-2 py-2 break-words max-w-xs whitespace-normal  text-center font-medium text-gray-900 dark:text-white text-sm md:text-base">
                                    {{$registro->created_at}}
                                </th>
                                <td class="px-2 py-2 text-sm lg:text-base text-center">
                                    {{$this->cant_productos($registro)}}
                                </td>
                            
                                <td class="px-2 py-2 text-sm lg:text-base text-center">

    
                                    @if($registro->metodo_pago == 'pago_movil')
                                    Pago móvil
                                    @endif
                                      @if($registro->metodo_pago == 'debito')
                                    Débito
                                    @endif
                                    @if($registro->metodo_pago == 'dol_efec')
                                    Dólares en efectivo
                                    @endif
                                    @if($registro->metodo_pago == 'bs_efec')
                                    Bolívares en efectivo
                                    @endif
                                    @if($registro->metodo_pago == 'USDT')
                                    usdt
                                    @endif

                                </td>
                             
                                <td class="px-2 py-2 text-sm lg:text-base text-center">
                                 <p class="font-semibold inline ">  Bs {{$this->subtotal_bol($registro)}}</p>
                                <span class="bg-green-200 text-green-800 text-xs font-medium px-2 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">REF. {{$this->subtotal_dol($registro)}}</span>
                                </td>
                   
                        
                                <td class="mr-2 px-2 py-2" >
                                    @livewire('ventas.venta-view', ['venta' => $registro],key(01.,'$registro->id'))
                                </td>


                                {{-- <td class=" px-2 py-2">
                                    <button
                                        class="btn btn-danger btn-sm cursor-pointer" 
                                        wire:click="delete('{{$registro->id}}')"
                                        title="Eliminar">

                                        <img src="{{Storage::url('imagen/eliminar.png')}}" alt="icono" class=" w-10 h-10">

                                    
                                    </button>
                                </td> --}}
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
