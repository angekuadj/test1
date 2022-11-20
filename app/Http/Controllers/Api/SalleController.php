<?php

namespace App\Http\Controllers\Api;

use App\Models\Salle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SalleResource;
use App\Http\Resources\SalleCollection;
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
            ->paginate();

        return new SalleCollection($salles);
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

        return new SalleResource($salle);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Salle $salle
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Salle $salle)
    {
        $this->authorize('view', $salle);

        return new SalleResource($salle);
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

        return new SalleResource($salle);
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

        return response()->noContent();
    }
}
