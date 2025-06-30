# Cadastro de Funcionários com Laravel e Listagem Dinâmica com Alpine.js

## Tecnologias
- Laravel 10.48.29
- PHP 8.1.7
- MySQL
- Alpine.js (interatividade frontend)
- PHPUnit (testes automatizados)

## Instalação
```bash
git clone https://github.com/jdbilia/funcionarios.git
cd funcionarios
composer install
cp .env.example .env
php artisan key:generate
# configure .env com dados do banco
php artisan migrate --seed
php artisan serve
```

## Funcionalidades
- Cadastro, edição e exclusão de funcionários
- Listagem interativa com Alpine.js
- Validação com tratamento de erros
- Testes automatizados com PHPUnit

## Etapas do desenvolvimento
- Criação do Model
- Criação da migration e do banco de dados
- Criação da seed e da factory
- Desenvolvimento do controller com as validações e detecção de erros
- Criação das rotas e vinculção das mesmas aos métodos do controller
- Desenvolvimento da blade com Alpine.js
- Desenvolvimento dos testes