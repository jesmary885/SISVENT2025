<x-guest-layout>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <div class="bg-no-repeat bg-cover bg-center relative" style="background-image: url({{Storage::url('imagen/login.jpg')}})"><div class="absolute bg-gradient-to-b from-blue-500 to-blue-400 opacity-75 inset-0 z-0"></div>
        <div class="min-h-screen sm:flex justify-around  mx-0 ">
            <div class=" p-10  mx-12 z-10">
                <div class="self-start hidden lg:flex flex-col  text-white">
                <img src="" class="mb-3">
             
                </div>
            </div>
            <div class="flex justify-start self-center mr-20 z-10">
                <div class="p-12 bg-white mx-auto rounded-2xl  ">
                    <div class="mb-4">
                    <h3 class="font-semibold text-2xl justify-center text-center text-gray-800">Inicio de sesión </h3>

                    </div>

                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="space-y-5">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium text-gray-700 tracking-wide">Email</label>
                    <input  id="email" type="email" name="email" class=" w-full text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-blue-400" placeholder="mail@gmail.com">
                    </div>
                                <div class="space-y-2">
                    <label class="mb-5 text-sm font-medium text-gray-700 tracking-wide">
                        Contraseña
                    </label>
                    <input id="password" type="password" name="password" class="w-full content-center text-base px-4 py-2 border  border-gray-300 rounded-lg focus:outline-none focus:border-blue-400" placeholder="*****************">
                    </div>
                    <div class="flex items-center justify-between">
                    <div class="flex items-center">
               
                    </div>
                    <div class="text-sm">
                      
                    </div>
                    </div>
                    <div>
                    <button type="submit" class="w-full flex justify-center bg-blue-400  hover:bg-blue-500 text-gray-100 p-3  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                        Sign in
                    </button>
                    </div>
                    </div>

                    </form>
                    <div class="pt-5 text-center text-gray-400 text-xs">
                    <span>
                         COPYRIGHT© 2025 <a href="https://www.instagram.com/codesupportonline/">CODESUPPORT</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>




</x-guest-layout>
