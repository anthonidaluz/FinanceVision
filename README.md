# 📘 Finance Vision

Sistema de Controle de Finanças Pessoais desenvolvido com foco em jovens. O principal objetivo é ajudar usuários a entenderem melhor sua vida financeira, registrando receitas, despesas e metas através de uma interface moderna, intuitiva e engajadora.

## 📌 Funcionalidades (Status Atual)

### 🔐 Autenticação e Segurança
- ✅ **Autenticação Completa:** Cadastro e login por e-mail/senha com interface profissional.
- ✅ **Login Social:** Integração com **Google** para login rápido e seguro (via Laravel Socialite).
- ✅ **Recuperação de Senha:** Fluxo completo de "Esqueci minha senha" com envio de e-mails.

### 💰 Gestão Financeira
- ✅ **Dashboard Dinâmico:** Painel principal com KPIs em tempo real (Receitas, Despesas, Saldo) e gráficos interativos.
- ✅ **CRUD de Lançamentos:** Sistema completo para registrar receitas e despesas, com paginação AJAX para melhor experiência.
- ✅ **CRUD de Metas:** Definição de objetivos financeiros com barra de progresso automática baseada nos lançamentos vinculados.
- ✅ **CRUD de Categorias:** Personalização total de categorias com ícones e cores.
- ✅ **Importador Mágico (IA):** Funcionalidade avançada que permite importar extratos bancários (CSV) e usa **Inteligência Artificial (Google Gemini)** para categorizar automaticamente as transações.

### 🎮 Gamificação e Engajamento
- ✅ **Sistema de Conquistas:** Badges com diferentes raridades (Bronze, Prata, Ouro) desbloqueados automaticamente com base no uso da aplicação.
- ✅ **Níveis e XP:** Sistema de progressão onde o usuário ganha pontos de experiência e sobe de nível.
- ✅ **Feedback em Tempo Real:** Notificações "Toast" instantâneas ao desbloquear uma nova conquista.

### 🛠️ Outros Recursos
- ✅ **Design Responsivo:** Interface adaptada para desktops, tablets e telefones.
- ✅ **Páginas de Conteúdo:** Telas dedicadas para Dicas Financeiras e Configurações de Perfil.
- ✅ **Relatórios Avançados:** Relátorios de Fluxo de Caixa e Acompanhamento de Metas Financeiras para melhor visualização dos Dados.

---

## 🎯 Público-Alvo

Jovens, estudantes e pessoas iniciando sua jornada financeira, que desejam aprender a organizar suas finanças de forma consciente e estruturada.

## 💻 Tecnologias Utilizadas

- **Backend:** PHP 8.2+, **Laravel 11**
- **Frontend:** Blade, **Tailwind CSS**, Alpine.js
- **Banco de Dados:** MySQL
- **APIs Externas:** Google Gemini (IA), Google OAuth (Login Social)
- **Bibliotecas:** Chart.js (gráficos), Toastr.js (notificações)

---

## 🚀 Como Rodar o Projeto

Siga os passos abaixo para configurar e executar o projeto em seu ambiente de desenvolvimento local.

### Pré-requisitos

- PHP >= 8.2
- Composer
- Node.js e NPM
- Banco de dados MySQL

### Passos para Instalação

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/anthonidaluz/FinanceVision.git](https://github.com/anthonidaluz/FinanceVision.git)
    cd FinanceVision
    ```

2.  **Instale as dependências:**
    ```bash
    composer install
    npm install
    ```

3.  **Configure o ambiente:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *Abra o arquivo `.env` e configure suas credenciais de banco de dados (DB_...) e, opcionalmente, as chaves do Google (GOOGLE_CLIENT_ID, GEMINI_API_KEY) para testar todas as funcionalidades.*

4.  **Prepare o banco de dados:**
    ```bash
    php artisan migrate:fresh --seed
    ```

### Executando a Aplicação

Abra dois terminais na pasta do projeto:

* Terminal 1: `php artisan serve`
* Terminal 2: `npm run dev`

Acesse **http://127.0.0.1:8000** e use as credenciais de teste:
* **Email:** `teste@email.com`
* **Senha:** `password`

