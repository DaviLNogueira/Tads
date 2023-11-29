<?php

namespace App\Models;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Assinatura extends Model
{
    use HasFactory;

    protected $table = 'assinaturas';

    public function plano() : HasOne
    {
        return $this->hasOne(Plano::class,'plano_id');
    }

    protected $fillable = [
        'data_inicio',
        'data_termino',
        'status',
        'planos',
        'cliente_id',
        'email',
        'planos',
        'plano_id'
    ];

    /**
     * @throws \Exception
     */
    static public function newAssinatura(Plano $plano): self
    {

        //TODO : adicionar vigênica na data de termino
        return self::create(
            [
                'data_inicio' => new DateTime() ,
                'data_termino' => new DateTime(),
                'status' => 'ativo',
                'planos' => $plano->id,
                'email' => session('email'),
                'cliente_id' => 1,
                'plano_id' => $plano->id
            ]
        );
    }
}
