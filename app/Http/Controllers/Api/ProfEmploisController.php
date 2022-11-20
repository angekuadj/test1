<?php

namespace App\Http\Controllers\Api;

use App\Models\Prof;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmploiResource;
use App\Http\Resources\EmploiCollection;

class ProfEmploisController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prof $prof
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Prof $prof)
    {
        $this->authorize('view', $prof);

        $search = $request->get('search', '');

        $emplois = $prof
            ->emplois()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmploiCollection($emplois);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prof $prof
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Prof $prof)
    {
        $this->authorize('create', Emploi::class);

        $validated = $request->validate([
            'classe_id' => ['required', 'exists:classes,id'],
            'salle_id' => ['required', 'exists:salles,id'],
            'user_id' => ['required', 'exists:users,id'],
            'Ddebut' => ['required', 'max:255', 'string'],
            'Dfin' => ['required', 'max:255', 'string'],
        ]);

        $emploi = $prof->emplois()->create($validated);

        return new EmploiResource($emploi);
    }
}
