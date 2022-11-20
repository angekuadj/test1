<?php

namespace App\Http\Controllers\Api;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmploiResource;
use App\Http\Resources\EmploiCollection;

class ClasseEmploisController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Classe $classe
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Classe $classe)
    {
        $this->authorize('view', $classe);

        $search = $request->get('search', '');

        $emplois = $classe
            ->emplois()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmploiCollection($emplois);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Classe $classe
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Classe $classe)
    {
        $this->authorize('create', Emploi::class);

        $validated = $request->validate([
            'salle_id' => ['required', 'exists:salles,id'],
            'user_id' => ['required', 'exists:users,id'],
            'Ddebut' => ['required', 'max:255', 'string'],
            'Dfin' => ['required', 'max:255', 'string'],
            'prof_id' => ['required', 'exists:profs,id'],
        ]);

        $emploi = $classe->emplois()->create($validated);

        return new EmploiResource($emploi);
    }
}
