<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\OrderCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderCategoryResource;
use App\Http\Resources\OrderCategoryCollection;
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
            ->paginate();

        return new OrderCategoryCollection($orderCategories);
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

        return new OrderCategoryResource($orderCategory);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderCategory $orderCategory
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, OrderCategory $orderCategory)
    {
        $this->authorize('view', $orderCategory);

        return new OrderCategoryResource($orderCategory);
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

        return new OrderCategoryResource($orderCategory);
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

        return response()->noContent();
    }
}
