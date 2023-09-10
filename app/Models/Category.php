<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Category extends Model implements TranslatableContract
{
    use HasFactory, Translatable;
    public $translatedAttributes = ['title'];

    public function foods()
    {
        return $this->belongsToMany(Food::class);
    }

    public function getTranslations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }
}
