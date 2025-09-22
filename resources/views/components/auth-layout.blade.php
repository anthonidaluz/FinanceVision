<!DOCTYPE html>
<html lang="pt-br" class="h-full bg-gray-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name', 'Finance Vision') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="h-full font-sans antialiased">
    {{-- Fundo com imagem e degradê --}}
    <div class="relative min-h-screen flex items-center justify-center bg-gray-900">
        <img class="absolute inset-0 h-full w-full object-cover filter blur-sm"
            src="{{ asset('images/background_auth.jpg') }}" alt="Imagem de fundo com tema de finanças">

        {{-- Overlay degradê para contraste --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-black/20"></div>

        {{-- Card central --}}
        <div class="relative z-10 w-full max-w-md mx-auto px-6">
            <div class="bg-white/95 backdrop-blur-md shadow-2xl rounded-3xl p-10">

                {{-- Logo centralizada --}}
                <div class="flex justify-center mb-8">
                    <a href="/">
                        <img class="h-20 w-auto" src="{{ asset('images/financevision_logo.png') }}"
                            alt="Finance Vision">
                    </a>
                </div>

                {{-- Slot do formulário (login / registro) --}}
                {{ $slot }}

            </div>
        </div>
    </div>
</body>

</html>