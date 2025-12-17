<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurityModel extends Model
{
    //
    protected $table = "purity";

   protected $fillable = ['admin_id', 'purity_value', 'purity_type'];

   //explaination for us
   //    If karat → 22K Purity(Traditional)

    // If percent → 99.12 Purity[Fineness / Percentage Purity (Modern)]

}