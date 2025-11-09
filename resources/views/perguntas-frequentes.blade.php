{{-- resources/views/faq.blade.php --}}
<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Perguntas Frequentes (FAQ) - {{ config('app.name', 'Finance Vision') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="font-sans antialiased bg-gray-50 text-gray-800">

    {{-- Cabeçalho/Navegação --}}
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-sm border-b border-gray-100">
        <nav class="flex justify-between items-center max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <a href="/" class="flex items-center gap-2">
                <span class="font-bold text-2xl" style="color:#3498db;">
                    Finance Vision
                </span>

            </a>
            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}"
                    class="text-sm font-semibold text-gray-600 hover:text-[#3498db]">Entrar</a>
                <a href="{{ route('register') }}"
                    class="px-4 py-2 bg-[#3498db] text-white text-sm font-semibold rounded-lg shadow-sm hover:bg-[#1e74c8] transition-colors">
                    Começar Gratuitamente
                </a>
            </div>
        </nav>
    </header>

    <main class="py-16 min-h-dvh">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ open: 1 }">

            {{-- Título --}}
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight">Perguntas Frequentes</h1>
                <p class="mt-3 text-lg text-gray-600">Encontre respostas rápidas para as principais dúvidas sobre o
                    Finance Vision.</p>
            </div>

            {{-- FAQ --}}
            <section class="bg-white p-8 rounded-2xl shadow-2xl border border-gray-100 transition">
                <ul class="divide-y divide-gray-200">
                    <li class="py-6" x-data="{ id: 1 }">
                        <button
                            class="w-full flex justify-between items-center text-left gap-4 outline-none focus:text-[#3498db] transition"
                            @click="open = open === id ? null : id" :aria-expanded="open === id">
                            <span class="text-lg font-semibold text-gray-900">O que é o Finance Vision?</span>
                            <i class="fa-solid text-[#3498db] transition-transform"
                                :class="open === id ? 'fa-minus' : 'fa-plus'"></i>
                        </button>
                        <div x-show="open === id" x-collapse.duration.300ms class="mt-4 text-gray-700">
                            <p>
                                O Finance Vision é uma plataforma de controle financeiro pessoal pensada para jovens.
                                Aqui você aprende a organizar receitas, despesas e criar metas, tudo de forma prática,
                                visual e interativa.
                            </p>
                        </div>
                    </li>
                    <li class="py-6" x-data="{ id: 2 }">
                        <button
                            class="w-full flex justify-between items-center text-left gap-4 outline-none focus:text-[#3498db] transition"
                            @click="open = open === id ? null : id" :aria-expanded="open === id">
                            <span class="text-lg font-semibold text-gray-900">Por que meu card "Receitas" do Dashboard
                                não soma alguns lançamentos?</span>
                            <i class="fa-solid text-[#3498db]" :class="open === id ? 'fa-minus' : 'fa-plus'"></i>
                        </button>
                        <div x-show="open === id" x-collapse.duration.300ms class="mt-4 text-gray-700">
                            <p>
                                O card "Receitas (Mês)" mostra apenas o seu saldo disponível para gastos. Valores
                                transferidos para metas aparecem no progresso das metas, não no seu saldo mensal — assim
                                sua visão do que pode gastar realmente fica mais clara.
                            </p>
                        </div>
                    </li>
                    <li class="py-6" x-data="{ id: 3 }">
                        <button
                            class="w-full flex justify-between items-center text-left gap-4 outline-none focus:text-[#3498db] transition"
                            @click="open = open === id ? null : id" :aria-expanded="open === id">
                            <span class="text-lg font-semibold text-gray-900">É seguro fazer login com o Google?</span>
                            <i class="fa-solid text-[#3498db]" :class="open === id ? 'fa-minus' : 'fa-plus'"></i>
                        </button>
                        <div x-show="open === id" x-collapse.duration.300ms class="mt-4 text-gray-700">
                            <p>
                                Sim! Utilizamos OAuth 2.0, o padrão da indústria. Suas credenciais nunca passam pelo
                                nosso sistema — sua privacidade vem em primeiro lugar.
                            </p>
                        </div>
                    </li>
                    <li class="py-6" x-data="{ id: 4 }">
                        <button
                            class="w-full flex justify-between items-center text-left gap-4 outline-none focus:text-[#3498db] transition"
                            @click="open = open === id ? null : id" :aria-expanded="open === id">
                            <span class="text-lg font-semibold text-gray-900">Como funciona o "Importador Mágico" de
                                CSV?</span>
                            <i class="fa-solid text-[#3498db]" :class="open === id ? 'fa-minus' : 'fa-plus'"></i>
                        </button>
                        <div x-show="open === id" x-collapse.duration.300ms class="mt-4 text-gray-700">
                            <p>
                                Ao importar um CSV, a nossa inteligência artificial identifica datas, valores,
                                categorias e sugere tudo para você revisar antes de importar — facilitando seu controle
                                de lançamentos.
                            </p>
                        </div>
                    </li>
                    <li class="py-6" x-data="{ id: 5 }">
                        <button
                            class="w-full flex justify-between items-center text-left gap-4 outline-none focus:text-[#3498db] transition"
                            @click="open = open === id ? null : id" :aria-expanded="open === id">
                            <span class="text-lg font-semibold text-gray-900">O que são Níveis, XP e Conquistas?</span>
                            <i class="fa-solid text-[#3498db]" :class="open === id ? 'fa-minus' : 'fa-plus'"></i>
                        </button>
                        <div x-show="open === id" x-collapse.duration.300ms class="mt-4 text-gray-700">
                            <ul class="list-disc ml-4 space-y-1">
                                <li><b>Conquistas:</b> badges por completar desafios e marcos.</li>
                                <li><b>Pontos (XP):</b> cada conquista traz XP para evoluir seu perfil.</li>
                                <li><b>Níveis:</b> quanto mais XP, maior seu nível e reconhecimento pelo progresso
                                    financeiro.</li>
                            </ul>
                        </div>
                    </li>
                    <li class="py-6" x-data="{ id: 6 }">
                        <button
                            class="w-full flex justify-between items-center text-left gap-4 outline-none focus:text-[#3498db] transition"
                            @click="open = open === id ? null : id" :aria-expanded="open === id">
                            <span class="text-lg font-semibold text-gray-900">
                                Como o Finance Vision protege meus dados financeiros?
                            </span>
                            <i class="fa-solid text-[#3498db]" :class="open === id ? 'fa-minus' : 'fa-plus'"></i>
                        </button>
                        <div x-show="open === id" x-collapse.duration.300ms class="mt-4 text-gray-700">
                            <p>
                                Levamos sua segurança a sério! Todos os dados são criptografados e armazenados em
                                servidores protegidos, seguindo os melhores padrões de segurança web. Você tem total
                                controle, podendo exportar ou excluir suas informações a qualquer momento. E nunca
                                compartilhamos nada sem sua autorização.
                            </p>
                        </div>
                    </li>

                    <li class="py-6" x-data="{ id: 7 }">
                        <button
                            class="w-full flex justify-between items-center text-left gap-4 outline-none focus:text-[#3498db] transition"
                            @click="open = open === id ? null : id" :aria-expanded="open === id">
                            <span class="text-lg font-semibold text-gray-900">O Finance Vision é gratuito?</span>
                            <i class="fa-solid text-[#3498db]" :class="open === id ? 'fa-minus' : 'fa-plus'"></i>
                        </button>
                        <div x-show="open === id" x-collapse.duration.300ms class="mt-4 text-gray-700">
                            <p>
                                No momento Sim! Você pode criar sua conta gratuitamente e utilizar todas as
                                funcionalidades
                                principais sem custo. No futuro, recursos premium poderão ser lançados, mas a base do
                                app no momento está gratuita!
                            </p>
                        </div>
                    </li>
                </ul>
            </section>

            {{-- CTA --}}
            <div class="mt-14 text-center">
                <h3 class="text-xl font-bold text-gray-900">Ainda com dúvidas?</h3>
                <p class="mt-2 text-gray-600">Fale com nosso suporte, será um prazer ajudar você!</p>
                <a href="mailto:contato@financevision.com"
                    class="mt-5 inline-flex items-center px-6 py-2 bg-[#3498db] text-white font-semibold rounded-lg shadow-md hover:bg-[#2178c5] focus:ring-2 focus:ring-offset-2 focus:ring-[#3498db] text-sm transition gap-2">
                    <i class="fa-solid fa-paper-plane"></i> Enviar e-mail
                </a>
            </div>
        </div>
    </main>

    {{-- Footer Profissional --}}
    <footer class="bg-white border-t border-gray-100 mt-12">
        <div class="max-w-6xl mx-auto px-4 py-6 text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name', 'Finance Vision') }}
        </div>
    </footer>
</body>

</html>