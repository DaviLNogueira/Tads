<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assinatura extends Model
{
    use HasFactory;
    protected $table = 'assinaturas';

    protected $fillable = [
        'data_inicio',
        'data_termino',
        'status',
        'plano_id',
        'cliente_id'
    ];
}
