<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model implements HasMedia
{
    use InteractsWithMedia;
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_detail',
        'detail',
        'publish',
        'sort',
        'metatag',
        'metadescription',
    ];
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('news');
    }
}
