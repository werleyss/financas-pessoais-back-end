<?php

namespace App\Http\Controllers;

use App\Http\Resources\FinanceiroResource;
use App\Models\Financeiro;
use Illuminate\Http\Request;

class FinanceiroController extends Controller
{
    private $item;
    private $totalPage = 10;

    public function __construct(Financeiro $item)
    {
        $this->item = $item;
    }

    public function index(Request $request)
    {
        $dataForm = $request->all();
        $query = $this->item::query();

        if(key_exists('per_page', $dataForm)) {
            $dataForm['per_page'] > 0 ? $this->totalPage = $dataForm['per_page'] : $this->totalPage;
        }

        if(key_exists('id', $dataForm)) {
            $query->where('id', $dataForm['id']);
        }

        if(key_exists('descricao', $dataForm)) {
            $query->where('descricao', 'like', '%' . $dataForm['descricao'] . '%');
        }

        if(key_exists('tipo', $dataForm)) {
            $query->where('tipo', $dataForm['tipo']);
        }

        if(key_exists('dt_vencimento_inicial', $dataForm) && key_exists('dt_vencimento_final', $dataForm)) {
            $query->whereBetween('dt_vencimento', [$dataForm['dt_vencimento_inicial'], $dataForm['dt_vencimento_final']]);
        }

        if(key_exists('dt_pagamento_inicial', $dataForm) && key_exists('dt_pagamento_final', $dataForm)) {
            $query->whereBetween('dt_pagamento', [$dataForm['dt_pagamento_inicial'], $dataForm['dt_pagamento_final']]);
        }

        if(key_exists('conta_id', $dataForm)) {
            $query->where('conta_id', $dataForm['conta_id']);
        }

        if(key_exists('categoria_id', $dataForm)) {
            $query->where('categoria_id', $dataForm['categoria_id']);
        }

        if(key_exists('status', $dataForm)) {
            $query->where('status', $dataForm['status']);
        }

        return FinanceiroResource::collection($query->paginate($this->totalPage));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['user_id'] = auth()->user()->id;
        $insert = $this->item->create($dataForm);

        return new FinanceiroResource($insert);
    }

    public function show($id)
    {
        return new FinanceiroResource($this->item::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $update = $this->item->findOrFail($id);
        $update->update($dataForm);

        return new FinanceiroResource($update);
    }

    public function destroy($id)
    {
        $delete = $this->item->findOrFail($id);
        $delete->delete();

        return response()->json(null,204);
    }
}
