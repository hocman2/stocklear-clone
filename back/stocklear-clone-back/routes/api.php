<?php

use App\Http\Controllers\AuctionDefinitionController;
use App\Http\Controllers\AuctionController;
use Illuminate\Support\Facades\Route;

Route::get('/retrieve_auctions_definitions', AuctionDefinitionController::class);
Route::get('/retrieve_auctions', [AuctionController::class, 'getAll']);