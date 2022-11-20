<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmploiResource;
use App\Http\Resources\EmploiCollection;

class UserEmploisController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $emplois = $user
            ->emplois()
            ->search($search)
            ->latest()
            ->paginate();

        return new EmploiCollection($emplois);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Emploi::class);

        $validated = $request->validate([
            'classe_id' => ['required', 'exists:classes,id'],
            'salle_id' => ['required', 'exists:salles,id'],
            'Ddebut' => ['required', 'max:255', 'string'],
            'Dfin' => ['required', 'max:255', 'string'],
            'prof_id' => ['required', 'exists:profs,id'],
        ]);

        $emploi = $user->emplois()->create($validated);

        return new EmploiResource($emploi);
    }
}
