<div class=" font-Arima " >

    <style>
      
        .icon::after{
        content: '';
        display: block;
        position: absolute;
        border-top: 17px solid transparent;
        border-bottom: 15px solid transparent;
        border-left: 14px solid rgb(37 99 235 / var(--tw-bg-opacity));
        left: 100%;
        top: 0;
      }
      
      input[type="file"] {
              display: none;
          }
      
          .custom-file-upload {
          border: 1px solid #ccc;
         
          padding: 6px 12px;
          cursor: pointer;
          }


        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
 
      
    </style>

    <button type="button" wire:click="$set('open',true)" type="button" wire:loading.attr="disabled" class=" cursor-pointer text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-1  text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

        <img src="{{Storage::url('imagen/ver.png')}}" alt="icono" class="w-12 h-10">
    </button>



    <x-dialog-modal wire:model="open" maxWidth="3xl">

        <x-slot name="title">
            <div class=" flex justify-between ">



                <p></p>

            

                <button type="button" wire:click="close" wire:loading.attr="disabled"  class=" cursor-pointer  py-2.5 px-3 me-2 mb-2 text-sm font-bold text-white focus:outline-none bg-black rounded-full border border-gray-200 hover:bg-gray-100 hover:text-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100  ">
                    X
                </button>





            </div>
            
        </x-slot>

        <x-slot name="content">

            <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-lg overflow-hidden border border-gray-200">
    <!-- Encabezado de la factura -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-700 px-8 py-6 text-gray-800">
        <div class="flex justify-between items-start">
            <div>
      

            </div>
            <div class="text-right">
       
                <div class="text-2xl font-bold text-white">#F-{{$venta->id}}</div>
                <p class="text-white text-sm">{{ \Carbon\Carbon::parse($venta->created_at)->format('d/m/Y \\a \\l\\a\\s h:i A') }}</p>
            </div>
        </div>
    </div>

    <!-- Información del cliente y empresa -->
    <div class="px-8 py-6 border-b border-gray-200">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">


            <!-- Información del cliente -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3">CLIENTE</h3>
                <div class="space-y-1 text-gray-600">
                    <p class="font-medium text-gray-900">Cliente General</p>
                    {{-- <p>RUC/Cédula: 1234567890</p>
                    <p>Av. Los Olivos #456</p>
                    <p>Ciudad, Estado 1002</p>
                    <p>Tel: (098) 765-4321</p>
                    <p>juan.perez@email.com</p> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Detalles de los productos -->
    <div class="px-8 py-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">DETALLES DE LA FACTURA</h3>
        
        <div class="overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b-2 border-gray-200">
                        <th class="py-3 px-4 text-left text-sm font-semibold text-gray-700">Producto</th>
                        <th class="py-3 px-4 text-center text-sm font-semibold text-gray-700">Cantidad</th>
                        <th class="py-3 px-4 text-right text-sm font-semibold text-gray-700">Precio Unit.</th>
                        <th class="py-3 px-4 text-right text-sm font-semibold text-gray-700">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                    @foreach($productos as $producto)
              
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-4 px-4">
                                <div>
                                    <p class="font-medium text-gray-900">{{$producto->producto->nombre}}</p>
                                    
                                </div>
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">{{$producto->cantidad}}</span>
                            </td>
                            <td class="py-4 px-4 text-right">
                                <p class="font-semibold inline ">  Bs {{$producto->precio_bolivares}}</p>
                                                                    <span class="bg-green-200 text-green-800 text-xs font-medium px-2 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">REF. {{$producto->precio_dolares}}</span>
                            </td>
                            <td class="py-4 px-4 text-right">
                               <p class="font-semibold inline ">  Bs {{($producto->precio_bolivares * $producto->cantidad)}}</p>
                                                                    <span class="bg-green-200 text-green-800 text-xs font-medium px-2 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">REF. {{($producto->precio_dolares * $producto->cantidad)}}</span>
                            </td>
                        </tr>

                    @endforeach


                </tbody>
            </table>
        </div>
    </div>

    <!-- Totales -->
    <div class="px-8 py-6 bg-gray-50 border-t border-gray-200">
        <div class="flex justify-end">
            <div class="w-64 space-y-3">
                {{-- <div class="flex justify-between text-gray-600">
                    <span>Subtotal:</span>
                    <span>$ 1,827.48</span>
                </div> --}}
                {{-- <div class="flex justify-between text-gray-600">
                    <span>IVA (12%):</span>
                    <span>$ 219.30</span>
                </div> --}}
                <div class="flex justify-between text-lg font-bold text-gray-800 border-t border-gray-300 pt-2">
                    <span>TOTAL A PAGAR:</span>
                     <p class="font-semibold inline ">  Bs {{$producto->venta->total_bolivares}}</p>
                                                                    <span class="bg-green-200 text-green-800 text-xs font-medium px-2 rounded-sm dark:bg-gray-700 dark:text-green-400 border border-green-400">REF. {{$producto->venta->total_dolares}}</span>
                </div>
            </div>
        </div>
    </div>


</div>



        </x-slot>

        <x-slot name="footer">

            <button type="button" wire:click="close" wire:loading.attr="disabled" class="text-white cursor-pointer bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Cerrar
            </button>


        </x-slot>



    </x-dialog-modal>



  

</div>