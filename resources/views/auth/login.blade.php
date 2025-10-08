<x-auth-layout>
    <x-slot name="title">Login - Finance Vision</x-slot>

    <div class="mt-8 text-center">
        <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-gray-900">
            Acesse sua conta
        </h2>
        <p class="mt-2 text-sm text-gray-500">
            Ou
            <a href="{{ route('register') }}" class="font-medium text-primary hover:underline">
                crie uma conta gratuitamente
            </a>
        </p>
    </div>

    <div class="mt-8">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            {{-- EMAIL --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    placeholder="Digite seu email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                              focus:ring-2 focus:ring-primary focus:ring-offset-1 focus:border-primary sm:text-sm">
                @error('email')<p class="text-danger text-xs mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- SENHA --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                <input id="password" type="password" name="password" required placeholder="Digite sua senha" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                              focus:ring-2 focus:ring-primary focus:ring-offset-1 focus:border-primary sm:text-sm">
                @error('password')<p class="text-danger text-xs mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- LEMBRAR / ESQUECEU --}}
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary">
                    <span class="ml-2 text-sm text-gray-700">Manter conectado</span>
                </label>
                <a href="{{ route('password.request') }}" class="text-sm font-medium text-primary hover:underline">
                    Esqueceu sua senha?
                </a>
            </div>

            {{-- BOTÕES --}}
            <div class="pt-4 space-y-5">
                {{-- BOTÃO LOGIN --}}
                <button type="submit" class="w-full flex justify-center py-2 px-4 rounded-md shadow-md 
                           text-sm font-medium text-white bg-primary hover:bg-primary/90 
                           focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary 
                           transition duration-200">
                    Entrar
                </button>

                {{-- SEPARADOR --}}
                <div class="flex items-center gap-2">
                    <div class="flex-1 border-t border-gray-300"></div>
                    <span class="text-sm text-gray-400">ou</span>
                    <div class="flex-1 border-t border-gray-300"></div>
                </div>


                {{-- GOOGLE --}}
                <a href="{{ route('google.redirect') }}"
                    class="w-full flex items-center justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">

                    <img class="h-5 w-5 mr-3"
                        src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg"
                        alt="Logo do Google">

                    <span>Entrar com o Google</span>
                </a>
            </div>
        </form>
    </div>
</x-auth-layout>