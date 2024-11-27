<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'version_id',
        'category',
    ];

    // Relationship
    public function version()
    {
        return $this->belongsTo(Version::class);
    }

    public function components()
    {
        return $this->hasMany(Component::class);
    }
}