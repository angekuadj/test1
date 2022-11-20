<?php

namespace App\Http\Controllers\Api;

use App\Models\Emploi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmploiResource;
use App\Http\Resources\EmploiCollection;
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
            ->paginate();

        return new EmploiCollection($emplois);
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

        return new EmploiResource($emploi);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Emploi $emploi
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Emploi $emploi)
    {
        $this->authorize('view', $emploi);

        return new EmploiResource($emploi);
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

        return new EmploiResource($emploi);
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

        return response()->noContent();
    }
}
