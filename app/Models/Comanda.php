<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $table="comanda";
 
    public function usuari()
    {
           return $this->belongsTo(User::class);
    }

    public function producte()
    {
           return $this->belongsToMany(Producte::class,'comanda_producte');
    }
}
