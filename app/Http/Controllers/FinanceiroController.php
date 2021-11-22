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
        return FinanceiroResource::collection($this->item::paginate($this->totalPage));
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
