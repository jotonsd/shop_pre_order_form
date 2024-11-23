<?php

namespace Joton\PreOrder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Joton\PreOrder\Traits\SoftDeletesWithUser;

class PreOrderDetail extends Model
{
    use HasFactory, SoftDeletes, SoftDeletesWithUser;

    protected $fillable = ['pre_order_id', 'product_id', 'quantity', 'unit_price', 'total_price'];

    protected $dates = ['deleted_at'];

    public function preOrder()
    {
        return $this->belongsTo(PreOrder::class);
    }
}
