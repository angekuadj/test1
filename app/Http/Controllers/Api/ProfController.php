<?php

namespace App\Http\Controllers\Api;

use App\Models\Prof;
use Illuminate\Http\Request;
use App\Http\Resources\ProfResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProfCollection;
use App\Http\Requests\ProfStoreRequest;
use App\Http\Requests\ProfUpdateRequest;

class ProfController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Prof::class);

        $search = $request->get('search', '');

        $profs = Prof::search($search)
            ->latest()
            ->paginate();

        return new ProfCollection($profs);
    }

    /**
     * @param \App\Http\Requests\ProfStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfStoreRequest $request)
    {
        $this->authorize('create', Prof::class);

        $validated = $request->validated();

        $prof = Prof::create($validated);

        return new ProfResource($prof);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prof $prof
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Prof $prof)
    {
        $this->authorize('view', $prof);

        return new ProfResource($prof);
    }

    /**
     * @param \App\Http\Requests\ProfUpdateRequest $request
     * @param \App\Models\Prof $prof
     * @return \Illuminate\Http\Response
     */
    public function update(ProfUpdateRequest $request, Prof $prof)
    {
        $this->authorize('update', $prof);

        $validated = $request->validated();

        $prof->update($validated);

        return new ProfResource($prof);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prof $prof
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Prof $prof)
    {
        $this->authorize('delete', $prof);

        $prof->delete();

        return response()->noContent();
    }
}
