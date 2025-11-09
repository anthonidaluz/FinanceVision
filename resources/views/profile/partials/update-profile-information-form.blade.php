<section class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition">
    <header class="flex items-center gap-4 pb-4 mb-6 border-b border-gray-100">
        <div class="flex items-center justify-center w-12 h-12 rounded-full bg-primary/10 text-primary">
            <i class="fa-solid fa-user-pen text-lg"></i>
        </div>
        <div>
            <h2 class="text-xl font-bold tracking-tight text-gray-900">Perfil do Usuário</h2>
            <p class="text-sm text-gray-500">Atualize suas informações pessoais e de contato.</p>
        </div>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Seu Nome</label>
                <input id="name" name="name" type="text"
                    class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-primary focus:border-primary"
                    value="{{ old('name', $user->name) }}" required autofocus>
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">E-mail</label>
                <input id="email" name="email" type="email"
                    class="block w-full border-gray-200 rounded-lg shadow-sm focus:ring-primary focus:border-primary"
                    value="{{ old('email', $user->email) }}" required>
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <div class="flex items-center justify-end gap-4 pt-4">
            <button type="submit"
                class="px-8 py-3 bg-gradient-to-r from-primary to-blue-600 text-white font-semibold rounded-lg shadow-md hover:opacity-90 transition">
                Salvar Alterações
            </button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-500">Salvo.</p>
            @endif
        </div>
    </form>
</section>