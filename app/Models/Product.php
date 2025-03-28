<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'is_active',
        'is_featured',
        'is_stack',
        'on_sale',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category(){
        return $this->belongsTo(Category::class)->where('is_active', 1);
    }
    public function brand(){
        return $this->belongsTo(Brand::class)->where('is_active', 1);;
    }
    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }
    public function ProductSpecification(){
        return $this->hasMany(ProductSpecifications::class);
    }
}
