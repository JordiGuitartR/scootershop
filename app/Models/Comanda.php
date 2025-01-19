<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comanda extends Model
{
    protected $table="comanda";
    protected $fillable = [
       'user_id',         
       'data_comanda',
       'estat',
       'total',
   ];
 
    public function comandaProducte()
    {
        return $this->hasMany(ComandaProducte::class, 'comanda_id');
    }

    public function usuari()
    {
           return $this->belongsTo(User::class);
    }

    public function producte()
    {
           return $this->belongsToMany(Producte::class,'comanda_producte');
    }
}
