<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public function auctions() : HasMany 
    {
        return $this->hasMany(Auction::class);
    }

    static public function getAvailableCategories()
    {
        return Category::has('auctions')->get();
    }

    public function toJsonDictionnary() : array 
    {
        return ["id" => $this->id, "description" => $this->description];
    }
}
