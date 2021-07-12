<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'quantity',
        'unitprice',
        'image',
        'status',
        'unit_id',
        'product_category_id',
    ];

    protected $searchableFields = ['*'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
