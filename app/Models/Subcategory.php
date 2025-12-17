<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
      protected $primaryKey = 'subcategory_id';
    protected $table = "subcategories";
    protected $fillable = ['admin_id','category_id','subcategory_name'];
     public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
