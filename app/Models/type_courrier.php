<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type_courrier extends Model
{
    use HasFactory;
    public function recette()
    {
        return $this->hasMany(Document::class);
    }
}
