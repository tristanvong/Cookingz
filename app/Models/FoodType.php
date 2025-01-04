<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodType extends Model
{
    protected $fillable = ['name', 'description'];
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'food_recipe');
    }
    
}
