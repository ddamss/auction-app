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
        if (Auth::guard('seller')->user()) {
            $auctions = Auction::where('seller_id', Auth::guard('seller')->user()->id)->paginate(5);
            Log::debug(Auction::where('seller_id', Auth::guard('seller')->user()->id)->toSql());
            return view('auctions.all_auctions', compact('auctions'));
    
        } else {
            $auctions = Auction::paginate(5);
            Log::debug(Auction::paginate(5));
            return view('auctions.all_auctions', compact('auctions'));
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
            return view('auctions.show_auction', compact('auction'));
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
        if (Auth::guard('seller')->user()) {

            $id = Auth::guard('seller')->user()->id;
            $auction = Auction::where('seller_id', $id)
                ->where('id', $auction->id)
                ->firstOrFail();
            return view('auctions.show_auction', compact('auction'));
        } else if (Auth::guard('buyer')->user()){
            $buyer = Buyer::where('id', Auth::guard('buyer')->user()->id)->firstOrFail();
            return view('auctions.show_auction', compact('auction', 'buyer'));
        }else{
            return view('auctions.show_auction', compact('auction'));
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