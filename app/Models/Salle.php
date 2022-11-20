<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salle extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nom', 'qte'];

    protected $searchableFields = ['*'];

    public function salles()
    {
        return $this->hasMany(Reservation::class, 'salle_id');
    }

    public function emplois()
    {
        return $this->hasMany(Emploi::class);
    }
}
