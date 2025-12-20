<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
     use SoftDeletes;
      protected $primaryKey = 'subcategory_id';
    protected $table = "subcategories";
    protected $fillable = ['admin_id','category_id','subcategory_name'];
     public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
      public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }
    protected static function boot()
{
    parent::boot();

    static::deleting(function ($subcategory) {
        // Soft delete related products
        $subcategory->products()->delete();
    });
}

}
