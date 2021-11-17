<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FinanceiroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'descricao'     => $this->descricao,
            'valor'         => $this->valor,
            'tipo'          => $this->tipo,
            'status'        => $this->status,
            'dt_vencimento' => $this->dt_vencimento, 
            'dt_pagamento'  => $this->dt_pagamento,
            'conta_id'      => $this->conta_id,
            'categoria_id'  => $this->categoria_id
        ];
    }
}
