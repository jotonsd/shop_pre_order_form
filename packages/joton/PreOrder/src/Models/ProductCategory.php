<?php

namespace Joton\PreOrder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description'];

    protected $dates = ['deleted_at'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}