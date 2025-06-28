<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Exception;

class FuncionarioController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function listar()
    {
        try {
            return Funcionario::all();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nome' => 'required|string|max:150',
                'email' => 'required|email|unique:funcionarios,email',
                'cpf' => 'required|digits:11|unique:funcionarios,cpf',
                'cargo' => 'nullable|string|max:100',
                'dataAdmissao' => 'nullable|date',
                'salario' => 'nullable|numeric',
            ]);

            $funcionario = Funcionario::create($validated);
            return response()->json($funcionario, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $funcionario = Funcionario::findOrFail($id);

            $validated = $request->validate([
                'nome' => 'required|string|max:150',
                'email' => 'required|email|unique:funcionarios,email,' . $id,
                'cpf' => 'required|digits:11|unique:funcionarios,cpf,' . $id,
                'cargo' => 'nullable|string|max:100',
                'dataAdmissao' => 'nullable|date',
                'salario' => 'nullable|numeric',
            ]);

            $funcionario->update($validated);
            return response()->json($funcionario);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $funcionario = Funcionario::findOrFail($id);
            $funcionario->delete();
            return response()->noContent();
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
