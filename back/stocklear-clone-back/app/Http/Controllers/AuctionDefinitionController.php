<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Models\Category;
use App\Models\Quality;
use App\Models\Location;
use App\Models\Auction;

class AuctionDefinitionController extends Controller
{
    public function __invoke() 
    {
        $data["categories"] = $this->createQualiCategoryData(Category::all());
        $data["available_categories"] = $this->createQualiCategoryData(Category::has('auctions')->get());
        $data["qualities"] = $this->createQualiCategoryData(Quality::all());
        $data["available_qualities"] = $this->createQualiCategoryData(Quality::has('auctions')->get());

        $data["locations"] = $this->createLocationsData(Location::all());
        $minMaxPrices = Auction::getMinMaxPublicPrices();
        $data["min_price"] = $minMaxPrices[0];
        $data["max_price"] = $minMaxPrices[1];

        return new JsonResponse($data);
    }

    private function createQualiCategoryData($collection)
    {
        $data = [];
        foreach($collection as $item)
        {
            $dict = $item->toJsonDictionnary();
            $data[$dict["id"]] = $dict["description"];
        }

        return $data;
    }

    private function createLocationsData($locations)
    {
        $data = ["countries" => [], "regions" => []];
        foreach($locations as $location)
        {
            if (!in_array($location->country, $data["countries"]))
            {
                $data["countries"] []= $location->country;
            }

            if (!in_array($location->region, $data["regions"]))
            {
                $data["regions"] []= $location->region;
            }
        }

        return $data;
    }
}
