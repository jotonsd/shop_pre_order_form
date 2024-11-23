<?php

namespace Joton\PreOrder\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait SoftDeletesWithUser
{
    public static function bootSoftDeletesWithUser()
    {
        static::deleting(function (Model $model) {
            if ($model->isSoftDeleting()) {
                $model->deleted_by_id = Auth::id();
                $model->saveQuietly();
            }
        });
    }

    /**
     * Determine if the model is performing a soft delete.
     *
     * @return bool
     */
    protected function isSoftDeleting(): bool
    {
        return in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses_recursive($this));
    }
}
