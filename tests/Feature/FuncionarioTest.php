<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Funcionario;

class FuncionarioTest extends TestCase
{
    use RefreshDatabase;

    public function test_criar_funcionario()
    {
        $response = $this->post('/funcionarios', [
            'nome' => 'João da Silva',
            'email' => 'joao@example.com',
            'cpf' => '12345678901',
            'cargo' => 'Analista',
            'dataAdmissao' => '2024-01-01',
            'salario' => 5000.00
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('funcionarios', ['email' => 'joao@example.com']);
    }

    public function test_listar_funcionarios()
    {
        Funcionario::factory()->count(3)->create();

        $response = $this->get('/api/funcionarios');
        $response->assertStatus(200);
        $response->assertJsonCount(3);
    }
}
