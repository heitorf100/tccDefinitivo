<?php

namespace App\Http\Controllers;

use App\Models\Tipologia;
use App\Models\Catalogo\Material;
use App\Http\Requests\TipologiaFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TipologiaController extends Controller
{
    public function index()
    {
        $tipologias = Tipologia::withCount('materiais')->orderBy('codigo_ref')->get();
        return view('tipologias.index', compact('tipologias'));
    }

    public function create()
    {
        return view('tipologias.create');
    }

    public function store(TipologiaFormRequest $request)
    {
        $dados = $request->validated();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $dados['imagem_url'] = $request->imagem->store('tipologias', 'public');
        }

        unset($dados['imagem']);

        $tipologia = Tipologia::create($dados);

        return redirect()->to('/tipologias/' . $tipologia->id)
            ->with('sucesso', 'Tipologia cadastrada! Agora adicione os materiais e regras de corte abaixo.');
    }

    public function show($id)
    {
        $tipologia = Tipologia::with('materiais')->findOrFail($id);
        $materiaisDisponiveis = Material::orderBy('codigo')->get();

        return view('tipologias.show', compact('tipologia', 'materiaisDisponiveis'));
    }

    public function edit($id)
    {
        $tipologia = Tipologia::findOrFail($id);
        return view('tipologias.edit', compact('tipologia'));
    }

    public function update(TipologiaFormRequest $request, $id)
    {
        $tipologia = Tipologia::findOrFail($id);
        $dados = $request->validated();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            if ($tipologia->imagem_url) {
                Storage::disk('public')->delete($tipologia->imagem_url);
            }
            $dados['imagem_url'] = $request->imagem->store('tipologias', 'public');
        }

        unset($dados['imagem']);

        $tipologia->update($dados);

        return redirect()->to('/tipologias')->with('sucesso', 'Tipologia atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $tipologia = Tipologia::findOrFail($id);
        $imagemAntiga = $tipologia->imagem_url;

        try {
            $tipologia->delete();

            if ($imagemAntiga) {
                Storage::disk('public')->delete($imagemAntiga);
            }

            return redirect()->to('/tipologias')->with('sucesso', 'Tipologia excluída do catálogo!');
        } catch (\Exception $e) {
            return redirect()->to('/tipologias')
                ->with('erro', 'Não é possível excluir este modelo, pois ele já faz parte de um ou mais orçamentos.');
        }
    }

    public function adicionarMaterial(Request $request, $id)
    {
        $tipologia = Tipologia::findOrFail($id);

        $dados = $request->validate([
            'material_id'         => ['required', 'exists:materiais,id'],
            'tipo_calculo'        => ['required', 'in:LARGURA,ALTURA,AREA,UNIDADE'],
            'quantidade_pecas'    => ['required', 'integer', 'min:1', 'max:999'],
            'desconto_largura_mm' => ['nullable', 'integer', 'min:-5000', 'max:5000'],
            'desconto_altura_mm'  => ['nullable', 'integer', 'min:-5000', 'max:5000'],
            'observacao_corte'    => ['nullable', 'string', 'max:150'],
        ], [
            'material_id.required'      => 'Selecione um material do catálogo.',
            'tipo_calculo.required'     => 'Selecione a regra de cálculo.',
            'quantidade_pecas.required' => 'Informe a quantidade de peças.',
        ]);

        $tipologia->materiais()->attach($dados['material_id'], [
            'tipo_calculo'        => $dados['tipo_calculo'],
            'quantidade_pecas'    => $dados['quantidade_pecas'],
            'desconto_largura_mm' => $dados['desconto_largura_mm'] ?? 0,
            'desconto_altura_mm'  => $dados['desconto_altura_mm'] ?? 0,
            'observacao_corte'    => $dados['observacao_corte'] ?? null,
        ]);

        return redirect()->to('/tipologias/' . $tipologia->id)
            ->with('sucesso', 'Material adicionado à receita da esquadria!');
    }

    public function removerMaterial($id, $pivotId)
    {
        DB::table('material_tipologia')
            ->where('id', $pivotId)
            ->where('tipologia_id', $id)
            ->delete();

        return redirect()->to('/tipologias/' . $id)
            ->with('sucesso', 'Item removido da receita da esquadria!');
    }
}