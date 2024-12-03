<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resenya extends Model
{
    protected $table="resenya";

    public function productes()
    {
        return $this->belongsTo(Producte::class);
    }
}
