{{-- Perfil do Usuário --}}
<a href="{{ route('profile.edit') }}"
    class="flex items-center gap-3 p-3 mb-6 rounded-lg transition-colors hover:bg-gray-100">
    <img src="https://i.pravatar.cc/40?u={{ Auth::user()->email }}" alt="Avatar" class="w-10 h-10 rounded-full">
    <div>
        <span class="font-semibold text-sm text-gray-800">{{ Auth::user()->name }}</span>
        <span class="block text-xs text-gray-500">Ver Perfil</span>
    </div>
</a>

{{-- Navegação Principal --}}
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
        <li><a href="{{ route('relatorios.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('relatorios.*') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                    class="fa-solid fa-chart-pie w-5 text-center"></i> Relatórios</a></li>
        <li><a href="{{ route('dicas') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('dicas') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                    class="fa-solid fa-lightbulb w-5 text-center"></i> Dicas</a></li>
        <li><a href="{{ route('configuracoes') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium {{ request()->routeIs('configuracoes') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}"><i
                    class="fa-solid fa-gear w-5 text-center"></i> Configurações</a></li>
    </ul>
</nav>

{{-- Logout --}}
<div class="mt-auto">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
            class="flex items-center gap-3 px-4 py-2 rounded-md text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900">
            <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Sair
        </a>
    </form>
</div>