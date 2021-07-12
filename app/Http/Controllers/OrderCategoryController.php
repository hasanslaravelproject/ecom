<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderCategory;
use App\Http\Requests\OrderCategoryStoreRequest;
use App\Http\Requests\OrderCategoryUpdateRequest;

class OrderCategoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', OrderCategory::class);

        $search = $request->get('search', '');

        $orderCategories = OrderCategory::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.order_categories.index',
            compact('orderCategories', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', OrderCategory::class);

        return view('app.order_categories.create');
    }

    /**
     * @param \App\Http\Requests\OrderCategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderCategoryStoreRequest $request)
    {
        $this->authorize('create', OrderCategory::class);

        $validated = $request->validated();

        $orderCategory = OrderCategory::create($validated);

        return redirect()
            ->route('order-categories.edit', $orderCategory)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderCategory $orderCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OrderCategory $orderCategory)
    {
        $this->authorize('view', $orderCategory);

        return view('app.order_categories.show', compact('orderCategory'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderCategory $orderCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, OrderCategory $orderCategory)
    {
        $this->authorize('update', $orderCategory);

        return view('app.order_categories.edit', compact('orderCategory'));
    }

    /**
     * @param \App\Http\Requests\OrderCategoryUpdateRequest $request
     * @param \App\Models\OrderCategory $orderCategory
     * @return \Illuminate\Http\Response
     */
    public function update(
        OrderCategoryUpdateRequest $request,
        OrderCategory $orderCategory
    ) {
        $this->authorize('update', $orderCategory);

        $validated = $request->validated();

        $orderCategory->update($validated);

        return redirect()
            ->route('order-categories.edit', $orderCategory)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderCategory $orderCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OrderCategory $orderCategory)
    {
        $this->authorize('delete', $orderCategory);

        $orderCategory->delete();

        return redirect()
            ->route('order-categories.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
