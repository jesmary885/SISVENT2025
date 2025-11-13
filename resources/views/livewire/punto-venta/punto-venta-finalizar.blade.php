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

           .update-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .update-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }
        
        .update-btn:active {
            transform: translateY(0);
        }
        
        .update-btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .update-btn:hover::after {
            left: 100%;
        }
        
        .pulse-animation {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(102, 126, 234, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(102, 126, 234, 0);
            }
        }
        
        .last-update {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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


    <button type="button" wire:click="$set('open',true)" type="button" wire:loading.attr="disabled" class=" cursor-pointer update-btn w-full p-4 text-white font-bold text-lg rounded-xl flex items-center justify-center">
    


        <svg wire:loading.remove wire:target="finalizarCompra" class="w-4 sm:w-5 h-4 sm:h-5 transform group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
                                
        <span wire:loading.remove wire:target="finalizarCompra" class="group-hover:text-gray-800 transition-colors">
            PROCESAR VENTA
        </span>

       

    </button>

    <x-dialog-modal wire:model="open" maxWidth="xl">

        <x-slot name="title">
            <div class=" flex justify-between ">



                <p></p>

            

                <button type="button" wire:click="close" wire:loading.attr="disabled"  class=" cursor-pointer  py-2.5 px-3 me-2 mb-2 text-sm font-bold text-white focus:outline-none bg-black rounded-full border border-gray-200 hover:bg-gray-100 hover:text-gray-200 focus:z-10 focus:ring-4 focus:ring-gray-100  ">
                    X
                </button>





            </div>
            
        </x-slot>

        <x-slot name="content">

            <div class="  ">

               
        
                       



                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-600" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 485.211 485.21" style="enable-background:new 0 0 485.211 485.21;"
                            xml:space="preserve">
                            <g>
                                <path d="M15.161,379.071h181.955c8.382,0,15.166-5.097,15.166-11.373V344.95c0-6.276-6.784-11.368-15.166-11.368H15.161
                                    C6.781,333.582,0,338.673,0,344.95v22.748C0,373.974,6.781,379.071,15.161,379.071z M15.161,439.724h181.955
                                    c8.382,0,15.166-5.096,15.166-11.373v-22.748c0-6.277-6.784-11.369-15.166-11.369H15.161C6.781,394.234,0,399.326,0,405.603v22.748
                                    C0,434.628,6.781,439.724,15.161,439.724z M15.161,318.413h181.955c8.382,0,15.166-5.091,15.166-11.368v-22.738
                                    c0-6.282-6.784-11.379-15.166-11.379H15.161C6.781,272.927,0,278.024,0,284.306v22.738C0,313.322,6.781,318.413,15.161,318.413z
                                    M241.941,312.378c0.235-1.778,0.665-3.496,0.665-5.334v-22.738c0-23.4-19.978-41.703-45.49-41.703h-60.651
                                    c0-41.875,33.941-75.812,75.817-75.812c41.875,0,75.814,33.937,75.814,75.812C288.097,273.936,269.068,300.823,241.941,312.378z
                                    M0,106.138h424.562v272.933H240.8c1.081-3.612,1.806-7.406,1.806-11.373v-18.953h90.979c0-33.496,27.158-60.653,60.649-60.653
                                    v-90.976c-33.491,0-60.649-27.158-60.649-60.651H90.978c0,33.494-27.155,60.651-60.651,60.651v45.487H15.161
                                    c-5.375,0-10.408,0.978-15.161,2.458V106.138z M485.211,45.487v303.258h-30.322V75.813H30.327V45.487H485.211z"/>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                            <g>
                            </g>
                        </svg>

                    </div>
                    <select wire:model="metodo_pago" class="w-full pl-10 pr-10 py-3 bg-white border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent appearance-none cursor-pointer transition-all duration-200">
                        <option value="" selected>Selecciona el método de pago</option>
                        <option value="debito">Débito</option>
                        <option value="pago_movil">Pago móvil</option>
                        <option value="dol_efec">Dólares en efectivo</option>
                        <option value="bs_efec">Bolívares en efectivo</option>
                        
                        <option value="usdt">USDT</option>
                    </select>




                
                </div>

                @if($metodo_pago == "bs_efec")

                 <hr class=" m-4 text-gray-200">

                    <div class="flex justify-start ">

                        <div aria-label="action panel"  tabindex="0" class="focus:outline-none  py-4 px-4  dark:bg-gray-800 rounded-md">

                                <div class="flex" >

                                    <p tabindex="0" class="focus:outline-none text-xs text-gray-800 dark:text-gray-100 font font-semibold pb-3 mr-3">Recibido el monto exacto de la venta</p>
                                    <div class="w-10 h-4 cursor-pointer rounded-full relative shadow-sm">
                                        <input aria-label="subscribe"
                                        type="checkbox"
                                        value='1'
                                        name="monto_cancelado"
                                        wire:model="monto_cancelado"
                                        id="monto_cancelado"
                                        class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-600 focus:outline-none checkbox w-4 h-4 rounded-full bg-white border-2 border-gray-700 absolute  shadow-sm appearance-none cursor-pointer" />
                                        <label for="monto_cancelado" class="toggle-label bg-gray-200 block w-10 h-4 overflow-hidden rounded-full border-2 border-blue-700 bg-gray-300 cursor-pointer"></label>
                                    </div>

                                </div>

                        

                        </div>

                        @if($monto_cancelado == 0)

                            <div class="ml-2">
                                    

                                    <div class="flex">

                                        <input 
                                        type="number" 
                                        id="montocbs"
                                        wire:model="montocbs"
                                        class="w-full px-4 mr-1 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white placeholder-gray-400"
                                        placeholder="Monto recibido"
                                        >

                                        <p class="text-xl font-medium text-gray-700 ml-1 mt-2">Bs</p>

                                    </div>
                                    
                                    @error('montocbs')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                            </div>

                           

                        @endif

                    </div>

                    @if($monto_cancelado == 0)

                    <div class="flex flex-col justify-center items-center ">
                                    <div class=" mt-1 grid grid-cols-1 gap-5 md:grid-cols-2">

                                        <div class="bg-red-100 p-4 text-green-800 text-xs font-medium rounded-2xl border-2  border-green-400">
                                            
                                            <div class="p-4 flex w-auto flex-col justify-center text-center">
                                                <p class=" text-sm font-bold text-green-800">CAMBIO</p>
                                                @if($cambio)
                                                <h4 class="text-xl text-center font-bold text-green-800">{{$cambio}}  Bs</h4>
                                                @else

                                                <h4 class="text-xl text-center font-bold text-green-800">0</h4>
                                                @endif
                                            </div>
                                        </div>




                                       <div class="bg-red-100 p-4 text-red-800 text-xs font-medium rounded-2xl border-2  border-red-400">
                                            
                                            <div class="p-4 flex w-auto flex-col justify-center text-center">
                                                <p class=" text-sm font-bold text-red-800 ">DEUDA CLIENTE</p>
                                                @if($deuda)
                                                <h4 class="text-xl text-center font-bold text-red-800">{{$deuda}}  Bs</h4>
                                                @else

                                                <h4 class="text-xl text-center font-bold text-red-800">0</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                            
                    </div>

                    @endif

                @endif

                 @if($metodo_pago == "dol_efec")

                 <hr class=" m-4 text-gray-200">

                    <div class="flex justify-start ">

                        <div aria-label="action panel"  tabindex="0" class="focus:outline-none  py-4 px-4  dark:bg-gray-800 rounded-md">

                                <div class="flex" >

                                    <p tabindex="0" class="focus:outline-none text-xs text-gray-800 dark:text-gray-100 font font-semibold pb-3 mr-3">Recibido el monto exacto de la venta</p>
                                    <div class="w-10 h-4 cursor-pointer rounded-full relative shadow-sm">
                                        <input aria-label="subscribe"
                                        type="checkbox"
                                        value='1'
                                        name="monto_cancelado"
                                        wire:model="monto_cancelado"
                                        id="monto_cancelado"
                                        class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 focus:bg-indigo-600 focus:outline-none checkbox w-4 h-4 rounded-full bg-white border-2 border-gray-700 absolute  shadow-sm appearance-none cursor-pointer" />
                                        <label for="monto_cancelado" class="toggle-label bg-gray-200 block w-10 h-4 overflow-hidden rounded-full border-2 border-blue-700 bg-gray-300 cursor-pointer"></label>
                                    </div>

                                </div>

                        

                        </div>

                        @if($monto_cancelado == 0)

                            <div class="ml-2">
                                    

                                    <div class="flex">

                                        <input 
                                        type="number" 
                                        id="montocdol"
                                        wire:model="montocdol"
                                        class="w-full px-4 mr-1 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 bg-white placeholder-gray-400"
                                        placeholder="Monto recibido"
                                        >

                                        <p class="text-xl font-medium text-gray-700 ml-1 mt-2">$</p>

                                    </div>
                                    
                                    @error('montocdol')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                            </div>

                           

                        @endif

                    </div>

                    @if($monto_cancelado == 0)

                    <div class="flex flex-col justify-center items-center ">
                                    <div class=" mt-1 grid grid-cols-1 gap-5 md:grid-cols-2">

                                        <div class="bg-red-100 p-4 text-green-800 text-xs font-medium rounded-2xl border-2  border-green-400">
                                            
                                            <div class="p-4 flex w-auto flex-col justify-center text-center">
                                                <p class=" text-sm font-bold text-green-800">CAMBIO</p>
                                                @if($cambio)
                                                <h4 class="text-xl text-center font-bold text-green-800">{{$cambio}}  $</h4>
                                                @else

                                                <h4 class="text-xl text-center font-bold text-green-800">0</h4>
                                                @endif
                                            </div>
                                        </div>




                                       <div class="bg-red-100 p-4 text-red-800 text-xs font-medium rounded-2xl border-2  border-red-400">
                                            
                                            <div class="p-4 flex w-auto flex-col justify-center text-center">
                                                <p class=" text-sm font-bold text-red-800 ">DEUDA CLIENTE</p>
                                                @if($deuda)
                                                <h4 class="text-xl text-center font-bold text-red-800">{{$deuda}}  $</h4>
                                                @else

                                                <h4 class="text-xl text-center font-bold text-red-800">0</h4>
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                            
                    </div>

                    @endif

                @endif

                <div class="relative mt-3">
                    <textarea 
        rows="5"
        class="w-full px-4 py-4 text-gray-500 bg-white border border-gray-300 rounded-2xl shadow-inner focus:outline-none focus:ring-4 focus:ring-amber-500/30 focus:border-amber-400 resize-none transition-all duration-300 hover:shadow-lg font-medium"
        placeholder="💡 Escribe algun comentario de la venta que desees guardar..."></textarea>
                </div>






                 

       



    
         
            </div>

        </x-slot>

        <x-slot name="footer">


            <button 
                type="button" 
                wire:click="save"
                wire:loading.attr="disabled"
                
                 class=" cursor-pointer update-btn w-full p-4 text-white font-bold text-lg rounded-xl flex items-center justify-center">
                
       
                        <span wire:loading>Procesando...</span>
                 FINALIZAR VENTA
            </button>






      

        </x-slot>



    </x-dialog-modal>



  

</div>