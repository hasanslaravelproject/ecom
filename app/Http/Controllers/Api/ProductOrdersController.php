<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderCollection;

class ProductOrdersController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Product $product)
    {
        $this->authorize('view', $product);

        $search = $request->get('search', '');

        $orders = $product
            ->orders()
            ->search($search)
            ->latest()
            ->paginate();

        return new OrderCollection($orders);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->authorize('create', Order::class);

        $validated = $request->validate([
            'quantity' => ['required', 'numeric'],
            'date' => ['required', 'date'],
            'order_category_id' => ['required', 'exists:order_categories,id'],
            'menu_type_id' => ['required', 'exists:menu_types,id'],
        ]);

        $order = $product->orders()->create($validated);

        return new OrderResource($order);
    }
}
