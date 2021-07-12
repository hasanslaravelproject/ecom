<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'quantity',
        'date',
        'product_id',
        'order_category_id',
        'menu_type_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function orderCategory()
    {
        return $this->belongsTo(OrderCategory::class);
    }

    public function menuType()
    {
        return $this->belongsTo(MenuType::class);
    }
}
