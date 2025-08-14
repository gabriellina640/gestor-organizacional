<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Organiza Ai') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800" x-data>
    <div id="app">
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <a class="flex-shrink-0 flex items-center font-bold text-xl" href="{{ url('/') }}">
                            {{ config('app.name', 'Organiza Ai') }} 
                            <div class="flex flex-col items-center mb-6">
                                <img src="{{ asset('images/slogan.png') }}" 
                                     alt="Organiza Ai" 
                                     style="height: 50px; width: auto; margin-top: 1rem;">
                            </div>
                        </a>
                    </div>

                    <div class="flex items-center space-x-4 relative" x-data="{ open: false }">
                        @guest
                            @if (Route::has('login'))
                                <a class="text-gray-700 hover:text-gray-900" href="{{ route('login') }}">Entrar</a>
                            @endif
                            
                            @if (Route::has('register'))
                                <a class="text-gray-700 hover:text-gray-900" href="{{ route('register') }}">Registrar</a>
                            @endif
                        @else
                            <!-- Botão da seta -->
                            <button @click="open = !open" class="flex items-center focus:outline-none p-2 rounded hover:bg-gray-100">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Menu Dropdown -->
                            <div x-show="open" 
                                 x-transition.opacity
                                 @click.away="open = false"
                                 class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md py-2 z-50">
                                
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 font-medium text-gray-800 hover:bg-gray-100">
                                    Perfil
                                </a>

                                <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>

        <main class="py-6">
            @yield('content')
        </main>
    </div>

    <footer class="bg-gray-200 text-center p-4 text-sm text-gray-600">
        &copy; {{ date('Y') }} Organiza Ai - Todos os direitos reservados.
    </footer>

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
