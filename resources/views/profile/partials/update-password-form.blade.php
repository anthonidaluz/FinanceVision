<section class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
    <header class="flex items-center gap-4 pb-4 mb-6 border-b border-gray-100">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 text-primary">
            <i class="fa-solid fa-lock text-lg"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold tracking-tight text-gray-900">Alterar Senha</h2>
            <p class="text-sm text-gray-500">Use uma senha longa e segura para proteger sua conta.</p>
        </div>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Senha Atual</label>
            <input id="current_password" name="current_password" type="password"
                class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-primary focus:border-primary"
                placeholder="••••••••">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Nova Senha</label>
                <input id="password" name="password" type="password"
                    class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-primary focus:border-primary"
                    placeholder="••••••••">
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirmar Nova
                    Senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password"
                    class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-primary focus:border-primary"
                    placeholder="••••••••">
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 pt-4">
            <button type="submit"
                class="px-8 py-3 bg-gradient-to-r from-primary to-blue-600 text-white font-semibold rounded-lg shadow-md hover:opacity-90 transition">
                Salvar Senha
            </button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-500">Salvo.</p>
            @endif
        </div>
    </form>
</section>