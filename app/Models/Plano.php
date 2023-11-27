<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plano extends Model
{

    protected $table = 'planos';
    protected $fillable = [
        'name',
        'preco',
        'descricao',
        'vigencia'
    ];

}
