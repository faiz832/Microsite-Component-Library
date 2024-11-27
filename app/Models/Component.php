<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'version_id',
        'category_id',
        'component',
    ];

    // Relations
    public function version()
    {
        return $this->belongsTo(Version::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
