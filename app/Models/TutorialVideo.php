<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TutorialVideo extends Model
{
    public const CATEGORIES = [
        'software' => 'jewelerp Software',
        'manufacturing' => 'jewelerp Manufacturing Software',
        'pos' => 'jewelerp POS',
        'rfid' => 'RFID & Hardware',
    ];

    protected $fillable = [
        'category',
        'video_id',
        'title',
        't2_label',
    ];
}
