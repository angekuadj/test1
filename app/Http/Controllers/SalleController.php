<?php

namespace App\Http\Controllers;

use App\Models\Salle;
use Illuminate\Http\Request;
use App\Http\Requests\SalleStoreRequest;
use App\Http\Requests\SalleUpdateRequest;

class SalleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Salle::class);

        $search = $request->get('search', '');

        $salles = Salle::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.salles.index', compact('salles', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Salle::class);

        return view('app.salles.create');
    }

    /**
     * @param \App\Http\Requests\SalleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SalleStoreRequest $request)
    {
        $this->authorize('create', Salle::class);

        $validated = $request->validated();

        $salle = Salle::create($validated);

        return redirect()
            ->route('salles.edit', $salle)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Salle $salle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Salle $salle)
    {
        $this->authorize('view', $salle);

        return view('app.salles.show', compact('salle'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Salle $salle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Salle $salle)
    {
        $this->authorize('update', $salle);

        return view('app.salles.edit', compact('salle'));
    }

    /**
     * @param \App\Http\Requests\SalleUpdateRequest $request
     * @param \App\Models\Salle $salle
     * @return \Illuminate\Http\Response
     */
    public function update(SalleUpdateRequest $request, Salle $salle)
    {
        $this->authorize('update', $salle);

        $validated = $request->validated();

        $salle->update($validated);

        return redirect()
            ->route('salles.edit', $salle)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Salle $salle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Salle $salle)
    {
        $this->authorize('delete', $salle);

        $salle->delete();

        return redirect()
            ->route('salles.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
