@extends('layouts.app')

@section('header')
    Configurações do Perfil
@endsection

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-gray-800">⚙️ Gerenciar Minha Conta</h2>
            <p class="mt-2 text-lg text-gray-600">Ajuste suas preferências e informações de perfil.</p>
        </div>

        <div class="space-y-12">
            {{-- Perfil do Usuário --}}
            <section>

                @include('profile.partials.update-profile-information-form')
            </section>

            {{-- Alterar Senha --}}
            <section>
                @include('profile.partials.update-password-form')
            </section>

            {{-- Excluir Conta --}}
            <section>
                @include('profile.partials.delete-user-form')
            </section>
        </div>
    </div>
@endsection