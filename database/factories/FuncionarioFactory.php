<?php

namespace Database\Factories;

use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FuncionarioFactory extends Factory
{
    protected $model = Funcionario::class;

    public function definition(): array
    {
        return [
            'id' => Str::uuid(),
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'cpf' => $this->faker->unique()->numerify('###########'),
            'cargo' => $this->faker->jobTitle(),
            'dataAdmissao' => $this->faker->date(),
            'salario' => $this->faker->randomFloat(2, 1000, 10000),
        ];
    }
}

