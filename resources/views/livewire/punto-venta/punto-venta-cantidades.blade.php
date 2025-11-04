<div class="w-full">
    <div class="flex items-center gap-1"> <!-- Gap más pequeño -->
        <!-- Botón decremento -->
        <button class="w-6 h-6 bg-gray-800 text-amber-300 rounded-lg flex items-center justify-center text-xs font-bold hover:bg-gray-900 transition-colors cursor-pointer"
                disabled
                x-bind:disabled="$wire.qty <= 1"
                wire:loading.attr="disabled"
                wire:target="decrement"
                wire:click="decrement">
            -
        </button>
        
        <!-- Input -->
        <input wire:model="qty" autofocus type="number" min="1" max="{{$quantity}}" 
               class="w-10 h-6 text-xs text-center text-gray-800 bg-white border border-amber-300 rounded focus:outline-none focus:border-amber-500">
        
        <!-- Botón incremento -->
        <button class="w-6 h-6 bg-gray-800 text-amber-300 rounded-lg flex items-center justify-center text-xs font-bold hover:bg-gray-900 transition-colors cursor-pointer"
                x-bind:disabled="$wire.qty >= $wire.quantity"
                wire:loading.attr="disabled"
                wire:target="increment"
                wire:click="increment">
            +
        </button>
        
        <!-- Botón agregar -->
        <button type="submit" 
                class="w-12 h-6 bg-gray-800 text-amber-300 text-xs font-bold rounded-lg hover:bg-gray-900 transition-colors cursor-pointer flex items-center justify-center"
                x-bind:disabled="$wire.qty > $wire.quantity"
                wire:click="addItem"
                wire:loading.attr="disabled"
                wire:target="addItem">
            Agregar
        </button>
    </div>
</div>