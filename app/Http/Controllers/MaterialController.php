<?php

namespace App\Http\Controllers;

use App\Models\Catalogo\Material;
use App\Http\Requests\MaterialFormRequest;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    public function index()
    {
        $materiais = Material::orderBy('codigo')->get();
        return view('materiais.index', compact('materiais'));
    }

    public function create()
    {
        return view('materiais.create');
    }

    public function store(MaterialFormRequest $request)
    {
        $dados = $request->validated();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $dados['imagem'] = $request->imagem->store('materiais', 'public');
        }

        Material::create($dados);

        return redirect()->to('/materiais')->with('sucesso', 'Material cadastrado com sucesso!');
    }

    public function show(Material $material)
    {
        return view('materiais.show', compact('material'));
    }

    public function edit(Material $material)
    {
        return view('materiais.edit', compact('material'));
    }

    public function update(MaterialFormRequest $request, Material $material)
    {
        $dados = $request->validated();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            if ($material->imagem) {
                Storage::disk('public')->delete($material->imagem);
            }
            $dados['imagem'] = $request->imagem->store('materiais', 'public');
        }

        $material->update($dados);

        return redirect()->to('/materiais')->with('sucesso', 'Material atualizado com sucesso!');
    }

    public function destroy(Material $material)
    {
        if ($material->imagem) {
            Storage::disk('public')->delete($material->imagem);
        }

        $material->delete();

        return redirect()->to('/materiais')->with('sucesso', 'Material removido com sucesso!');
    }
}