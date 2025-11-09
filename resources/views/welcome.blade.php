<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Vision - Bem-vindo</title>

    <!-- Fonte e Ícones -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Header -->
    <header class="py-4 px-6 bg-white shadow-sm">
        <nav class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center gap-2">
                <span class="font-bold text-2xl" style="color:#3498db;">
                    Finance Vision
                </span>

            </a>
            <div class="flex gap-3">
                <a href="/login"
                    class="px-4 py-2 border border-[#3498db] text-[#3498db] text-sm font-semibold rounded-lg hover:bg-[#3498db] hover:text-white transition">
                    Entrar
                </a>
                <a href="/register"
                    class="px-4 py-2 bg-[#3498db] text-white text-sm font-semibold rounded-lg shadow hover:bg-[#2980b9] transition">
                    Cadastre-se
                </a>
            </div>
        </nav>
    </header>

    <!-- Hero -->
    <section class="relative overflow-hidden bg-gradient-to-b from-white to-gray-100 py-20 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Texto -->
            <div class="text-center lg:text-left">
                <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight">
                    Controle suas <span style="color:#3498db;">finanças</span> com clareza
                </h1>
                <p class="mt-4 text-lg text-gray-600 max-w-lg mx-auto lg:mx-0">
                    Organize despesas, defina metas e visualize seu futuro financeiro em uma plataforma simples e
                    poderosa.
                </p>
                <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="/register"
                        class="px-8 py-4 bg-[#3498db] text-white text-lg font-bold rounded-lg shadow hover:bg-[#2980b9] transform hover:-translate-y-1 transition">
                        Comece Agora
                    </a>
                    <a href="/sobre-nos"
                        class="px-8 py-4 border border-gray-300 text-gray-700 text-lg font-semibold rounded-lg hover:bg-gray-100 transition">
                        Saiba Mais
                    </a>
                </div>
            </div>
            <!-- Imagem -->
            <img src="{{ asset('images/dashboard.png') }}" alt="Exemplo do Finance Vision"
                class="w-full rounded-xl shadow-xl">


        </div>
    </section>

    <!-- Funcionalidades -->
    <section class="py-20 px-6 bg-white">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900">Tudo em um só lugar</h2>
            <p class="mt-2 text-gray-500">Ferramentas práticas para simplificar sua vida financeira.</p>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card -->
                <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-lg transition">
                    <div
                        class="h-12 w-12 flex items-center justify-center rounded-full bg-[#3498db]/10 text-[#3498db] mx-auto">
                        <i class="fa-solid fa-wallet fa-lg"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold">Lançamentos rápidos</h3>
                    <p class="mt-2 text-sm text-gray-600">Registre receitas e despesas em segundos.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-lg transition">
                    <div
                        class="h-12 w-12 flex items-center justify-center rounded-full bg-[#3498db]/10 text-[#3498db] mx-auto">
                        <i class="fa-solid fa-bullseye fa-lg"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold">Metas claras</h3>
                    <p class="mt-2 text-sm text-gray-600">Defina objetivos e acompanhe seu progresso.</p>
                </div>
                <div class="p-6 bg-gray-50 rounded-xl shadow hover:shadow-lg transition">
                    <div
                        class="h-12 w-12 flex items-center justify-center rounded-full bg-[#3498db]/10 text-[#3498db] mx-auto">
                        <i class="fa-solid fa-chart-line fa-lg"></i>
                    </div>
                    <h3 class="mt-4 text-lg font-semibold">Relatórios inteligentes</h3>
                    <p class="mt-2 text-sm text-gray-600">Visualize seus hábitos e tome melhores decisões.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="bg-[#3498db] text-white text-center py-20 px-6">
        <div class="max-w-2xl mx-auto">
            <h2 class="text-3xl font-bold">Pronto para transformar sua vida financeira?</h2>
            <p class="mt-2 text-blue-100">Crie sua conta gratuita em menos de 1 minuto.</p>
            <a href="/register"
                class="mt-6 inline-flex items-center gap-2 px-8 py-3 bg-white text-[#3498db] font-bold rounded-lg shadow hover:bg-gray-100 transform hover:-translate-y-1 transition">
                Criar minha conta <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-8 px-6">
        <div
            class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-sm text-gray-500 gap-4">
            <p>&copy; 2025 Finance Vision. Todos os direitos reservados.</p>
            <div class="flex gap-4">
                <a href="/sobre-nos" class="hover:text-[#3498db]">Sobre Nós</a>
                <a href="/perguntas-frequentes" class="hover:text-[#3498db]">Perguntas Frequentes</a>
                <a href="/politica-de-privacidade" class="hover:text-[#3498db]">Política de Privacidade</a>
            </div>
        </div>
    </footer>

</body>

</html>