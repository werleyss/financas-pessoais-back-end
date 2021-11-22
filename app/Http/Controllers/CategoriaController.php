<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriaResource;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    private $item;
    private $totalPage = 1000;

    public function __construct(Categoria $item) 
    {
        $this->item = $item;
    }

    public function index(Request $request)
    {
        $dataForm = $request->all();

        if(key_exists('per_page', $dataForm)) $dataForm['per_page'] > 0 ? $this->totalPage = $dataForm['per_page'] : $this->totalPage;

        return CategoriaResource::collection($this->item::paginate($this->totalPage));
    }

    public function store(Request $request)
    {
        $dataForm = $request->all();
        $dataForm['user_id'] = auth()->user()->id;
        $insert = $this->item->create($dataForm);

        return new CategoriaResource($insert);
    }

    public function show($id)
    {
        return new CategoriaResource($this->item::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $dataForm = $request->all();
        $update = $this->item->findOrFail($id);
        $update->update($dataForm);

        return new CategoriaResource($update);
    }

    public function destroy($id)
    {
        $delete = $this->item->findOrFail($id);
        $delete->delete();

        return response()->json(null,204);
    }
}
