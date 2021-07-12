<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'passcode', 'comapany_id'];

    protected $searchableFields = ['*'];

    public function comapany()
    {
        return $this->belongsTo(Company::class, 'comapany_id');
    }
}
