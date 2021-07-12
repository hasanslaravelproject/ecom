<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class MenuTypeOrdersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MenuType $menuType
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, MenuType $menuType)
    {
        $this->authorize('view', $menuType);

        $search = $request->get('search', '');

        $orders = $menuType
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\MenuType $menuType
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MenuType $menuType)
    {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'product_id' => ['required', 'exists:products,id'],
            'order_category_id' => ['required', 'exists:order_categories,id'],
        ]);

        $order = $menuType->orders()->create($validated);

        return new OrderResource($order);
    }
}
