<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComandaProducte extends Model
{
    protected $table = 'comanda_producte';

    protected $fillable = [
        'comanda_id',
        'producte_id',
        'quantitat',
        'preu_unitari',
    ];

    public function comanda()
    {
        return $this->belongsTo(Comanda::class, 'comanda_id');
    }

    public function producte()
    {
        return $this->belongsTo(Producte::class, 'producte_id');
    }
}
