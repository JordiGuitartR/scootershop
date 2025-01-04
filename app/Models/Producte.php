<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producte extends Model
{
    protected $table="producte";
    protected $fillable = ['nom', 'descripcio', 'preu', 'categoria_id'];


    public function comandaProducte()
    {
        return $this->hasMany(ComandaProducte::class, 'producte_id');
    }

    public function comanda()
    {
           return $this->belongsToMany(Comanda::class,'comanda_producte');
    }

    public function categoria()
    {
           return $this->belongsTo(Categoria::class,'categoria_id');
    }

    public function resenya()
    {
           return $this->hasMany(Resenya::class);
    }
}
