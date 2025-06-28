<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Funcionários</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body>
    <div class="container" x-data="app()" x-init="init()">
        <h1>🚀 Sistema de Cadastro de Funcionários</h1>

        <div class="card">
            <template x-for="funcionario in funcionarios" :key="funcionario.id">
                <div class="funcionario">
                    <span x-text="funcionario.nome"></span>
                    <div>
                        <button @click="editar(funcionario)">✏️</button>
                        <button @click="deletar(funcionario.id)">🗑️</button>
                    </div>
                </div>
            </template>
        </div>

        <div class="card">
            <h2 x-text="form.id ? 'Editar Funcionário' : 'Novo Funcionário'"></h2>
            <form @submit.prevent="salvar">
                <input type="text" x-model="form.nome" placeholder="Nome" required>
                <input type="email" x-model="form.email" placeholder="Email" required>
                <input type="text" x-model="form.cpf" placeholder="CPF" required>
                <input type="text" x-model="form.cargo" placeholder="Cargo">
                <input type="date" x-model="form.dataAdmissao" placeholder="Data de Admissão">
                <input type="number" x-model="form.salario" placeholder="Salário">
                <button type="submit" x-text="form.id ? 'Atualizar' : 'Salvar'"></button>
            </form>
        </div>
    </div>

    <script>
        function app() {
            return {
                funcionarios: [],
                form: {},

                init() {
                    this.fetchFuncionarios();
                },

                fetchFuncionarios() {
                    fetch('/api/funcionarios')
                        .then(res => res.json())
                        .then(data => this.funcionarios = data);
                },

                salvar() {
                    const method = this.form.id ? 'PUT' : 'POST';
                    const url = this.form.id ? `/funcionarios/${this.form.id}` : '/funcionarios';

                    fetch(url, {
                        method,
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').content
                        },
                        body: JSON.stringify(this.form)
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Erro ao salvar');
                        return res.json();
                    })
                    .then(() => {
                        this.fetchFuncionarios();
                        this.form = {};
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Erro ao salvar. Verifique os dados e tente novamente.');
                    });
                },

                editar(funcionario) {
                    this.form = { ...funcionario };
                },

                deletar(id) {
                    if (!confirm('Deseja realmente excluir este funcionário?')) return;

                    fetch(`/funcionarios/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=\"csrf-token\"]').content
                        }
                    }).then(() => this.fetchFuncionarios());
                }
            }
        }
    </script>
</body>
</html>
