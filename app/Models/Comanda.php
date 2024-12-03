<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $table="comandes";
 
    public function usuaris()
    {
           return $this->belongsTo(User::class);
    }

    public function productes()
    {
           return $this->hasMany(Producte::class);
    }
}
