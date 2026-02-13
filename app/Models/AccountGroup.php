<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\BelongsToFirm;

class AccountGroup extends Model
{
    use BelongsToFirm;
    protected $fillable = ['name', 'type', 'parent_id', 'admin_id'];

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function parent()
    {
        return $this->belongsTo(AccountGroup::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(AccountGroup::class, 'parent_id');
    }
}
