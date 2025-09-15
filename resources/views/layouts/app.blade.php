<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Finance Vision') }}</title>

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

<body class="bg-gray-100 font-sans text-gray-800 antialiased">

    <div class="grid grid-cols-1 md:grid-cols-[260px_1fr] h-screen">
        <aside class="bg-white border-r border-gray-200 p-6 flex flex-col hidden md:flex">
            <div class="mb-8 text-center">
                <a href="{{ route('dashboard') }}">
                    <img src="{{ asset('images/financevision_logo.png') }}" alt="Logo Finance Vision"
                        class="h-25 mx-auto">
                </a>
            </div>

            <a href="{{ route('profile.edit') }}"
                class="flex items-center gap-3 p-3 mb-6 rounded-lg transition-colors hover:bg-gray-100">
                <img src="https://i.pravatar.cc/40?u={{ Auth::user()->email }}" alt="Avatar"
                    class="w-10 h-10 rounded-full">
                <div>
                    <span class="font-semibold text-sm text-gray-800">{{ Auth::user()->name }}</span>
                    <span class="block text-xs text-gray-500">Ver Perfil</span>
                </div>
            </a>

            <nav class="flex-grow">
                <ul class="space-y-2">
                    <li><a href="{{ route('dashboard') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                                class="fa-solid fa-house w-5 text-center"></i> Dashboard</a></li>
                    <li><a href="{{ route('lancamentos.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('lancamentos.*') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                                class="fa-solid fa-money-bill-transfer w-5 text-center"></i> Lançamentos</a></li>
                    <li><a href="{{ route('metas.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('metas.*') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                                class="fa-solid fa-crosshairs w-5 text-center"></i> Metas</a></li>
                    <li><a href="{{ route('categorias.index') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('categorias.*') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                                class="fa-solid fa-tags w-5 text-center"></i> Categorias</a></li>
                    <li><a href="{{ route('relatorios') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('relatorios') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                                class="fa-solid fa-chart-pie w-5 text-center"></i> Relatórios</a></li>
                    <li><a href="{{ route('dicas') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('dicas') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                                class="fa-solid fa-lightbulb w-5 text-center"></i> Dicas</a></li>
                    <li><a href="{{ route('configuracoes') }}"
                            class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('configuracoes') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                                class="fa-solid fa-gear w-5 text-center"></i> Configurações</a></li>
                </ul>
            </nav>

            <div class="mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                        class="flex items-center gap-3 px-4 py-2 rounded-md text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900">
                        <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Sair
                    </a>
                </form>
            </div>
        </aside>

        <div class="flex flex-col max-h-screen">
            <header
                class="bg-white border-b border-gray-200 p-4 flex justify-between items-center h-[70px] flex-shrink-0">
                <div class="flex items-center gap-4">
                    <button class="p-2 text-gray-600 md:hidden">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <a href="{{ route('dashboard') }}" class="md:hidden">
                        <img src="{{ asset('images/financevision_logo.png') }}" alt="Logo Finance Vision" class="h-8">
                    </a>
                </div>

                <h2 class="text-xl font-semibold text-gray-800 hidden md:block">
                    @yield('header')
                </h2>

                <div class="flex items-center gap-4">
                    <i class="fa-regular fa-bell text-xl text-gray-500"></i>
                </div>
            </header>

            <main class="flex-grow p-6 lg:p-8 overflow-y-auto">
                @yield('content')
            </main>

            <footer class="bg-white border-t border-gray-200 p-4 text-center text-sm text-gray-500 flex-shrink-0">
                &copy; {{ date('Y') }} {{ config('app.name', 'Finance Vision') }}. Todos os direitos reservados.
            </footer>
        </div>
    </div>
</body>

</html>