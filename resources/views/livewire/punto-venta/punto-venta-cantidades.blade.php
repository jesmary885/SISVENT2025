<div class="w-full">
  
           
                                <div class="flex justify-between w-full">
                                    <div class="mr-2 flex justify-between">
                                        <x-secondary-button class="ml-2 cursor-pointer"
                                        disabled
                                        x-bind:disabled="$wire.qty <= 1"
                                        wire:loading.attr="disabled"
                                        wire:target="decrement"
                                        wire:click="decrement">
                                        -
                                        </x-secondary-button>
                                        <input wire:model="qty" autofocus type="number" min="1" max="{{$quantity}}" class="inputNumber text-center appearance-none block text-gray-700 border border-gray-200 rounded py-1 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="{{$qty}}">
                                        <x-secondary-button class="mr-2 cursor-pointer" 
                                            x-bind:disabled="$wire.qty >= $wire.quantity"
                                            wire:loading.attr="disabled"
                                            wire:target="increment"
                                            wire:click="increment">
                                            +
                                        </x-secondary-button>
                                    </div>
          
                                    <button id="button_addItem" type="submit" class=" cursor-pointer text-white bg-blue-500 px-2 py-1  text-center inline-flex items-center font-medium rounded-lg " 
                                        x-bind:disabled="$wire.qty > $wire.quantity"
                                        wire:click="addItem"
                                        wire:loading.attr="disabled"
                                        wire:loading.attr="disabled"
                                        wire:target="addItem">
                                        Agregar
                                    </button> 
                                </div>


                                

 
</div>