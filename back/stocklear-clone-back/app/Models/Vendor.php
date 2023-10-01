<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Vendor extends Model
{
    use HasFactory;

    public function auctions() : HasMany 
    {
        return $this->hasMany(Auction::class);
    }

    public function toJsonDictionnary() : array
    {
        return [
            "picture_url" => Storage::url('vendors-pics/'.$this->picture),
        ];
    }
}
