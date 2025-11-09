<!DOCTYPE html>
<html lang="pt-br" class="scroll-smooth">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Conheça a equipe e a missão por trás do Finance Vision — uma plataforma criada para simplificar a gestão financeira pessoal.">

    <title>Sobre Nós • {{ config('app.name', 'Finance Vision') }}</title>

    <!-- Fonte Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <!-- Ícones Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans bg-gradient-to-br from-gray-50 via-white to-gray-100 text-gray-800 antialiased selection:bg-primary/20 selection:text-primary">

    <!-- Cabeçalho -->
    <header class="sticky top-0 z-50 bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm">
        <nav class="flex justify-between items-center max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            <a href="/" class="flex items-center gap-2">
                <span
                    class="font-extrabold text-2xl tracking-tight text-primary hover:text-primary/80 transition-colors">
                    Finance Vision
                </span>
            </a>
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-primary transition-colors">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-semibold text-gray-600 hover:text-primary transition-colors">Entrar</a>
                    <a href="{{ route('register') }}"
                        class="px-4 py-2 bg-gradient-to-r from-primary to-primary/80 text-white text-sm font-semibold rounded-lg shadow hover:scale-105 transition">
                        Começar Gratuitamente
                    </a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        <!-- Hero -->
        <section
            class="relative py-24 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-primary/10 via-white to-primary/5 overflow-hidden">
            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                    Nossa missão é simplificar a sua <span class="text-primary">vida financeira!</span>
                </h1>
                <p class="mt-6 text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    O <strong>Finance Vision</strong> nasceu como um Trabalho de Conclusão do Curso de Ciência da
                    Computação no
                    <strong>Instituto Federal de Santa Catarina (IFSC)</strong>, com o propósito de oferecer clareza e
                    controle financeiro para jovens.
                </p>
            </div>
        </section>

        <!-- Equipe -->
        <section class="py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-white via-gray-50 to-gray-100">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-14">
                    <h2
                        class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-primary to-primary/70 bg-clip-text text-transparent">
                        Quem Somos
                    </h2>
                    <p class="mt-3 text-gray-600 text-lg">As mentes por trás do projeto Finance Vision.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Anthoni -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 flex flex-col items-center text-center transition-transform hover:-translate-y-2 hover:shadow-2xl">
                        <div
                            class="w-40 h-40 rounded-full overflow-hidden mb-6 ring-4 ring-primary/30 transform hover:scale-105 transition">
                            <img src="{{ asset('images/profiles/Anthoni.jpg') }}" alt="Foto de Anthoni da Luz"
                                class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-2xl font-bold text-primary">Anthoni da Luz</h3>
                        <p class="text-gray-600 font-medium mb-4">Desenvolvedor Full-Stack</p>
                        <div class="flex gap-5">
                            <a href="https://github.com/anthonidaluz" target="_blank"
                                class="text-gray-400 hover:text-primary transition"><i
                                    class="fa-brands fa-github fa-xl"></i></a>
                            <a href="https://www.linkedin.com/in/anthonidaluz/" target="_blank"
                                class="text-gray-400 hover:text-[#0077B5] transition"><i
                                    class="fa-brands fa-linkedin fa-xl"></i></a>
                        </div>
                    </div>

                    <!-- Elias -->
                    <div
                        class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 flex flex-col items-center text-center transition-transform hover:-translate-y-2 hover:shadow-2xl">
                        <div
                            class="w-40 h-40 rounded-full overflow-hidden mb-6 ring-4 ring-primary/30 transform hover:scale-105 transition">
                            <img src="{{ asset('images/profiles/Elias.jpg') }}" alt="Foto de Elias Vinicius"
                                class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-2xl font-bold text-primary">Elias Vinicius</h3>
                        <p class="text-gray-600 font-medium mb-4">Desenvolvedor & Analista</p>
                        <div class="flex gap-5">
                            <a href="https://github.com/EliasViniciusRaitz" target="_blank"
                                class="text-gray-400 hover:text-primary transition"><i
                                    class="fa-brands fa-github fa-xl"></i></a>
                            <a href="https://www.linkedin.com/in/elias-vinicius-raitz-de-oliveira-9579a7295/"
                                target="_blank" class="text-gray-400 hover:text-[#0077B5] transition"><i
                                    class="fa-brands fa-linkedin fa-xl"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- IFSC -->
        <section
            class="relative py-20 bg-gradient-to-r from-primary/90 via-primary/80 to-primary text-gray-100 text-center">
            <div class="max-w-4xl mx-auto px-6 relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-6">
                    Desenvolvido no IFSC
                </h2>
                <p class="text-lg md:text-xl leading-relaxed opacity-90">
                    Este projeto foi desenvolvido como parte dos requisitos para obtenção de grau no
                    <strong class="text-white">Instituto Federal de Santa Catarina</strong>.
                    Agradecemos aos professores e orientadores pelo apoio e conhecimento compartilhado durante toda a
                    jornada.
                </p>
                <img src="{{ asset('images/ifsc_logo.png') }}" alt="IFSC"
                    class="h-20 mx-auto mt-10 opacity-90 hover:opacity-100 transition transform hover:scale-105 duration-300">
            </div>
        </section>
    </main>

    <!-- Rodapé -->
    <footer class="bg-gradient-to-r from-gray-100 via-white to-gray-100 py-8 px-4 border-t border-gray-200">
        <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Finance Vision') }}. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>