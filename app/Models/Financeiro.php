<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financeiro extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'descricao','valor','tipo', 'status','dt_vencimento', 'dt_pagamento','conta_id', 'categoria_id', 'user_id'];
}
