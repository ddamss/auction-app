<?php

namespace App\Http\Controllers;

use App\Seller;
use App\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auctions = Auction::all();
        return view('auctions.all_auctions', compact('auctions'));
        // dd($auctions);
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
        // dd($request->all());
        $auction = Auction::create([
            'seller_id' => $request->input('seller_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'start_price' => $request->input('start_price'),
            'current_price' => $request->input('start_price'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date')
        ]);
        return view('auctions.show_auction', compact('auction'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auction  $auction
     * @return \Illuminate\Http\Response
     */
    public function show(Auction $auction)
    {
        // dd('show');
        // dd($auction);
        return view('auctions.show_auction', compact('auction'));
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
        // dd($request->all());

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
}
