<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Auction extends Model
{
    use HasFactory;

    public function quality() : BelongsTo 
    {
        return $this->belongsTo(Quality::class);
    }

    public function category() : BelongsTo 
    {
        return $this->belongsTo(Category::class);
    }

    public function location() : HasOne 
    {
        return $this->hasOne(Location::class);
    }

    public function vendor() : BelongsTo 
    {
        return $this->belongsTo(Vendor::class);
    }

    public function bids() : HasMany 
    {
        return $this->hasMany(Bid::class);
    }

    public function getLastBidValue() : float
    {
        return $this->bids()
                    ->orderByDesc('price')
                    ->limit(1)
                    ->first()->price;
    }

    public function getNumBids() : int
    {
        return count($this->bids);
    }

    static public function getMinMaxPublicPrices() : array
    {
        return [DB::table('auctions')->min('public_price'), DB::table('auctions')->max('public_price')];
    }

    public function toJsonDictionnary() : array
    {
        return [
            "title" => $this->title,
            "id" => $this->id,
            "units" => $this->units,
            "public_price" => $this->public_price,
            "sku" => $this->sku,
            "auction_end" => $this->auction_end,
            "last_bid" => $this->getLastBidValue(),
            "num_bids" => $this->getNumBids(),
            "category_id" => $this->category->id,
            "quality_id" => $this->quality->id,
            "location" => $this->location->toJsonDictionnary(),
            "vendor" => $this->vendor->toJsonDictionnary(),
        ];
    }
}
