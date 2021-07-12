<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['date'];

    protected $searchableFields = ['*'];

    protected $table = 'menu_types';

    protected $casts = [
        'date' => 'datetime',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
