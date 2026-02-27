<?php

namespace App\Traits;

use App\Models\Firm;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Session;

trait BelongsToFirm
{
    /**
     * Boot the trait.
     */
    protected static function bootBelongsToFirm()
    {
        static::addGlobalScope('firm', function (Builder $builder) {
            if (Session::has('selected_firm_id')) {
                $builder->where($builder->getModel()->getTable() . '.firm_id', Session::get('selected_firm_id'));
            }
        });

        static::creating(function ($model) {
            if (Session::has('selected_firm_id') && !$model->firm_id) {
                $model->firm_id = Session::get('selected_firm_id');
            }
        });
    }

    /**
     * Get the firm that owns the model.
     */
    public function firm()
    {
        return $this->belongsTo(Firm::class);
    }
}
