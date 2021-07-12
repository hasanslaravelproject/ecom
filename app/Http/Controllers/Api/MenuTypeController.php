<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuTypeResource;
use App\Http\Resources\MenuTypeCollection;
use App\Http\Requests\MenuTypeStoreRequest;
use App\Http\Requests\MenuTypeUpdateRequest;

class MenuTypeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', MenuType::class);

        $search = $request->get('search', '');

        $menuTypes = MenuType::search($search)
            ->latest()
            ->paginate();

        return new MenuTypeCollection($menuTypes);
    }

    /**
     * @param \App\Http\Requests\MenuTypeStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuTypeStoreRequest $request)
    {
        $this->authorize('create', MenuType::class);

        $validated = $request->validated();

        $menuType = MenuType::create($validated);

        return new MenuTypeResource($menuType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MenuType $menuType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MenuType $menuType)
    {
        $this->authorize('view', $menuType);

        return new MenuTypeResource($menuType);
    }

    /**
     * @param \App\Http\Requests\MenuTypeUpdateRequest $request
     * @param \App\Models\MenuType $menuType
     * @return \Illuminate\Http\Response
     */
    public function update(MenuTypeUpdateRequest $request, MenuType $menuType)
    {
        $this->authorize('update', $menuType);

        $validated = $request->validated();

        $menuType->update($validated);

        return new MenuTypeResource($menuType);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MenuType $menuType
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, MenuType $menuType)
    {
        $this->authorize('delete', $menuType);

        $menuType->delete();

        return response()->noContent();
    }
}
