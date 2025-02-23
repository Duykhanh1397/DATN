<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantImage extends Model
{
    use HasFactory;

    protected $primaryKey = 'image_id';

    protected $fillable = [
        'value_id',
        'image_url',
    ];

    public function variantValue()
    {
        return $this->belongsTo(VariantValue::class, 'value_id');
    }
}
