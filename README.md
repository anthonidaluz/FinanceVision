# 📘 Finance Vision

Um Sistema de Controle de Finanças Pessoais desenvolvido com foco em jovens e na simplicidade. O principal objetivo é ajudar usuários a entenderem melhor sua vida financeira, registrando receitas, despesas e metas através de uma interface moderna e fácil de usar.

## 📌 Funcionalidades (Status Atual)

- ✅ **Autenticação Completa:** Cadastro, login, logout e recuperação de senha com interface profissional e personalizada.
- ✅ **Dashboard Dinâmico:** Painel principal com resumo financeiro (receitas, despesas) e gráficos interativos.
- ✅ **CRUD de Lançamentos:** Funcionalidade completa para Criar, Ler, Editar e Excluir transações financeiras.
- ✅ **CRUD de Metas:** Funcionalidade completa para Criar, Ler, Editar e Excluir metas de poupança, com cálculo de progresso.
- ✅ **CRUD de Categorias:** Funcionalidade completa para o usuário gerenciar suas próprias categorias.
- ✅ **Integração:** Lançamentos são vinculados a Categorias e Metas, atualizando o progresso automaticamente.
- ✅ **Páginas de Conteúdo:** Telas consistentes para Dicas Financeiras, Configurações e um hub para futuros Relatórios.
- ✅ **Interface Responsiva:** Layout que se adapta a desktops, tablets e dispositivos móveis, incluindo menu lateral funcional.
- 🚧 **Relatórios Detalhados:** Em desenvolvimento.
- ⏳ **Gamificação e Notificações:** Planejado para futuras versões.

## 🎯 Público-Alvo

Jovens, estudantes e pessoas iniciando sua jornada financeira, que desejam aprender a organizar suas finanças de forma consciente e estruturada.

## 💻 Tecnologias Utilizadas

- **Frontend:** HTML, **Tailwind CSS**, JavaScript, **Alpine.js**, Blade (Laravel)
- **Backend:** PHP, **Laravel Framework**
- **Banco de Dados:** MySQL
- **Gráficos e visualizações:** **Chart.js**

---

## 🚀 Como Rodar o Projeto

Siga os passos abaixo para configurar e executar o projeto em seu ambiente de desenvolvimento local.

### Pré-requisitos

Antes de começar, garanta que você tenha as seguintes ferramentas instaladas:
- PHP (versão ^8.1 ou superior)
- Composer
- Node.js e NPM
- Um servidor de banco de dados (ex: MySQL, MariaDB)

### Passos para Instalação

1.  **Clone o repositório:**
    ```bash
    git clone [https://github.com/anthonidaluz/FinanceVision.git](https://github.com/anthonidaluz/FinanceVision.git)
    ```

2.  **Acesse o diretório do projeto:**
    ```bash
    cd FinanceVision
    ```

3.  **Instale as dependências do PHP:**
    ```bash
    composer install
    ```

4.  **Crie o arquivo de ambiente:**
    Copie o arquivo de exemplo `.env.example` para `.env`.
    ```bash
    cp .env.example .env
    ```
    *(No Windows, use `copy .env.example .env`)*

5.  **Gere a chave da aplicação:**
    ```bash
    php artisan key:generate
    ```

6.  **Configure o Banco de Dados:**
    Abra o arquivo `.env` e edite as seguintes linhas com as credenciais do seu banco de dados:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=finance_vision
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    *Lembre-se de criar um banco de dados com o nome `finance_vision` (ou o nome que você preferir).*

7.  **Execute as Migrations e os Seeders:**
    Este comando irá apagar o banco, recriar todas as tabelas e populá-las com dados de teste (usuário, categorias e 6 meses de lançamentos).
    ```bash
    php artisan migrate:fresh --seed
    ```

8.  **Instale as dependências do JavaScript:**
    ```bash
    npm install
    ```

### Executando a Aplicação

Para rodar a aplicação, você precisará de **dois terminais** abertos na pasta do projeto.

1.  **Terminal 1 - Inicie o servidor do Laravel:**
    ```bash
    php artisan serve
    ```

2.  **Terminal 2 - Inicie o compilador de assets (Vite):**
    ```bash
    npm run dev
    ```

3.  **Acesse no navegador:**
    Abra seu navegador e acesse [http://127.0.0.1:8000](http://127.0.0.1:8000). Use as credenciais de teste para logar:
    * **Email:** `teste@email.com`
    * **Senha:** `password`
