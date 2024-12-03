<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resenya extends Model
{
    protected $table="producte";

    public function comandes()
    {
           return $this->belongsToMany(Comanda::class);
    }
}
