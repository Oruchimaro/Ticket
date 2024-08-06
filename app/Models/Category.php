<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
    ];

    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }

    public function scopeActive(Builder $builder)
    {
        return $builder->where('is_active', true);
    }
}
