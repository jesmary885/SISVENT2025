
<div class="bg-gray-200  min-h-screen p-8">


       <div class="bg-gray-200 flex items-center justify-center">
            <div class="w-full mx-auto py-2">
                <div class="flex flex-col sm:flex-col md:flex-row w-full md:space-x-2 space-y-2 md:space-y-0 mb-2 md:mb-4">
                    
                    <!-- Primera caja -->
                    <div class="w-full sm:w-full md:w-1/4 min-h-[100px] sm:min-h-[110px] md:min-h-[120px] flex">
                        <div class="widget w-full p-3 sm:p-4 rounded-lg bg-white border-l-4 border-purple-400 flex items-center flex-1">
                            <div class="flex items-center w-full">
                                <div class="icon w-10 sm:w-12 md:w-14 lg:w-20 p-2 sm:p-3 md:p-3.5 bg-purple-400 text-white rounded-full mr-2 sm:mr-3">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <div class="flex items-center gap-3  text-xs mt-1"> <!-- Texto más pequeño -->
                                        <span class="font-bold">Bs {{$ganancia_dia_bs}}</span>
                                        <span class=" bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">$ {{$ganancia_dia_dol}}</span>
                                    </div>
                                    <div class="text-md text-gray-400">Ganancias del día</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full sm:w-full md:w-1/4 min-h-[100px] sm:min-h-[110px] md:min-h-[120px] flex">
                        <div class="widget w-full p-3 sm:p-4 rounded-lg bg-white border-l-4 border-blue-400 flex items-center flex-1">
                            <div class="flex items-center w-full">
                                <div class="icon w-10 sm:w-12 md:w-14 lg:w-20 p-2 sm:p-3 md:p-3.5 bg-blue-400 text-white rounded-full mr-2 sm:mr-3">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <div class="flex items-center gap-3  text-xs mt-1"> <!-- Texto más pequeño -->
                                        <span class="font-bold">Bs {{$ganancia_mes_bs}}</span>
                                        <span class=" bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-yellow-300 border border-yellow-300">$ {{$ganancia_mes_dol}}</span>
                                    </div>
                                    <div class="text-md text-gray-400">Ganancias del mes</div>
                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="w-full sm:w-full md:w-1/4 min-h-[100px] sm:min-h-[110px] md:min-h-[120px] flex">
                        <div class="widget w-full p-3 sm:p-4 rounded-lg bg-white border-l-4 border-green-400 flex items-center flex-1">
                            <div class="flex items-center w-full">
                                <div class="icon w-10 sm:w-12 md:w-14 lg:w-20 p-2 sm:p-3 md:p-3.5 bg-green-400 text-white rounded-full mr-2 sm:mr-3">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                    </svg>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <div class="text-lg">{{$ventas_dia}}</div>
                                    <div class="text-md text-gray-400">Ventas del día</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w-full sm:w-full md:w-1/4 min-h-[100px] sm:min-h-[110px] md:min-h-[120px] flex">
                        <div class="widget w-full p-3 sm:p-4 rounded-lg bg-white border-l-4 border-red-400 flex items-center flex-1">
                            <div class="flex items-center w-full">
                                <div class="icon w-10 sm:w-12 md:w-14 lg:w-20 p-2 sm:p-3 md:p-3.5 bg-red-400 text-white rounded-full mr-2 sm:mr-3">
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                    </svg>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <div class="text-lg">Bs / USD {{$tasa_dia}}</div>
                                    <div class="text-md text-gray-400">Tasa del día</div>
                                </div>
                            </div>
                        </div>
                    </div>

         


          



                </div>
            </div>
        </div>







</div>


