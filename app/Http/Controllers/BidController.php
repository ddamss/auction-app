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
        $auction=Auction::where('id',$request->auction_id)->first();     

        $buyer=Buyer::where('id',$request->buyer_id)->first();
            
        //2nd layer on security to avoid having a bidded_price <= auciton_current_price
        if($request->bidded_price > $auction->current_price && $buyer->deposit_amount*5 >= $request->bidded_price){

            Log::debug('Bid registration=> ');
            Log::debug($request);
            
            $bid = Bidding::create([
                'auction_id' => $request->auction_id,
                'buyer_id' => $request->buyer_id,
                'bidded_price' => $request->bidded_price
            ]);

            return response($bid, Response::HTTP_CREATED);

        }else if ($request->bidded_price < $auction->current_price) {
        
            Log::debug('bidded_price ["'.$request->bidded_price.'"] should be higher than auction_current_price ["'.$auction->current_price.'"]');
            return response('KO',Response::HTTP_BAD_REQUEST);

        }else if ($buyer->deposit_amount*5 < $request->bidded_price){
        
            Log::debug('bidded_price ["'.$request->bidded_price.'"] should at least equals to five times the deposit_amount that is now ["'.$buyer->deposit_amount.'"], so mutiplied by 5 it is ["'.($buyer->deposit_amount*5).'"]');
            return response('KO',Response::HTTP_BAD_REQUEST);
        
        }else{
        
            Log::debug('For some reasons we couldn\'t register the bid' );
            return response('KO',Response::HTTP_BAD_REQUEST);            
        
        }
        
    }
}