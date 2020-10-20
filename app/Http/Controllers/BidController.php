<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Bidding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class BidController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug('Bid registered ! ');
        Log::debug($request);

        $bid = Bidding::create([
            'auction_id' => $request->auction_id,
            'buyer_id' => $request->buyer_id,
            'bidded_price' => $request->bidded_price
        ]);

        Log::debug($bid);

        return response($request, Response::HTTP_CREATED);
    }
}
