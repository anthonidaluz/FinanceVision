<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Nova Meta - Finance Vision</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-color: #3498DB; --text-dark: #2c3e50; --border-color: #e9ecef;
            --background-color: #f8f9fa; --white: #ffffff;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--background-color); color: var(--text-dark); }
        .page-container { max-width: 800px; margin: 0 auto; padding: 30px; }
        .page-header { display: flex; align-items: center; gap: 20px; }
        .back-arrow { font-size: 1.8rem; color: var(--text-dark); text-decoration: none; }
        .header-logo { font-size: 1.5rem; font-weight: 700; color: var(--primary-color); }
        .page-title { text-align: center; font-size: 2.8rem; font-weight: 600; margin: 20px 0 30px 0; }
        .form-card { background: var(--white); border: 1px solid var(--border-color); border-radius: 12px; padding: 30px; }
        .input-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }
        .input-group label { font-weight: 500; font-size: 0.9rem; color: var(--text-dark); }
        .input-group input {
            width: 100%; padding: 12px 15px; font-size: 0.95rem; border: 1px solid var(--border-color);
            border-radius: 8px; font-family: 'Poppins', sans-serif;
        }
        .error-message { color: #e3342f; font-size: 12px; }
        .actions-container { text-align: center; margin-top: 30px; }
        .btn-save {
            background-color: var(--primary-color); color: var(--white); border: none; padding: 14px 60px;
            font-size: 1rem; font-weight: 600; border-radius: 8px; cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="page-container">
        <header class="page-header">
            <a href="{{ route('metas.index') }}" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
            <h1 class="header-logo">Finance Vision</h1>
        </header>
        <h2 class="page-title">Criar Nova Meta</h2>

        <div class="form-card">
            <form action="{{ route('metas.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="name">Nome da Meta</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Ex: Viagem de Férias" required>
                    @error('name') <div class="error-message">{{ $message }}</div> @enderror
                </div>
                <div class="input-group">
                    <label for="target_amount">Valor Alvo (R$)</label>
                    <input type="number" step="0.01" id="target_amount" name="target_amount" value="{{ old('target_amount') }}" placeholder="5000.00" required>
                    @error('target_amount') <div class="error-message">{{ $message }}</div> @enderror
                </div>
                <div class="input-group">
                    <label for="target_date">Data Alvo (Opcional)</label>
                    <input type="date" id="target_date" name="target_date" value="{{ old('target_date') }}">
                    @error('target_date') <div class="error-message">{{ $message }}</div> @enderror
                </div>
                <div class="actions-container">
                    <button type="submit" class="btn-save">Salvar Meta</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>