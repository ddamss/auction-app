<?php

namespace App\Http\Controllers;

use App\Buyer;
use App\Bidding;
use App\Seller;
use App\Auction;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bidders_count=Bidding::find(1);

        $all_auctions=Auction::all();
        
        $now=time();
        date_default_timezone_set('Asia/Dubai');
        $formattedNow=date("Y-m-d H:i:s",$now);

        foreach($all_auctions as $auction){
            
            if($formattedNow>= $auction->end_date){
                Log::debug('Auction ['.$auction->id.'] is FINISHED ! Current server date : ['.$formattedNow.'] is above auction end_date : ['.$auction->end_date.'] so it\'s finished');
                $auction->status='finished';
                $auction->save();
            }else{
                Log::debug('Auction ['.$auction->id.'] is LIVE ! ');

            }
            
        }

        if (Auth::guard('seller')->user()) {
            $auctions = Auction::where('seller_id', Auth::guard('seller')->user()->id)->paginate(5);
            return view('auctions.all_auctions', compact('auctions','bidders_count'));
    
        } else {
            $auctions = Auction::paginate(5);
            return view('auctions.all_auctions', compact('auctions','bidders_count','all_auctions','formattedNow'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Seller $seller)
    {
        if (Auth::guard('seller')->user()) {
            $id = Auth::guard('seller')->user()->id;
            return view('auctions/create_auction', ['seller' => Seller::findOrFail($id)]);
        } else {
            return 'you\'re not connected';
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $now=time();
        date_default_timezone_set('Asia/Dubai');
        $formattedNow=date("Y-m-d H:i:s",$now);

        if ($request->hasFile('image')) {

            Storage::disk('s3')->putFileAs(
                'auction-images/',
                new File($request->image->path()),
                $request->image->getClientOriginalName()
            );
            $url = Storage::disk('s3')->url('auction-images/' . $request->image->getClientOriginalName());

            $auction = Auction::create([
                'seller_id' => $request->input('seller_id'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image_url' => $url,
                'start_price' => $request->input('start_price'),
                'current_price' => $request->input('start_price'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date')
            ]);

            $bidders_count=Bidding::find(1)->bidders($auction->id);

            return view('auctions.show_auction', compact('auction','bidders_count'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        
        $bidders_count=Bidding::find(1)->bidders($auction->id);

        $all_auctions=Auction::all();
        
        $now=time();
        date_default_timezone_set('Asia/Dubai');
        $formattedNow=date("Y-m-d H:i:s",$now);

        foreach($all_auctions as $act){
            
            if($formattedNow>= $act->end_date){
                Log::debug('Auction ['.$auction->id.'] is FINISHED ! Current server date : ['.$formattedNow.'] is above auction end_date : ['.$act->end_date.'] so it\'s finished');
                $act->status='finished';
                $act->save();
            }else{
                Log::debug('Auction ['.$act->id.'] is LIVE ! ');

            }
        }
        
        if (Auth::guard('seller')->user()) {

            $id = Auth::guard('seller')->user()->id;
            $auction = Auction::where('seller_id', $id)
                ->where('id', $auction->id)
                ->firstOrFail();
            return view('auctions.show_auction', compact('auction','bidders_count','formattedNow'));

        } else if (Auth::guard('buyer')->user()){
            
            $buyer = Buyer::where('id', Auth::guard('buyer')->user()->id)->firstOrFail();
            return view('auctions.show_auction', compact('auction', 'buyer','bidders_count','formattedNow'));
        
        }else{
            return view('auctions.show_auction', compact('auction','bidders_count','formattedNow'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buyer $buyer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auction $auction)
    {
        //
    }

    public function myAuctions(Auction $auction)
    {
            $auctions = Auction::where('buyer_id', Auth::guard('buyer')->user()->id)
                ->join('biddings','auctions.id','=','biddings.auction_id')
                ->select('auctions.id','auctions.image_url','auctions.title','auctions.description','auctions.current_price','auctions.start_date','auctions.end_date')
                ->distinct('auctions.id')
                ->paginate(5);

                return view('auctions.my_auctions', compact('auctions'));

    }
}