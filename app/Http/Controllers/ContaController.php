<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContaResource;
use App\Models\Conta;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    private $item;
    private $totalPage = 1000;

    public function __construct(Conta $item)
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

        if(key_exists('status', $dataForm)) {
            $query->where('status', $dataForm['status']);
        }

        return ContaResource::collection($query->paginate($this->totalPage));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['user_id'] = auth()->user()->id;
        $insert = $this->item->create($dataForm);

        return new ContaResource($insert);
    }

    public function show($id)
    {
        return new ContaResource($this->item::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $update = $this->item->findOrFail($id);
        $update->update($dataForm);

        return new ContaResource($update);
    }

    public function destroy($id)
    {
        $delete = $this->item->findOrFail($id);
        $delete->delete();

        return response()->json(null,204);
    }
}
