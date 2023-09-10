<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TagTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['title'];
    public $timestamps = false;

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
