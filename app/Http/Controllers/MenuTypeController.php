<?php

namespace App\Http\Controllers;

use App\Models\MenuType;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view('app.menu_types.index', compact('menuTypes', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', MenuType::class);

        return view('app.menu_types.create');
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

        return redirect()
            ->route('menu-types.edit', $menuType)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MenuType $menuType
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, MenuType $menuType)
    {
        $this->authorize('view', $menuType);

        return view('app.menu_types.show', compact('menuType'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MenuType $menuType
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, MenuType $menuType)
    {
        $this->authorize('update', $menuType);

        return view('app.menu_types.edit', compact('menuType'));
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

        return redirect()
            ->route('menu-types.edit', $menuType)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('menu-types.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
