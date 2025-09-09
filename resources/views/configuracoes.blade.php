@extends('layouts.app')

@section('header')
    Configurações
@endsection

@push('styles')
    {{-- CSS customizado para os botões de toggle de notificação --}}
    <style>
        .toggle-buttons input[type="radio"]:checked+label {
            background-color: #3498DB;
            /* var(--primary-color) */
            color: #fff;
            border-color: #3498DB;
        }
    </style>
@endpush

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-gray-800">Gerencie sua Conta</h2>
            <p class="mt-2 text-lg text-gray-600">Ajuste suas preferências e informações de perfil.</p>
        </div>

        {{-- O formulário engloba todos os cards e tem um único botão de salvar no final --}}
        <form action="#" method="POST" class="space-y-8">
            @csrf

            <section class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
                <header class="flex items-center gap-4 border-b border-gray-200 pb-4 mb-6">
                    <i class="fa-solid fa-user-pen text-xl text-primary"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Perfil do Usuário</h3>
                </header>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Seu Nome</label>
                        <input type="text" id="name" name="name"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            value="{{ Auth::user()->name }}">
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                        <input type="email" id="email" name="email"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            value="{{ Auth::user()->email }}">
                    </div>
                </div>
            </section>

            <section class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
                <header class="flex items-center gap-4 border-b border-gray-200 pb-4 mb-6">
                    <i class="fa-solid fa-lock text-xl text-primary"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Alterar Senha</h3>
                </header>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Senha
                            Atual</label>
                        <input type="password" id="current_password" name="current_password"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="••••••••">
                    </div>
                    <div>
                        {{-- Espaçador --}}
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nova Senha</label>
                        <input type="password" id="password" name="password"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="••••••••">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar
                            Nova Senha</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                            placeholder="••••••••">
                    </div>
                </div>
            </section>

            <section class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
                <header class="flex items-center gap-4 border-b border-gray-200 pb-4 mb-6">
                    <i class="fa-solid fa-bell text-xl text-primary"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Notificações</h3>
                </header>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">Dicas Financeiras</span>
                        <div class="toggle-buttons flex border border-gray-300 rounded-md overflow-hidden">
                            <input type="radio" id="dicas_sim" name="dicas" value="sim" class="hidden" checked>
                            <label for="dicas_sim" class="px-4 py-1 cursor-pointer text-sm font-medium">SIM</label>
                            <input type="radio" id="dicas_nao" name="dicas" value="nao" class="hidden">
                            <label for="dicas_nao"
                                class="px-4 py-1 cursor-pointer text-sm font-medium border-l border-gray-300">NÃO</label>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-medium text-gray-700">Alerta de Gastos</span>
                        <div class="toggle-buttons flex border border-gray-300 rounded-md overflow-hidden">
                            <input type="radio" id="gastos_sim" name="gastos" value="sim" class="hidden" checked>
                            <label for="gastos_sim" class="px-4 py-1 cursor-pointer text-sm font-medium">SIM</label>
                            <input type="radio" id="gastos_nao" name="gastos" value="nao" class="hidden">
                            <label for="gastos_nao"
                                class="px-4 py-1 cursor-pointer text-sm font-medium border-l border-gray-300">NÃO</label>
                        </div>
                    </div>
                </div>
            </section>

            <section class="bg-white p-6 sm:p-8 rounded-xl shadow-md">
                <header class="flex items-center gap-4 border-b border-gray-200 pb-4 mb-6">
                    <i class="fa-solid fa-paper-plane text-xl text-primary"></i>
                    <h3 class="text-lg font-semibold text-gray-900">Feedback e Suporte</h3>
                </header>
                <div>
                    <label for="feedback" class="block text-sm font-medium text-gray-700 mb-1">Sua opinião é importante!
                        Envie-nos uma sugestão ou relate um problema.</label>
                    <textarea id="feedback" name="feedback" rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary"
                        placeholder="Digite sua mensagem aqui..."></textarea>
                </div>
            </section>

            <div class="flex justify-end pt-4">
                <button type="submit"
                    class="inline-flex items-center px-8 py-3 bg-primary border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-opacity-90">
                    Salvar Alterações
                </button>
            </div>

        </form>
    </div>
@endsection