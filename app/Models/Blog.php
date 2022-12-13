<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail'
    ];

    protected function thumbnail():Attribute
    {
        return Attribute::make(
            get: fn($value) => asset('/storage/img/blogs/'.$value)
        );
    }

    public function scopeSearch($query, $search)
    {
        $query->when($search, function($q) use($search){
            $q->where('title','like',"%{$search}%");
        });

        return $query;
    }
}
