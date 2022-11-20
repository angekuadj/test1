<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Emploi extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'classe_id',
        'salle_id',
        'user_id',
        'Ddebut',
        'Dfin',
        'prof_id',
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

    public function prof()
    {
        return $this->belongsTo(Prof::class);
    }
}
