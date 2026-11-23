<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CmsBanner extends Model
{
    protected $fillable = [
        'image1',
        'image2',
        'image3',
        'mob_img1',
        'mob_img2',
        'mob_img3',
        'dashboard_image',
        'ai_tools_title',
        'ai_tools_content',
        'benefit_h1',
        'benefit_t1',
        'benefit_h2',
        'benefit_t2',
        'benefit_h3',
        'benefit_t3',
        'benefit_h4',
        'benefit_t4',
        'benefit_stat1_value',
        'benefit_stat1_label',
        'benefit_stat2_value',
        'benefit_stat2_label',
        'benefit_stat3_value',
        'benefit_stat3_label',
    ];
}
