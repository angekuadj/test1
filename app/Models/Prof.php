<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prof extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nom'];

    protected $searchableFields = ['*'];

    public function emplois()
    {
        return $this->hasMany(Emploi::class);
    }
}
