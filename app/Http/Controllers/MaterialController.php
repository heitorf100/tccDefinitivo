<?php

namespace App\Http\Controllers;

use App\Models\Catalogo\Material;
use App\Http\Requests\MaterialFormRequest;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $materiais = Material::orderBy('descricao')->get();
        return view('materiais.index', compact('materiais'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('materiais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MaterialFormRequest $request)
    {
        // 1. Recebe os dados já validados (incluindo a verificação de 2MB)
        $dados = $request->validated();

        // 2. Verifica se a imagem foi enviada e se é válida
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Guarda o ficheiro na pasta 'storage/app/public/materiais'
            $caminho = $request->imagem->store('materiais', 'public');
            // Adiciona o caminho da imagem no array de dados a serem salvos
            $dados['imagem'] = $caminho;
        }

        // 3. Salva no banco de dados
        Material::create($dados);

        return redirect()->to('/materiais')->with('sucesso', 'Material cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Material $material)
    {
        return view('materiais.show', compact('material'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        return view('materiais.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MaterialFormRequest $request, Material $material)
    {
        $material->update($request->validated());

        return redirect()->to('/materiais')->with('sucesso', 'Material atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->to('/materiais')->with('sucesso', 'Material removido com sucesso!');
    }
}