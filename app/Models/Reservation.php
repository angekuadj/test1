<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'salle_id',
        'classe_id',
        'Ddebut',
        'Dfin',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
