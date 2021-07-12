<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;

class ProductCategoryProductsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, ProductCategory $productCategory)
    {
        $this->authorize('view', $productCategory);

        $search = $request->get('search', '');

        $products = $productCategory
            ->products()
            ->search($search)
            ->latest()
            ->paginate();

        return new ProductCollection($products);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\ProductCategory $productCategory
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, ProductCategory $productCategory)
    {
        $this->authorize('create', Product::class);

        $validated = $request->validate([
            'name' => ['required', 'max:255', 'string'],
            'quantity' => ['required', 'numeric'],
            'unitprice' => ['required', 'numeric'],
            'image' => ['nullable', 'image', 'max:1024'],
            'status' => ['required', 'in:inactive,active'],
            'unit_id' => ['required', 'exists:units,id'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $product = $productCategory->products()->create($validated);

        return new ProductResource($product);
    }
}
