<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Auction;

class AuctionController extends Controller
{
    public function getAll() : JsonResponse
    {
        $data = [];

        foreach(Auction::all() as $auction)
        {
            $data []= $auction->toJsonDictionnary();
        }

        return new JsonResponse($data);
    }
}
