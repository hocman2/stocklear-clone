<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;

    public function auction() : HasOne 
    {
        return $this->hasOne(Auction::class);
    }

    public function toJsonDictionnary() : array
    {
        return ["country" => $this->country, "region" => $this->region];
    }
}
