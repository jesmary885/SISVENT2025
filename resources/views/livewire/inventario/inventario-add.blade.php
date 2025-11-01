<div class=" font-Arima" >

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
      
    </style>


    <button type="button" wire:click="$set('open',true)" type="button" wire:loading.attr="disabled" class=" cursor-pointer text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-1  text-center inline-flex items-center  dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

        <img src="{{Storage::url('imagen/add.png')}}" alt="icono" class="w-12 h-10">
    </button>

    <x-dialog-modal wire:model="open" maxWidth="xl">

        <x-slot name="title">
            <div class=" flex justify-between ">

                <p>Agregar registro</p>

                <button type="button" wire:click="close" wire:loading.attr="disabled"  class="py-2.5 px-3 me-2 mb-2 text-sm font-bold text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    X
                </button>





            </div>
            
        </x-slot>

        <x-slot name="content">

            <div class=" flex  p-4">

                    <div class="w-1/2 mr-3">
                        <div>
                            <label for="cod_barra" class="block text-sm font-medium text-gray-700 mb-2">
                                Cantidad
                            </label>
                            <input 
                                type="number" 
                                id="cantidad"
                                wire:model.defer="cantidad"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white placeholder-gray-400"
                                placeholder="Ejemplo 500"
                            >
                            @error('cantidad')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    
                 


            </div>

            <div class=" flex p-4">
                    <div class="w-1/2 mr-3">

                        <label for="metodo_pago" class="block text-sm font-medium text-gray-700 mb-2 ">
                            Método de pago
                        </label>

                     

                            <select 
                                id="metodo_pago"
                                wire:model="metodo_pago"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white appearance-none"
                            >
                                <option value="" selected>Seleccione una opción</option>
                                <option value="bs_efec">Dólares en efectivo</option>
                                <option value="dol_efec">Bolívares en efectivo</option>
                                <option value="pago_movil">Pago móvil</option>
                                <option value="usdt">USDT</option>
                        
                            </select>

                            @error('metodo_pago')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                    </div>


                    <div class="w-1/2">

                        @if($metodo_pago == 'bs_efec' || $metodo_pago == 'pago_movil' )
                            <div>
                                <label for="cod_barra" class="block text-sm font-medium text-gray-700 mb-2">
                                    Precio de compra en Bolívares
                                </label>
                                <input 
                                    type="number" 
                                    id="precio_compra_bolivares"
                                    wire:model.defer="precio_compra_bolivares"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white placeholder-gray-400"
                                    placeholder="Ejemplo 1000"
                                >
                                @error('precio_compra_bolivares')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        @if($metodo_pago == 'dol_efec' || $metodo_pago == 'usdt' )

                            <div>
                                <label for="cod_barra" class="block text-sm font-medium text-gray-700 mb-2">
                                    Precio de compra en Dólares
                                </label>
                                <input 
                                    type="number" 
                                    id="precio_compra_dolares"
                                    wire:model.defer="precio_compra_dolares"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white placeholder-gray-400"
                                    placeholder="Ejemplo 10"
                                >
                                @error('precio_compra_dolares')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif


                    </div>
            </div>


       

{{--             
                    @if($registro->vencimiento == 'Si')
                        <div class="w-1/3" x-data="{
                                openDatePicker() {
                                    const input = this.$refs.dateInput;
                                    if (input.showPicker && typeof input.showPicker === 'function') {
                                        input.showPicker();
                                    } else {
                                        input.focus();
                                        console.log('Navegador no soporta showPicker()');
                                    }
                                }
                            }">
                            <label class="block text-sm font-medium text-gray-700 mb-2 ">Ingrese la fecha</label>
                            <div class="max-w-md mx-auto">
                                <div class="relative">
                                    <input 
                                        type="date"
                                        x-ref="dateInput"
                                        wire:model="fecha_vencimiento"
                                        class="w-full px-3 py-3 pl-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white cursor-pointer"
                                        @click="openDatePicker()"
                                    >
                                </div>
                            </div>
                        </div>
                    @endif --}}

     

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

{{--         
        @push('js')
            <script>
                function datePicker() {
                    return {
                        init() {
                            // Inicializar Flatpickr cuando el componente esté montado
                            this.$nextTick(() => {
                                flatpickr(this.$refs.dateInput, {
                                    dateFormat: "Y-m-d",
                                    locale: "es",
                                    minDate: "today",
                                    clickOpens: true, // Abrir al hacer clic en cualquier parte
                                    allowInput: false // No permitir entrada manual
                                });
                            });
                        }
                    }
                }
            </script>

        @endpush --}}

    </x-dialog-modal>
  

</div>