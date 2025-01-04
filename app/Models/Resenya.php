<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resenya extends Model
{
    protected $table="resenya";

    public function usuari()
    {
           return $this->belongsTo(User::class);
    }

    public function producte()
    {
        return $this->belongsTo(Producte::class);
    }
}
