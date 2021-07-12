<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\OrderCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class OrderCategoryOrdersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderCategory $orderCategory
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OrderCategory $orderCategory)
    {
        $this->authorize('view', $orderCategory);

        $search = $request->get('search', '');

        $orders = $orderCategory
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderCategory $orderCategory
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, OrderCategory $orderCategory)
    {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'product_id' => ['required', 'exists:products,id'],
            'menu_type_id' => ['required', 'exists:menu_types,id'],
        ]);

        $order = $orderCategory->orders()->create($validated);

        return new OrderResource($order);
    }
}
