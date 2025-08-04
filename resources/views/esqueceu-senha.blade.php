<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha - Finance Vision</title>

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
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* --- Container Principal --- */
        .main-container {
            display: flex;
            width: 100%;
            max-width: 1200px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* --- Seção do Formulário (Esquerda) --- */
        .form-section {
            flex: 1;
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 450px;
        }

        .form-content {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        .form-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #3498DB;
            /* Azul do logo */
            margin-bottom: 60px;
        }

        .form-wrapper h2 {
            font-size: 2.1rem;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 40px;
        }

        /* --- Formulário e Inputs --- */
        form {
            width: 100%;
        }

        .input-group {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 500;
            color: #34495e;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 15px;
            font-size: 1rem;
            border-radius: 8px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: #3498DB;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }

        /* --- Botão Principal --- */
        .btn-primary {
            width: 100%;
            padding: 15px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #3498DB;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        /* --- Link de Login --- */
        .login-link {
            text-align: center;
            margin-top: 30px;
            font-size: 0.95rem;
        }

        .login-link a {
            color: #3498DB;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        /* --- Seção da Imagem (Direita) --- */
        .image-section {
            flex: 1.4;
            /* Deixa a imagem um pouco maior que o formulário */
            display: flex;
            background: url('/images/tpassword.png');

        }

        .image-section img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* --- Responsividade --- */
        @media (max-width: 992px) {
            .image-section {
                display: none;
            }

            .form-section {
                min-width: 100%;
                padding: 40px 25px;
            }

            .main-container {
                flex-direction: column;
                box-shadow: none;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>
    <main class="main-container">
        <section class="form-section">
            <div class="form-content">
                <header class="form-header">
                    <h1>Finance Vision</h1>
                </header>

                <div class="form-wrapper">
                    <h2>Recuperar senha</h2>
                    <p class="subtitle">Por favor, informe seu e-mail para recuperar sua senha.</p>

                    <form action="#" method="POST">
                        <div class="input-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>

                        <button type="submit" class="btn-primary">Recuperar</button>
                    </form>

                    <p class="login-link">
                        Já tem sua senha? <a href="#">Clique Aqui</a>
                    </p>
                </div>
            </div>
        </section>

        <section class="image-section">
        </section>
    </main>
</body>

</html>