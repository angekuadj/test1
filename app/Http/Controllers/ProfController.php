<?php

namespace App\Http\Controllers;

use App\Models\Prof;
use Illuminate\Http\Request;
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
            ->paginate(5)
            ->withQueryString();

        return view('app.profs.index', compact('profs', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Prof::class);

        return view('app.profs.create');
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

        return redirect()
            ->route('profs.edit', $prof)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prof $prof
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Prof $prof)
    {
        $this->authorize('view', $prof);

        return view('app.profs.show', compact('prof'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Prof $prof
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Prof $prof)
    {
        $this->authorize('update', $prof);

        return view('app.profs.edit', compact('prof'));
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

        return redirect()
            ->route('profs.edit', $prof)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('profs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
