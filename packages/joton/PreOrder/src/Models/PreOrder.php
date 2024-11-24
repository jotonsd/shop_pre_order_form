<?php

namespace Joton\PreOrder\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Joton\PreOrder\Traits\SoftDeletesWithUser;

class PreOrder extends Model
{
    use HasFactory, SoftDeletes, SoftDeletesWithUser;

    protected $fillable = ['name', 'email', 'phone', 'price'];

    protected $dates = ['deleted_at'];

    public function details()
    {
        return $this->hasMany(PreOrderDetail::class)->with('product');
    }
}
