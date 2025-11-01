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


    <button type="button" wire:click="$set('open',true)" type="button" wire:loading.attr="disabled" class=" @if($tipo == 'agregar') bg-blue-500 hover:bg-blue-600 text-white ml-4 text-md @endif cursor-pointer text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-1  text-center  items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
         @if($tipo == 'agregar')


             <p >
            CREAR REGISTRO
         </p>

       

        
       

        @else

        <img src="{{Storage::url('imagen/edit.png')}}" alt="icono" class="w-8 h-8">
        @endif
    </button>

    <x-dialog-modal wire:model="open" maxWidth="4xl">

        <x-slot name="title">
            <div class=" flex justify-between ">

                @if($tipo == 'agregar')

                <p>Agregar registro</p>

                @else

                <p>Editar registro</p>
                @endif

                <button type="button" wire:click="close" wire:loading.attr="disabled"  class="py-2.5 px-3 me-2 mb-2 text-sm font-bold text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    X
                </button>





            </div>
            
        </x-slot>

        <x-slot name="content">

            <div class="mt-2 w-full h-full ">

                <div class="flex justify-end m-4">
                    <div class="flex items-center h-5">
                        <input 
                        value="1"
                            id="estado"
                            type="checkbox"
                            wire:model.defer="estado"
                            class="w-4 h-4 text-purple-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2"
                        >
                    </div>
                    <div class="text-sm">
                        <label for="estado" class="font-medium text-gray-700 cursor-pointer ml-2">
                           Producto activo en inventario
                        </label>
                     
                    </div>
                </div>

                <div class=" flex items-center justify-center p-4">
                    <div class="w-full">
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre
                            </label>
                            <input 
                                type="text" 
                                id="nombre"
                                wire:model.defer="nombre"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white placeholder-gray-400"
                                placeholder="Ejemplo. Harina de maiz Maria de 1 kg"
                            >
                            @error('nombre')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class=" flex justify-between  p-4">

                    <div class="w-full">
                        <label for="opcion" class="block text-sm font-medium text-gray-700 mb-2 ">
                            Marca
                        </label>

                        <select wire:model.defer="marca_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white appearance-none">
                            <option value="" selected>Seleccione una opción</option>
                            @foreach ($marcas as $marca)
                                <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                            @endforeach
                        </select>

                        @error('marca_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="w-full ml-2">
                        <label for="presentacion" class="block text-sm font-medium text-gray-700 mb-2">
                            Presentación
                        </label>
                        <select 
                            id="opcion"
                            wire:model="presentacion"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white appearance-none"
                        >
                            <option value="" selected>Seleccione una opción</option>
                            <option value="Unidad">Unidad</option>
                            <option value="Kg">Kg</option>
                  
                        </select>
                        @error('presentacion')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class=" flex justify-start p-4">
                    <div class="w-1/3 mr-3">
                        <div>
                            <label for="precio_venta" class="block text-sm font-medium text-gray-700 mb-2">
                                Precio de venta
                            </label>

                            <div class="flex">

                                <input 
                                type="number" 
                                id="precio_venta"
                                wire:model="precio_venta"
                                class="w-full px-4 mr-1 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white placeholder-gray-400"
                                placeholder="Precio en dólares"
                                >

                                <p class="text-xl font-medium text-gray-700 ml-1 mt-2">$</p>

                            </div>
                            
                            @error('precio_venta')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="w-1/3 mr-1">

                        <label for="vencimiento" class="block text-sm font-medium text-gray-700 mb-2 ">
                            Posee fecha de vencimiento?
                        </label>

                     

                            <select 
                                id="vencimiento"
                                wire:model="vencimiento"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white appearance-none"
                            >
                                <option value="" selected>Seleccione una opción</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                        
                            </select>

                            @error('vencimiento')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                    </div>



                </div>

                <div class=" flex  p-4">

                    <div class="w-1/3 mr-3">
                        <div>
                            <label for="cod_barra" class="block text-sm font-medium text-gray-700 mb-2">
                                Cód de barra
                            </label>
                            <input 
                                type="text" 
                                id="cod_barra"
                                wire:model.defer="cod_barra"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white placeholder-gray-400"
                                placeholder="Ejemplo. 1234567890"
                            >
                            @error('cod_barra')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    
                    <div class="w-1/3">
                        <div>
                            <label for="stock_minimo" class="block text-sm font-medium text-gray-700 mb-2">
                                Stock mínimo
                            </label>
                            <input 
                                type="text" 
                                id="stock_minimo"
                                wire:model.defer="stock_minimo"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white placeholder-gray-400"
                                placeholder="Ejemplo. 25"
                            >
                            @error('stock_minimo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                </div>

         
            </div>

        </x-slot>

        <x-slot name="footer">


            <button 
                type="button" 
                wire:click="save"
                wire:loading.attr="disabled"
                
                 class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                
       
                        <span wire:loading>Procesando...</span>
                 Guardar
            </button>




            <button type="button" wire:click="close" wire:loading.attr="disabled" class="text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Cerrar
            </button>



      

        </x-slot>



    </x-dialog-modal>



  

</div>