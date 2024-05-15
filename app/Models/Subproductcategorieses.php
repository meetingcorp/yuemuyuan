<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;

class Subproductcategorieses extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Sluggable;

    protected $table = 'sub_product_categories';
    protected $fillable = [
        'categories_id',
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
        $this->addMediaCollection('sub_product_categories');
    }

    public function product_categories(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }
}
