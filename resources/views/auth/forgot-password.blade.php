<x-auth-layout>
    <x-slot name="title">Recuperar Senha - Finance Vision</x-slot>

    <div class="mb-6">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Esqueceu sua senha?</h2>
        <p class="mt-2 text-sm text-gray-600">
            Sem problemas. Apenas nos informe seu endereço de e-mail e enviaremos um link de recuperação que permitirá
            que você escolha uma nova senha.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary focus:outline-none focus:ring-primary sm:text-sm">
            @error('email')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end gap-4 pt-2">
            <a href="{{ route('login') }}"
                class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Voltar
            </a>

            <button type="submit"
                class="inline-flex items-center justify-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                Enviar Link
            </button>
        </div>
    </form>
</x-auth-layout>