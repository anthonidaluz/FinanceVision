@extends('layouts.app')

@section('header')
    Dicas Financeiras
@endsection

@section('content')
    <div x-data="{ tab: 'orcamento' }" class="max-w-7xl mx-auto">

        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold text-gray-800">📚 Central de Conhecimento</h2>
            <p class="mt-2 text-lg text-gray-600">Estratégias e insights para fortalecer sua saúde financeira.</p>
        </div>

        <div class="border-b border-gray-200 mb-8">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="#" @click.prevent="tab = 'orcamento'"
                    :class="{ 'border-primary text-primary': tab === 'orcamento', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'orcamento' }"
                    class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm items-center"><i
                        class="fa-solid fa-dollar-sign mr-2 w-5 text-center"></i> Orçamento</a>
                <a href="#" @click.prevent="tab = 'metas'"
                    :class="{ 'border-primary text-primary': tab === 'metas', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'metas' }"
                    class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm items-center"><i
                        class="fa-solid fa-crosshairs mr-2 w-5 text-center"></i> Metas</a>
                <a href="#" @click.prevent="tab = 'consumo'"
                    :class="{ 'border-primary text-primary': tab === 'consumo', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'consumo' }"
                    class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm items-center"><i
                        class="fa-solid fa-cart-shopping mr-2 w-5 text-center"></i> Consumo</a>
                <a href="#" @click.prevent="tab = 'investir'"
                    :class="{ 'border-primary text-primary': tab === 'investir', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': tab !== 'investir' }"
                    class="whitespace-nowrap flex py-4 px-1 border-b-2 font-medium text-sm items-center"><i
                        class="fa-solid fa-chart-line mr-2 w-5 text-center"></i> Investir</a>
            </nav>
        </div>

        <div x-show="tab === 'orcamento'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <x-tip-card theme="primary">
                <h3 class="text-lg font-semibold text-gray-800">A Regra 50/30/20</h3>
                <p class="text-sm text-gray-600 mt-2">Um método simples para organizar sua renda mensal:</p>
                <ul class="list-disc list-inside text-sm text-gray-600 space-y-1 mt-2">
                    <li><strong>50% para Gastos Essenciais:</strong> Moradia, contas, transporte, alimentação.</li>
                    <li><strong>30% para Desejos:</strong> Lazer, hobbies, jantares fora, compras não essenciais.</li>
                    <li><strong>20% para o Futuro:</strong> Poupança, investimentos e pagamento de dívidas.</li>
                </ul>
            </x-tip-card>
            <x-tip-card theme="danger">
                <h3 class="text-lg font-semibold text-gray-800">Crie sua Reserva de Emergência</h3>
                <p class="text-sm text-gray-600 mt-2">Antes de investir em ativos de risco, junte o equivalente a 3 a 6
                    meses de seu custo de vida. Este dinheiro deve ficar em um local seguro e de fácil acesso (como Tesouro
                    Selic ou um CDB com liquidez diária) para cobrir imprevistos como problemas de saúde ou perda de
                    emprego.</p>
            </x-tip-card>
        </div>

        <div x-show="tab === 'metas'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <x-tip-card theme="success">
                <h3 class="text-lg font-semibold text-gray-800">O Poder das Metas SMART</h3>
                <p class="text-sm text-gray-600 mt-2">Para serem eficazes, suas metas devem ser:</p>
                <ul class="list-disc list-inside text-sm text-gray-600 space-y-1 mt-2">
                    <li><strong>S</strong>pecific (Específicas)</li>
                    <li><strong>M</strong>easurable (Mensuráveis)</li>
                    <li><strong>A</strong>chievable (Atingíveis)</li>
                    <li><strong>R</strong>elevant (Relevantes)</li>
                    <li><strong>T</strong>ime-bound (Com Prazo)</li>
                </ul>
                <x-slot name="cta">
                    <a href="{{ route('metas.create') }}"
                        class="inline-flex items-center text-sm font-semibold text-primary hover:opacity-80">
                        Definir uma meta SMART agora <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                </x-slot>
            </x-tip-card>
            <x-tip-card theme="primary">
                <h3 class="text-lg font-semibold text-gray-800">Automatize suas Poupanças</h3>
                <p class="text-sm text-gray-600 mt-2">A maneira mais fácil de atingir uma meta é não ter que pensar nela.
                    Configure transferências automáticas mensais da sua conta corrente para sua conta de investimentos logo
                    após receber seu salário. Pague-se primeiro!</p>
            </x-tip-card>
        </div>

        <div x-show="tab === 'consumo'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <x-tip-card theme="warning">
                <h3 class="text-lg font-semibold text-gray-800">A Regra das 24 Horas</h3>
                <p class="text-sm text-gray-600 mt-2">Antes de fazer uma compra não essencial, especialmente online,
                    adicione o item ao carrinho e espere 24 horas. Na maioria das vezes, o desejo impulsivo passará e você
                    perceberá que não precisava realmente daquilo.</p>
            </x-tip-card>
            <x-tip-card theme="primary">
                <h3 class="text-lg font-semibold text-gray-800">Custo Real vs. Preço</h3>
                <p class="text-sm text-gray-600 mt-2">Pense no preço de um item em termos de horas de trabalho. Se você
                    ganha R$ 20 por hora, um item de R$ 100 não custa apenas R$ 100, mas sim 5 horas do seu tempo de vida.
                    Isso ajuda a avaliar se a compra realmente vale a pena.</p>
            </x-tip-card>
        </div>

        <div x-show="tab === 'investir'" x-transition class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
            <x-tip-card theme="info">
                <h3 class="text-lg font-semibold text-gray-800">Juros Compostos: A 8ª Maravilha</h3>
                <p class="text-sm text-gray-600 mt-2">O poder dos juros compostos é o seu maior aliado. Quanto mais cedo
                    você começar a investir, mesmo que com pouco, mais tempo seu dinheiro terá para crescer
                    exponencialmente. O tempo é mais importante que a quantia.</p>
            </x-tip-card>
            <x-tip-card theme="primary">
                <h3 class="text-lg font-semibold text-gray-800">Diversificação é Chave</h3>
                <p class="text-sm text-gray-600 mt-2">A famosa frase "não coloque todos os ovos na mesma cesta" é a regra de
                    ouro dos investimentos. Distribua seu dinheiro em diferentes tipos de ativos (renda fixa, ações, etc.)
                    para reduzir riscos e otimizar retornos a longo prazo.</p>
            </x-tip-card>
        </div>
    </div>
@endsection