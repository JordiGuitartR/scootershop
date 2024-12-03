<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    protected $table="producte";

    public function comandes()
    {
           return $this->belongsToMany(Comanda::class,'comanda_producte');
    }

    public function categories()
    {
           return $this->belongsTo(Categoria::class);
    }
}
