<section class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
    <header class="flex items-center gap-4 pb-4 mb-6 border-b border-gray-100">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100 text-red-600">
            <i class="fa-solid fa-user-slash text-lg"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold tracking-tight text-gray-900">Excluir Conta</h2>
            <p class="text-sm text-gray-500">Uma vez excluída, sua conta não poderá ser recuperada.</p>
        </div>
    </header>

    <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
        @csrf
        @method('delete')

        <p class="text-sm text-gray-600">
            Digite sua senha para confirmar a exclusão definitiva da conta.
        </p>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Senha</label>
            <input id="password" name="password" type="password"
                class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-red-500 focus:border-red-500"
                placeholder="••••••••">
            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end pt-4">
            <button type="submit"
                class="px-8 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold rounded-lg shadow-md hover:opacity-90 transition">
                Excluir Conta
            </button>
        </div>
    </form>
</section>