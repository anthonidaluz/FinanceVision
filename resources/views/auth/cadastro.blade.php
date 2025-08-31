<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cadastre-se - Finance Vision</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #FFFFFF;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .main-container {
            display: flex;
            width: 100%;
            height: 100vh;
            background-color: #fff;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            border-radius: 12px;
            overflow: hidden;
        }

        .form-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 40px;
            min-width: 420px;
        }

        .form-wrapper {
            width: 100%;
            height: 118%;
            max-width: 360px;
        }

        .form-wrapper h1 {
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .form-wrapper .subtitle {
            font-size: 0.95rem;
            color: #7f8c8d;
            margin-bottom: 35px;
        }

        .input-group {
            margin-bottom: 22px;
        }

        .input-group label {
            display: block;
            font-size: 0.8rem;
            color: #34495e;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            color: #95a5a6;
            font-size: 1.1rem;
        }

        .input-wrapper input {
            width: 100%;
            padding: 14px 15px;
            font-size: 0.9rem;
            border: 1px solid #dfe4ea;
            border-radius: 8px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .input-wrapper input.has-icon {
            padding-left: 45px;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #3498DB;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.15);
        }

        #togglePassword {
            position: absolute;
            right: 15px;
            cursor: pointer;
            color: #95a5a6;
        }

        .btn {
            width: 100%;
            padding: 15px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .btn-primary {
            background-color: #3498DB;
            color: white;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }

        .btn-primary:hover {
            background-color: #3498DB;
            transform: translateY(-2px);
        }

        .btn-google {
            background-color: #ffffff;
            color: #444;
            border: 1px solid #dfe4ea;
            margin-top: 20px;
        }

        .btn-google:hover {
            background-color: #f8f9fa;
        }

        .btn-google img {
            width: 20px;
            height: 20px;
        }

        .separator {
            display: flex;
            align-items: center;
            text-align: center;
            color: #bdc3c7;
            margin: 25px 0;
            font-size: 0.9rem;
        }

        .separator::before,
        .separator::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ecf0f1;
        }

        .separator:not(:empty)::before {
            margin-right: .5em;
        }

        .separator:not(:empty)::after {
            margin-left: .5em;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: #7f8c8d;
        }

        .login-link a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .image-section {
            flex: 1.2;
            background-image: url('/images/tregister.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        @media (max-width: 992px) {
            .image-section {
                display: none;
            }

            .form-section {
                min-width: 100%;
                padding: 40px 25px;
            }

            .main-container {
                height: 100vh;
                border-radius: 0;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <main class="main-container">
        <section class="form-section">
            <div class="form-wrapper">
                <h1>Cadastre-se</h1>
                <p class="subtitle">Cadastre-se para aproveitar os recursos do Finance Vision.</p>

                <form action="{{-- route('register') --}}" method="POST">
                    @csrf
                    <div class="input-group">
                        <label for="name">Seu Nome</label>
                        <div class="input-wrapper">
                            <input type="text" id="name" name="name" required autocomplete="name">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="birthdate">Data de Aniversário</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-calendar"></i>
                            <input type="text" class="has-icon" id="birthdate" name="birthdate" required
                                onfocus="(this.type='date')" onblur="if(!this.value)this.type='text'">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="email">Email</label>
                        <div class="input-wrapper">
                            <input type="email" id="email" name="email" required autocomplete="email">
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="password">Senha</label>
                        <div class="input-wrapper">
                            <input type="password" id="password" name="password" required autocomplete="new-password">
                            <i class="fa-regular fa-eye-slash" id="togglePassword"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Criar Conta</button>

                    <div class="separator">ou</div>

                    <button type="button" class="btn btn-google">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Google_%22G%22_logo.svg"
                            alt="Logo do Google">
                        Continuar com o Google
                    </button>

                    <p class="login-link">
                        Já tem uma conta? <a href="/entrar">Clique Aqui</a>
                    </p>
                </form>
            </div>
        </section>

        <section class="image-section"></section>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            if (togglePassword) {
                togglePassword.addEventListener('click', function () {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }
        });
    </script>
</body>

</html>