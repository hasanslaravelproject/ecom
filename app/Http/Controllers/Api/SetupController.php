<?php

namespace App\Http\Controllers\Api;

use App\Models\Setup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SetupResource;
use App\Http\Resources\SetupCollection;
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
            ->paginate();

        return new SetupCollection($setups);
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

        return new SetupResource($setup);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Setup $setup
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Setup $setup)
    {
        $this->authorize('view', $setup);

        return new SetupResource($setup);
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

        return new SetupResource($setup);
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

        return response()->noContent();
    }
}
