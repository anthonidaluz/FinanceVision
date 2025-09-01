<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Metas - Finance Vision</title>
    {{-- Seus links de fontes e CSS --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        :root {
            --primary-color: #3498DB; --text-dark: #2c3e50; --text-light: #7f8c8d;
            --border-color: #e9ecef; --background-color: #f8f9fa; --white: #ffffff;
            --status-progress: #ffc107; --status-completed: #28a745; --danger-color: #e74c3c;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--background-color); color: var(--text-dark); }
        .page-container { max-width: 1300px; margin: 0 auto; padding: 30px; }
        .page-header { display: flex; align-items: center; gap: 20px; }
        .back-arrow { font-size: 1.8rem; color: var(--text-dark); text-decoration: none; }
        .header-logo { font-size: 1.5rem; font-weight: 700; color: var(--primary-color); }
        .title-wrapper { text-align: center; margin: 20px 0 40px 0; }
        .title-wrapper h2 { font-size: 2.8rem; font-weight: 600; }
        .goals-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(550px, 1fr)); gap: 30px; }
        .goal-card {
            background-color: var(--white); border-radius: 12px; border: 2px solid var(--border-color);
            padding: 25px; display: flex; gap: 25px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .goal-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08); }
        .goal-card.status-progress { border-color: var(--status-progress); }
        .goal-card.status-completed { border-color: var(--status-completed); }
        .goal-info { flex: 1; display: flex; flex-direction: column; }
        .goal-info h3 { font-size: 1rem; color: var(--text-light); margin-bottom: 15px; }
        .goal-info p { font-size: 1rem; margin-bottom: 8px; line-height: 1.5; }
        .goal-info p strong { font-weight: 600; color: var(--text-dark); }
        .goal-actions { display: flex; gap: 10px; margin-top: auto; }
        .goal-actions .btn {
            padding: 8px 20px; border-radius: 8px; border: none; cursor: pointer;
            font-weight: 600; text-decoration: none; display: inline-flex;
            align-items: center; gap: 8px;
        }
        .goal-actions .btn-edit { background-color: var(--primary-color); color: var(--white); }
        .goal-actions .btn-delete-form { margin: 0; } /* Reset para o formulário do botão de exclusão */
        .goal-actions .btn-delete {
            background-color: transparent; color: var(--danger-color); border: 2px solid var(--danger-color);
            width: 100%; height: 100%;
        }
        .goal-chart { width: 150px; flex-shrink: 0; position: relative; }
        @property --p { syntax: '<number>'; inherits: false; initial-value: 0; }
        .donut-chart {
            width: 130px; height: 130px; border-radius: 50%; position: relative;
            background: conic-gradient(var(--status-completed) 0% calc(var(--p) * 1%), var(--danger-color) calc(var(--p) * 1%) 100%);
            display: flex; justify-content: center; align-items: center; transition: --p 1s ease-out;
        }
        .donut-chart::after { content: ''; position: absolute; width: 80%; height: 80%; background: var(--white); border-radius: 50%; }
        .chart-percentage { position: relative; font-size: 1.8rem; font-weight: 700; color: var(--text-dark); }
        .add-goal-card {
            display: flex; justify-content: center; align-items: center; gap: 15px;
            border: 2px dashed var(--primary-color); border-radius: 12px; min-height: 200px;
            font-size: 1.2rem; font-weight: 600; color: var(--primary-color);
            text-decoration: none; transition: background-color 0.2s;
        }
        .add-goal-card:hover { background-color: #eaf2ff; }
        .alert-success { background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="page-container">
        <header class="page-header">
            <a href="{{ route('dashboard') }}" class="back-arrow"><i class="fa-solid fa-arrow-left"></i></a>
            <h1 class="header-logo">Finance Vision</h1>
        </header>

        <div class="title-wrapper">
            <h2>Minhas Metas Financeiras</h2>
        </div>

        @if(session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <main class="goals-grid">
            @forelse ($metas as $meta)
                <article class="goal-card {{ $meta->progress >= 100 ? 'status-completed' : 'status-progress' }}">
                    <div class="goal-info">
                        <h3>META {{ $loop->iteration }}</h3>
                        <p><strong>Título:</strong> {{ $meta->name }}</p>
                        <p><strong>Status:</strong> {{ $meta->progress >= 100 ? 'Concluída' : 'Em Progresso...' }}</p>
                        <p><strong>Objetivo:</strong> R$ {{ number_format($meta->target_amount, 2, ',', '.') }}</p>
                        <p><strong>Poupado:</strong> R$ {{ number_format($meta->current_amount, 2, ',', '.') }}</p>
                        <p><strong>Prazo:</strong> {{ $meta->target_date ? \Carbon\Carbon::parse($meta->target_date)->format('m/Y') : 'Sem prazo' }}</p>
                        <div class="goal-actions">
                            <a href="{{ route('metas.edit', $meta) }}" class="btn btn-edit"><i class="fa-solid fa-pencil"></i> EDITAR</a>
                            <form action="{{ route('metas.destroy', $meta) }}" method="POST" class="btn-delete-form" onsubmit="return confirm('Tem certeza que deseja excluir esta meta?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete"><i class="fa-solid fa-xmark"></i> EXCLUIR</button>
                            </form>
                        </div>
                    </div>
                    <div class="goal-chart">
                        <div class="donut-chart" style="--p: {{ $meta->progress }};">
                            <span class="chart-percentage">{{ round($meta->progress) }}%</span>
                        </div>
                    </div>
                </article>
            @empty
                <p>Nenhuma meta encontrada. Que tal adicionar uma?</p>
            @endforelse

            <a href="{{route('metas.create')}}" class="add-goal-card">
                <i class="fa-solid fa-plus"></i>
                <span>Adicionar nova meta</span>
            </a>
        </main>
    </div>
    {{-- Seu script de animação do gráfico aqui, se necessário --}}
</body>
</html>