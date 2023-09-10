<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
