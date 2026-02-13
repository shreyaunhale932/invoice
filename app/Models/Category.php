<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class Category extends Model
{
    use BelongsToFirm;
    //
    protected $primaryKey = 'category_id';
    protected $table = "categories";
    protected $fillable = ['admin_id','category_name'];
        public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'category_id');
    }
     public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
