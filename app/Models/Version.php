<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Version extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
    ];

    // Relations
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
