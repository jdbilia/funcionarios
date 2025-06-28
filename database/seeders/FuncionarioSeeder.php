<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Funcionario;

class FuncionarioSeeder extends Seeder
{
    public function run(): void
    {
        Funcionario::factory()->count(10)->create();
    }
}
