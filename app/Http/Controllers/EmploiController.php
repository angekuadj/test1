<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Prof;
use App\Models\Salle;
use App\Models\Emploi;
use App\Models\Classe;
use Illuminate\Http\Request;
use App\Http\Requests\EmploiStoreRequest;
use App\Http\Requests\EmploiUpdateRequest;

class EmploiController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Emploi::class);

        $search = $request->get('search', '');

        $emplois = Emploi::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.emplois.index', compact('emplois', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Emploi::class);

        $classes = Classe::pluck('nom', 'id');
        $salles = Salle::pluck('nom', 'id');
        $users = User::pluck('name', 'id');
        $profs = Prof::pluck('nom', 'id');

        return view(
            'app.emplois.create',
            compact('classes', 'salles', 'users', 'profs')
        );
    }

    /**
     * @param \App\Http\Requests\EmploiStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmploiStoreRequest $request)
    {
        $this->authorize('create', Emploi::class);

        $validated = $request->validated();

        $emploi = Emploi::create($validated);

        return redirect()
            ->route('emplois.edit', $emploi)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Emploi $emploi)
    {
        $this->authorize('view', $emploi);

        return view('app.emplois.show', compact('emploi'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Emploi $emploi)
    {
        $this->authorize('update', $emploi);

        $classes = Classe::pluck('nom', 'id');
        $salles = Salle::pluck('nom', 'id');
        $users = User::pluck('name', 'id');
        $profs = Prof::pluck('nom', 'id');

        return view(
            'app.emplois.edit',
            compact('emploi', 'classes', 'salles', 'users', 'profs')
        );
    }

    /**
     * @param \App\Http\Requests\EmploiUpdateRequest $request
     * @param \App\Models\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function update(EmploiUpdateRequest $request, Emploi $emploi)
    {
        $this->authorize('update', $emploi);

        $validated = $request->validated();

        $emploi->update($validated);

        return redirect()
            ->route('emplois.edit', $emploi)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Emploi $emploi)
    {
        $this->authorize('delete', $emploi);

        $emploi->delete();

        return redirect()
            ->route('emplois.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
