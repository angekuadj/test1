<?php

namespace App\Http\Controllers\Api;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClasseResource;
use App\Http\Resources\ClasseCollection;
use App\Http\Requests\ClasseStoreRequest;
use App\Http\Requests\ClasseUpdateRequest;

class ClasseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Classe::class);

        $search = $request->get('search', '');

        $classes = Classe::search($search)
            ->latest()
            ->paginate();

        return new ClasseCollection($classes);
    }

    /**
     * @param \App\Http\Requests\ClasseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClasseStoreRequest $request)
    {
        $this->authorize('create', Classe::class);

        $validated = $request->validated();

        $classe = Classe::create($validated);

        return new ClasseResource($classe);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Classe $classe
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Classe $classe)
    {
        $this->authorize('view', $classe);

        return new ClasseResource($classe);
    }

    /**
     * @param \App\Http\Requests\ClasseUpdateRequest $request
     * @param \App\Models\Classe $classe
     * @return \Illuminate\Http\Response
     */
    public function update(ClasseUpdateRequest $request, Classe $classe)
    {
        $this->authorize('update', $classe);

        $validated = $request->validated();

        $classe->update($validated);

        return new ClasseResource($classe);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Classe $classe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Classe $classe)
    {
        $this->authorize('delete', $classe);

        $classe->delete();

        return response()->noContent();
    }
}
