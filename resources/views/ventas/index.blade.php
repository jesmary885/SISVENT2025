<x-app-layout>

    <div class=" font-sans flexitems-center justify-center">
    <div x-data="{ openTab: 1 }" class="">
        <div class=" mx-auto">
            <div class="mb-4 flex space-x-4 p-2 bg-white rounded-lg shadow-lg">
                <button x-on:click="openTab = 1" :class="{ 'bg-blue-500 text-white': openTab === 1 }" class="flex-1 cursor-pointer py-2 px-2 rounded-md focus:outline-none focus:shadow-outline-blue text-sm font-medium leading-5 text-gray-500  transition-all duration-300">Registro</button>
                <button x-on:click="openTab = 2" :class="{ 'bg-blue-500 text-white': openTab === 2 }" class="flex-1 cursor-pointer py-2 px-2 rounded-md focus:outline-none focus:shadow-outline-blue transition-all text-sm font-medium leading-5 text-gray-500 duration-300">Historial</button>
            </div>

            <div x-show="openTab === 1" class="transition-all duration-300 ">
                @livewire('punto-venta.punto-venta-create') 
            </div>

            <div x-show="openTab === 2" class="transition-all duration-300  ">
                   @livewire('ventas.ventas-index') 
            </div>

           
        </div>
    </div>
</div>



 

</x-app-layout>