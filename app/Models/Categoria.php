<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table="categoria";
 
    public function producte()
    {
           return $this->hasMany(Producte::class,'categoria_id');
    }

}
