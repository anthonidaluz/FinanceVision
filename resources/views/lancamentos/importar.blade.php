@extends('layouts.app')

@section('header')
    Importar Lançamentos
@endsection

@section('content')
    <div class="max-w-3xl mx-auto relative">

        {{-- Overlay de loading (fica oculto até o envio começar) --}}
        <div id="loading-overlay"
            class="hidden absolute inset-0 bg-white/90 flex flex-col items-center justify-center z-50 backdrop-blur-sm">
            <div class="flex flex-col items-center gap-4">
                <div class="animate-spin rounded-full h-14 w-14 border-t-4 border-primary border-solid"></div>
                <p class="text-gray-700 font-medium text-lg">
                    A IA está analisando seu extrato... 💡
                </p>
            </div>
        </div>

        <div
            class="bg-gradient-to-br from-white via-gray-50 to-gray-100 p-10 rounded-3xl shadow-2xl border border-gray-200 relative overflow-hidden">

            {{-- Efeito de brilho decorativo --}}
            <div
                class="absolute inset-0 pointer-events-none bg-gradient-to-tr from-primary/5 via-transparent to-transparent">
            </div>

            <header class="text-center mb-10 relative z-10">
                <h2
                    class="text-4xl font-extrabold text-gray-900 tracking-tight mb-2 flex items-center justify-center gap-2">
                    🚀 <span class="bg-gradient-to-r from-primary to-indigo-600 bg-clip-text text-transparent">
                        Importador Mágico
                    </span>
                </h2>
                <p class="text-gray-600 text-lg leading-relaxed max-w-xl mx-auto">
                    Poupe tempo e automatize suas finanças! Faça o upload do seu extrato bancário ou de cartão de crédito
                    (.csv)
                    e deixe nossa <strong class="text-primary">IA Financeira</strong> categorizar tudo por você.
                </p>
            </header>

            {{-- ### BLOCO DE FEEDBACK/ERRO ### --}}
            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6 relative z-10" role="alert">
                    <strong class="font-bold">Oops! Algo correu mal:</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6 relative z-10" role="alert">
                    <strong class="font-bold">Por favor, corrija os erros:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{-- ### FIM DO BLOCO DE FEEDBACK ### --}}

            <form id="importar-form" action="{{ route('lancamentos.importar.processar') }}" method="POST"
                enctype="multipart/form-data" class="relative z-10">
                @csrf

                {{-- Campo de upload --}}
                <div class="mb-6">
                    <label for="extrato" class="block text-sm font-semibold text-gray-700 mb-3">
                        Escolha o ficheiro de extrato (.csv)
                    </label>

                    <div
                        class="group flex items-center justify-center w-full border-2 border-dashed border-gray-300 rounded-xl hover:border-primary/60 transition p-6 cursor-pointer bg-white/80 backdrop-blur-sm hover:bg-primary/5">
                        <input type="file" name="extrato" id="extrato" required accept=".csv,text/csv" class="hidden peer"
                            onchange="document.getElementById('file-name').innerText = this.files[0]?.name ?? 'Nenhum arquivo selecionado'">

                        <label for="extrato" class="flex flex-col items-center justify-center cursor-pointer text-center">
                            <i
                                class="fa-solid fa-cloud-arrow-up text-4xl text-primary group-hover:scale-110 transition-transform mb-3"></i>
                            <span id="file-name"
                                class="text-gray-600 font-medium text-sm group-hover:text-primary transition">
                                Nenhum arquivo selecionado
                            </span>
                            <span class="mt-2 inline-block text-xs text-gray-500 group-hover:text-primary/80 transition">
                                Clique aqui para escolher seu extrato
                            </span>
                        </label>
                    </div>

                    @error('extrato')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Botões --}}
                <div class="flex items-center justify-end gap-4 mt-10 pt-6 border-t border-gray-200">
                    <a href="{{ route('lancamentos.index') }}"
                        class="inline-flex items-center px-6 py-2 bg-white border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-100 hover:shadow-sm transition text-sm">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Cancelar
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-primary to-indigo-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg hover:scale-[1.02] transition">
                        <i class="fa-solid fa-wand-magic-sparkles mr-2"></i> Analisar Ficheiro
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script para exibir o loading durante o envio --}}
    <script>
        document.getElementById('importar-form').addEventListener('submit', function () {
            // Mostra o overlay
            document.getElementById('loading-overlay').classList.remove('hidden');
        });
    </script>
@endsection