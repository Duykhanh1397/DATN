<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model
{
    use HasFactory;

    protected $primaryKey = 'value_id';

    protected $fillable = [
        'variant_id',
        'show',
        'price',
        'color_name',
        'storage_size',
    ];

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variant_id');
    }

    public function variantImages()
    {
        return $this->hasMany(VariantImage::class, 'value_id');
    }
}
