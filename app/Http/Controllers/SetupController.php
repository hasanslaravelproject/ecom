<?php

namespace App\Http\Controllers;

use App\Models\Setup;
use Illuminate\Http\Request;
use App\Http\Requests\SetupStoreRequest;
use App\Http\Requests\SetupUpdateRequest;

class SetupController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Setup::class);

        $search = $request->get('search', '');

        $setups = Setup::search($search)
            ->latest()
            ->paginate(5);

        return view('app.setups.index', compact('setups', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Setup::class);

        return view('app.setups.create');
    }

    /**
     * @param \App\Http\Requests\SetupStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SetupStoreRequest $request)
    {
        $this->authorize('create', Setup::class);

        $validated = $request->validated();

        $setup = Setup::create($validated);

        return redirect()
            ->route('setups.edit', $setup)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Setup $setup
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Setup $setup)
    {
        $this->authorize('view', $setup);

        return view('app.setups.show', compact('setup'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Setup $setup
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Setup $setup)
    {
        $this->authorize('update', $setup);

        return view('app.setups.edit', compact('setup'));
    }

    /**
     * @param \App\Http\Requests\SetupUpdateRequest $request
     * @param \App\Models\Setup $setup
     * @return \Illuminate\Http\Response
     */
    public function update(SetupUpdateRequest $request, Setup $setup)
    {
        $this->authorize('update', $setup);

        $validated = $request->validated();

        $setup->update($validated);

        return redirect()
            ->route('setups.edit', $setup)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Setup $setup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Setup $setup)
    {
        $this->authorize('delete', $setup);

        $setup->delete();

        return redirect()
            ->route('setups.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
