<?php

namespace App\Http\Controllers\Api;

use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class UnitProductsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Unit $unit)
    {
        $this->authorize('view', $unit);

        $search = $request->get('search', '');

        $products = $unit
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Unit $unit)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'quantity' => ['required', 'numeric'],
            'unitprice' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:1024'],
            'status' => ['required', 'in:inactive,active'],
            'product_category_id' => [
                'required',
                'exists:product_categories,id',
            ],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $product = $unit->products()->create($validated);

        return new ProductResource($product);
    }
}
