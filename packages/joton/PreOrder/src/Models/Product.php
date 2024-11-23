<?php

namespace Joton\PreOrder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'name', 'description', 'price'];

    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
