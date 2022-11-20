<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.classes.index', compact('classes', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Classe::class);

        return view('app.classes.create');
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

        return redirect()
            ->route('classes.edit', $classe)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Classe $classe
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Classe $classe)
    {
        $this->authorize('view', $classe);

        return view('app.classes.show', compact('classe'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Classe $classe
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Classe $classe)
    {
        $this->authorize('update', $classe);

        return view('app.classes.edit', compact('classe'));
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

        return redirect()
            ->route('classes.edit', $classe)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('classes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
