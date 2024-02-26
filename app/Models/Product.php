<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory,HasUuids;


     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
            'name',
            'price',
            'photo_dir',
            'brand',
            'description',
            'color',
            'quantity',
            'availability',
        'size',
        'user_id',
        'category',
        'subcategory'
    ];
}
