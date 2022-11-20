<?php

namespace App\Http\Controllers\Api;

use App\Models\Salle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmploiResource;
use App\Http\Resources\EmploiCollection;

class SalleEmploisController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Salle $salle
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Salle $salle)
    {
        $this->authorize('view', $salle);

        $search = $request->get('search', '');

        $emplois = $salle
            ->emplois()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmploiCollection($emplois);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Salle $salle
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Salle $salle)
    {
        $this->authorize('create', Emploi::class);

        $validated = $request->validate([
            'classe_id' => ['required', 'exists:classes,id'],
            'user_id' => ['required', 'exists:users,id'],
            'Ddebut' => ['required', 'max:255', 'string'],
            'Dfin' => ['required', 'max:255', 'string'],
            'prof_id' => ['required', 'exists:profs,id'],
        ]);

        $emploi = $salle->emplois()->create($validated);

        return new EmploiResource($emploi);
    }
}
