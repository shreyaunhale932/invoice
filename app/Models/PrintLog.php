<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrintLog extends Model
{
    //
    protected $fillable = [
        'template_id',
        'entity_type',
        'entity_id',
        'status',
        'error',
        'copies',
    ];

    public function template()
    {
        return $this->belongsTo(PrintTemplate::class, 'template_id');
    }
}
