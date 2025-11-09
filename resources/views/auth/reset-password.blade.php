<x-auth-layout>
    <x-slot name="title">Cadastrar Nova Senha - Finance Vision</x-slot>

    <div class="mb-6">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Cadastre sua Nova Senha</h2>
        <p class="mt-2 text-sm text-gray-600">
            Escolha uma senha forte e segura para proteger sua conta.
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary focus:outline-none focus:ring-primary sm:text-sm bg-gray-50"
                readonly>
            @error('email')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Nova Senha</label>
            <input id="password" type="password" name="password" required
                class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary focus:outline-none focus:ring-primary sm:text-sm">
            @error('password')
                <p class="text-danger text-xs mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Senha</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="mt-1 block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 placeholder-gray-400 shadow-sm focus:border-primary focus:outline-none focus:ring-primary sm:text-sm">
        </div>

        <div class="flex items-center justify-end pt-2">
            <button type="submit"
                class="inline-flex items-center justify-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-opacity-90 transition">
                Salvar Nova Senha
            </button>
        </div>
    </form>
</x-auth-layout>