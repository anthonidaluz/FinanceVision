{{-- Perfil do Usuário --}}
<a href="{{ route('profile.edit') }}"
    class="flex items-center gap-3 p-3 mb-1 rounded-lg transition-colors hover:bg-gray-100">
    <img src="https://i.pravatar.cc/40?u={{ Auth::user()->email }}" alt="Avatar"
        class="w-10 h-10 rounded-full border-2 border-blue-200 shadow">
    <div>
        <span class="font-semibold text-sm text-gray-800">{{ Auth::user()->name }}</span>
        <span class="block text-xs text-gray-500">Editar Perfil</span>
    </div>
</a>

{{-- Bloco de Nível --}}
<div class="w-full px-3 pb-4">
    <div class="flex items-center gap-2 mb-1">
        <span class="text-sm font-semibold flex items-center gap-1" style="color: {{ Auth::user()->level_color }};">
            @if(Auth::user()->level == 4)
                <i class="fa-solid fa-trophy text-yellow-400"></i>
            @elseif(Auth::user()->level == 3)
                <i class="fa-solid fa-medal text-gray-400"></i>
            @elseif(Auth::user()->level == 2)
                <i class="fa-solid fa-medal text-orange-400"></i>
            @else
                <i class="fa-solid fa-seedling text-green-500"></i>
            @endif
            Nível {{ Auth::user()->level }}
        </span>
        <span class="text-xs px-2 py-0.5 rounded bg-[#d4eaf7] text-[#3498db]" title="Progresso para o próximo nível">
            {{ Auth::user()->level_progress }}%
        </span>
    </div>

    <div class="w-full h-2 rounded-full bg-[#d4eaf7] overflow-hidden relative">
        <div class="h-2 rounded-full transition-all duration-700"
            style="width: {{ Auth::user()->level_progress }}%; background: #3498db;"></div>
        @if(Auth::user()->level == 4 && Auth::user()->level_progress == 100)
            <span class="absolute right-1 -top-4 text-[10px] font-bold text-yellow-500 animate__fadeInRight">
                Mestre Financeiro!
            </span>
        @endif
    </div>

    <div class="text-xs text-gray-500 text-center mt-1 italic">
        Progresso para o próximo nível
    </div>
</div>


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
        <li>
            <a href="{{ route('achievements.index') }}"
                class="flex items-center gap-3 px-4 py-2 rounded-md transition-colors text-sm font-medium 
       {{ request()->routeIs('achievements.*') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-gray-100 hover:text-gray-900' }}">
                <i class="fa-solid fa-trophy w-5 text-center"></i> Conquistas
            </a>
        </li>
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