<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- IMPORTANTE: Adiciona o token de segurança CSRF que o Laravel exige -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Finance Vision</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* --- Reset e Estilos Globais --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #495057;
        }

        .main-container {
            display: flex;
            width: 100vw;
            height: 100vh;
            background-color: #fff;
        }

        .login-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 450px;
        }

        .login-content {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #3498DB;
            margin-bottom: 40px;
        }

        .form-wrapper h2 {
            font-size: 32px;
            font-weight: 600;
            color: #212529;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 30px;
        }

        form {
            width: 100%;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #495057;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 15px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: #3498DB;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.15);
        }

        /* NOVO: Estilo para mensagens de erro */
        .error-message {
            color: #e3342f; /* Vermelho */
            font-size: 12px;
            margin-top: 4px;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 45px;
        }

        .password-icon {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            color: #6c757d;
            cursor: pointer;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .remember-me label {
            margin-bottom: 0;
            cursor: pointer;
        }

        .forgot-password,
        .signup-link a {
            color: #3498DB;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover,
        .signup-link a:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: opacity 0.3s ease;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-primary {
            background-color: #3498DB;
            color: #fff;
        }

        .btn-google {
            background-color: #fff;
            color: #495057;
            border: 1px solid #ced4da;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 12px;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            color: #adb5bd;
            margin: 25px 0;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }

        .separator span {
            padding: 0 15px;
        }

        .signup-link {
            text-align: center;
            margin-top: 30px;
            font-size: 15px;
        }

        .image-section {
            flex: 1.5;
            background: url('/images/tlogin.png'); /* Certifique-se que esta imagem está na pasta `public/images` */
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        @media (max-width: 992px) {
            .main-container {
                flex-direction: column;
            }

            .image-section {
                display: none;
            }

            .login-section {
                min-width: unset;
                padding: 40px 20px;
                flex-grow: 1;
            }
        }
    </style>
</head>

<body>
    <main class="main-container">
        <section class="login-section">
            <div class="login-content">
                <header class="login-header">
                    <h1>Finance Vision</h1>
                </header>

                <div class="form-wrapper">
                    <h2>Login</h2>
                    <p class="subtitle">Por favor, faça o login para acessar sua conta.</p>

                    <!-- O formulário agora aponta para a rota de login do Laravel -->
                    <form method="POST" action="{{ route('login') }}">
                        <!-- Token de segurança OBRIGATÓRIO do Laravel -->
                        @csrf

                        <div class="input-group">
                            <label for="email">Email</label>
                            <!-- O `name="email"` é como o Laravel identifica o campo -->
                            <!-- `value="{{ old('email') }}"` preenche o campo com o valor antigo se houver um erro -->
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            <!-- Exibe erros de validação para o campo de email -->
                            @error('email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="password">Senha</label>
                            <div class="password-wrapper">
                                <!-- O `name="password"` é como o Laravel identifica o campo de senha -->
                                <input type="password" id="password" name="password" required>
                                <svg class="password-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </div>
                            <!-- Exibe erros de validação para o campo de senha -->
                             @error('password')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-options">
                            <div class="remember-me">
                                <!-- O `name="remember"` é como o Laravel identifica esta opção -->
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Manter conectado</label>
                            </div>
                            <!-- Link dinâmico para a página de "esqueci a senha" -->
                            <a href="{{ route('password.request') }}" class="forgot-password">Esqueci minha senha</a>
                        </div>

                        <button type="submit" class="btn btn-primary">Acessar</button>
                    </form>

                    <div class="separator">
                        <span>ou</span>
                    </div>

                    <button class="btn btn-google">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg"
                            alt="Google Logo" width="20" height="20">
                        Entre com o Google
                    </button>

                    <p class="signup-link">
                        Precisa de uma Conta? <a href="{{ route('register') }}">Clique Aqui</a> <!-- Link dinâmico para a página de registro -->
                    </p>
                </div>
            </div>
        </section>

        <section class="image-section"></section>
    </main>
</body>
</html>