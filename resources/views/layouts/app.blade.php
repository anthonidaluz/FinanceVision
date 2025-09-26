<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-gray-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Finance Vision') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full font-sans antialiased">
    <div x-data="{ mobileMenuOpen: false }" class="h-screen flex overflow-hidden bg-gray-100">

        <div x-show="mobileMenuOpen" class="fixed inset-0 flex z-40 md:hidden" x-cloak>
            <div @click="mobileMenuOpen = false" x-show="mobileMenuOpen"
                x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-600 bg-opacity-75" aria-hidden="true"></div>

            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-in-out duration-300 transform"
                x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-300 transform"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
                class="relative flex-1 flex flex-col max-w-xs w-full bg-white">

                <div class="absolute top-0 right-0 -mr-12 pt-2">
                    <button @click="mobileMenuOpen = false" type="button"
                        class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Fechar menu</span>
                        <i class="fa-solid fa-xmark text-white"></i>
                    </button>
                </div>

                <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                    <div class="flex-shrink-0 flex items-center px-4 mb-5">
                        <a href="{{ route('dashboard') }}">
                            <img src="{{ asset('images/financevision_logo.png') }}" alt="Logo Finance Vision"
                                class="h-10 w-auto">
                        </a>
                    </div>
                    @include('layouts.partials.navigation')
                </div>
            </div>
        </div>

        <aside class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-white border-r border-gray-200 p-5">
                <div class="flex items-center justify-center h-16 flex-shrink-0 mb-4">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/financevision_logo.png') }}" alt="Logo Finance Vision"
                            class="h-15 w-auto">
                    </a>
                </div>
                @include('layouts.partials.navigation')
            </div>
        </aside>

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <header
                class="relative z-10 flex-shrink-0 flex h-20 bg-white shadow-sm items-center px-4 sm:px-6 border-b border-gray-100">

                {{-- Botão menu mobile (fica à esquerda) --}}
                <button @click="mobileMenuOpen = true" type="button"
                    class="p-2 text-gray-500 md:hidden absolute left-4">
                    <span class="sr-only">Abrir menu</span>
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>

                {{-- Título centralizado --}}
                <div class="flex-1 flex justify-center">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-800">
                        @yield('header')
                    </h1>
                </div>

                {{-- Ações (notificações, perfil, etc.) --}}
                <div class="absolute right-4 flex items-center gap-4">
                    <button type="button"
                        class="p-2 text-gray-500 rounded-full hover:bg-gray-100 hover:text-gray-700 transition">
                        <span class="sr-only">Notificações</span>
                        <i class="fa-regular fa-bell text-xl"></i>
                    </button>
                </div>
            </header>

            <main class="flex-1 relative overflow-y-auto focus:outline-none p-6 lg:p-8">
                @yield('content')
            </main>

            <footer class="bg-white border-t border-gray-200 p-4 text-center text-sm text-gray-500 flex-shrink-0">
                &copy; {{ date('Y') }} {{ config('app.name', 'Finance Vision') }}. Todos os direitos reservados.
            </footer>
        </div>
    </div>

    @stack('script')
</body>

</html>