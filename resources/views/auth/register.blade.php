<x-auth-layout>
    <x-slot name="title">Cadastre-se - Finance Vision</x-slot>

    <div class="mt-8 text-center">
        <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900">
            Crie sua conta
        </h2>
        <p class="mt-2 text-sm text-gray-500">
            Já tem uma conta?
            <a href="{{ route('login') }}" class="font-medium text-primary hover:underline">
                Faça o login
            </a>
        </p>
    </div>

    <div class="mt-8">
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- NOME --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    placeholder="Digite seu nome completo" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                              focus:ring-2 focus:ring-primary focus:ring-offset-1 focus:border-primary sm:text-sm">
                @error('name')<p class="text-danger text-xs mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- EMAIL --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                    placeholder="Digite seu email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                              focus:ring-2 focus:ring-primary focus:ring-offset-1 focus:border-primary sm:text-sm">
                @error('email')<p class="text-danger text-xs mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- SENHA --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input id="password" type="password" name="password" required placeholder="Crie uma senha" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                              focus:ring-2 focus:ring-primary focus:ring-offset-1 focus:border-primary sm:text-sm">
                @error('password')<p class="text-danger text-xs mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- CONFIRMAR SENHA --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar
                    Senha</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required
                    placeholder="Repita sua senha" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                              focus:ring-2 focus:ring-primary focus:ring-offset-1 focus:border-primary sm:text-sm">
            </div>

            {{-- BOTÕES --}}
            <div class="pt-4 space-y-5">
                {{-- BOTÃO DE REGISTRO PRINCIPAL --}}
                <button type="submit" class="w-full flex justify-center py-2 px-4 rounded-md shadow-md 
                           text-sm font-medium text-white bg-primary hover:bg-primary/90 
                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary 
                           transition duration-200">
                    Criar Conta
                </button>

                {{-- SEPARADOR --}}
                <div class="flex items-center gap-2">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="text-sm text-gray-400">ou</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>

                {{-- BOTÃO DO GOOGLE --}}
                <a href="{{ route('google.redirect') }}"
                    class="w-full flex items-center justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">

                    <img class="h-5 w-5 mr-3"
                        src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg"
                        alt="Logo do Google">

                    <span>Continuar com o Google</span>
                </a>
            </div>
        </form>
    </div>
</x-auth-layout>