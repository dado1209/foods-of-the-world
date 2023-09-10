<?php

namespace App\Models;

use App\Filters\V1\FoodFilter;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Food extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['status'];
    protected $table = 'foods';
    protected $hidden = ['translations', 'category_id', 'created_at', 'updated_at', 'deleted_at'];


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function getTranslations()
    {
        return $this->hasMany(FoodTranslation::class);
    }
    //this lets us use filter on foods
    public function scopeFilter($query, FoodFilter $filter)
    {
        return $filter->apply($query);
    }
    //boot method lets us listen on the events on a model
    protected static function boot()
    {
        parent::boot();
        //if a food gets soft deleted we update its status to deleted
        static::deleted(function ($food) {
            $food->update(['status' => 'deleted']);
        });
    }
}
