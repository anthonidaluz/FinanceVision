<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            /* O container principal agora controla o layout */
        }

        /* --- Container Principal (AJUSTADO PARA TELA CHEIA) --- */
        .main-container {
            display: flex;
            width: 100vw;
            /* Ocupa 100% da largura da tela */
            height: 100vh;
            /* Ocupa 100% da altura da tela */
            background-color: #fff;
        }

        /* --- Seção de Login (Esquerda) --- */
        .login-section {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 450px;
            /* Garante espaço mínimo para o formulário */
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

        /* --- Formulário e Inputs --- */
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

        /* --- Opções do Formulário e Links --- */
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

        /* --- Botões --- */
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

        /* --- Separador "ou" --- */
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

        /* --- Link para Cadastro --- */
        .signup-link {
            text-align: center;
            margin-top: 30px;
            font-size: 15px;
        }

        /* --- Seção da Imagem (Direita) --- */
        .image-section {
            flex: 1.5;
            /* Deixa a imagem um pouco maior */
            background: url('/images/tlogin.png');
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
        }

        /* --- Responsividade --- */
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

                    <form action="#">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="" required>
                        </div>

                        <div class="input-group">
                            <label for="password">Senha</label>
                            <div class="password-wrapper">
                                <input type="password" id="password" name="password" required>
                                <svg class="password-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </div>
                        </div>

                        <div class="form-options">
                            <div class="remember-me">
                                <input type="checkbox" id="remember" name="remember">
                                <label for="remember">Manter conectado</label>
                            </div>
                            <a href="#" class="forgot-password">Esqueci minha senha</a>
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
                        Precisa de uma Conta? <a href="#">Clique Aqui</a>
                    </p>
                </div>
            </div>
        </section>

        <section class="image-section">
        </section>
    </main>

</body>

</html>