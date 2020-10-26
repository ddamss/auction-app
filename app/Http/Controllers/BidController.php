<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Auction;
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
        $auction=Auction::where('id',$request->auction_id)->get();     

        //2nd layer on security to avoid having a bidded_price <= auciton_current_price
        if($request->bidded_price > $auction[0]->current_price){

            Log::debug('Bid registration=> ');
            Log::debug($request);

            $bid = Bidding::create([
                'auction_id' => $request->auction_id,
                'buyer_id' => $request->buyer_id,
                'bidded_price' => $request->bidded_price
            ]);

            if($bid){
                Log::debug('Bid registered => ');
                Log::debug($bid);
    
                //Update the current price of the auction using the bidded_price just registered here
                
                Log::debug('auction before update');        
                Log::debug($auction[0]);        
                $auction[0]->current_price = $bid->bidded_price;
                $auction[0]->save();
                Log::debug('auction after update');        
                Log::debug($auction[0]);  
            }
            return response($bid, Response::HTTP_CREATED);

        }else{
            Log::debug('bidded_price ["'.$request->bidded_price.'"] should be higher than auction_current_price ["'.$auction[0]->current_price.'"]');
            return response('KO',Response::HTTP_BAD_REQUEST);
        }
        
    }
}