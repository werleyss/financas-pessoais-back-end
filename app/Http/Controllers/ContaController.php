<?php

namespace App\Http\Controllers;

use App\Http\Resources\ContaResource;
use App\Models\Conta;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    private $item;
    private $totalPage = 10;

    public function __construct(Conta $item) 
    {
        $this->item = $item;
    }

    public function index(Request $request)
    {
        return ContaResource::collection($this->item::paginate($this->totalPage));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
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
