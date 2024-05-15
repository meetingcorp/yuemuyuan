<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;

class ProductCategory extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'publish',
        'sort',
    ];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('productcategory');
    }

    public function products(){
        return $this->belongsToMany(Product::class,'product_has_categories', 'product_categories_id', 'product_id');
    }

    public function sub_product_categorise(){
        return $this->hasMany(Subproductcategorieses::class);
    }
}
