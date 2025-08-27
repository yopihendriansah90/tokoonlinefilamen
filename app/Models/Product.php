<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    //
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'stock',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

}
