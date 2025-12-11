<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomFieldValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'custom_field_definition_id',
        'model_id',
        'model_type',
        'value'
    ];

    public function definition()
    {
        return $this->belongsTo(CustomFieldDefinition::class, 'custom_field_definition_id');
    }

    public function model()
    {
        return $this->morphTo(); // Points to Invoice or InvoiceItem
    }
}

