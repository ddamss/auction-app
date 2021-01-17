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
use Symfony\Component\HttpFoundation\Response;


class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Bidding::find(1)) {
            $bidders_count = Bidding::find(1);
            // dd(gettype($bidders_count));
        } else {
            $bidders_count = 0;
        }

        $all_auctions = Auction::all();

        $now = time();
        date_default_timezone_set('Asia/Dubai');
        $formattedNow = date("Y-m-d H:i:s", $now);

        foreach ($all_auctions as $auction) {

            if ($auction->status != 'finished') {
                if ($formattedNow >= $auction->end_date) {

                    Log::debug('Auction [' . $auction->id . '] is FINISHED [Index view] ! Current server date : [' . $formattedNow . '] is above auction end_date : [' . $auction->end_date . '] so it\'s finished');
                    $auction->status = 'finished';
                    $auction->save();
                } else if ($formattedNow < $auction->start_date) {

                    Log::debug('Auction [' . $auction->id . '] is COMING SOON [Index view] ! ');
                } else {
                    $auction->status = 'live';
                    $auction->save();
                    Log::debug('Auction [' . $auction->id . '] is LIVE [Index view] ! ');
                }
            }
        }

        if (Auth::guard('seller')->user()) {
            $auctions = Auction::orderBy('end_date', 'DESC')->where('seller_id', Auth::guard('seller')->user()->id)->paginate(5)->onEachSide(0);
            return view('auctions.all_auctions', compact('auctions', 'bidders_count'));
        } else {
            $auctions = Auction::orderBy('end_date', 'DESC')->paginate(5)->onEachSide(0);
            return view('auctions.all_auctions', compact('auctions', 'bidders_count', 'all_auctions', 'formattedNow'));
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

        $bidders_count = 0;
        $now = time();
        date_default_timezone_set('Asia/Dubai');
        $formattedNow = date("Y-m-d H:i:s", $now);

        if ($request->start_date < $formattedNow) {
            return 'Start date :' . $request->start_date . ' should be after current date :' . $formattedNow . '. FYI end_date : ' . $request->end_date;
        } else if ($request->start_date >= $request->end_date) {
            return 'Start date should be before end_date. Start : ' . $request->start_date . ' end date : ' . $request->end_date;
        } else if ($request->end_date <= $formattedNow) {
            return 'End date should be after current_date. End date : ' . $request->end_date . ', current date : ' . $formattedNow;
        } else {

            // if ($request->hasFile('image')) {

            //     Storage::disk('s3')->putFileAs(
            //         'auction-images/',
            //         new File($request->image->path()),
            //         $request->image->getClientOriginalName()
            //     );
            //     $url = Storage::disk('s3')->url('auction-images/' . $request->image->getClientOriginalName());

            $status = '';
            $formattedNow <= $request->input('start_date') ? $status = 'coming' : $status = 'live';

            $auction = Auction::create([
                'seller_id' => $request->input('seller_id'),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'image_url' => 'https://auctions-app.s3.eu-west-3.amazonaws.com/auction-images/t%C3%A9l%C3%A9chargement.png',
                'start_price' => $request->input('start_price'),
                'current_price' => $request->input('start_price'),
                'start_date' => $request->input('start_date'),
                'end_date' => $request->input('end_date'),
                'status' => $status
            ]);
            // if (!is_null($auction)) {
            //     dd($auction);
            // }
            return view('auctions.show_auction', compact('auction', 'bidders_count', 'formattedNow'));
            // }
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
        if (Bidding::find(1)) {
            $bidders_count = Bidding::find(1)->bidders($auction->id);
        } else {
            $bidders_count = 0;
        }

        $all_auctions = Auction::all();
        $now = time();
        date_default_timezone_set('Asia/Dubai');
        $formattedNow = date("Y-m-d H:i:s", $now);

        foreach ($all_auctions as $act) {

            if ($act->status != 'finished') {
                if ($formattedNow >= $act->end_date) {

                    Log::debug('Auction [' . $act->id . '] is FINISHED [Show view] ! Current server date : [' . $formattedNow . '] is above auction end_date : [' . $act->end_date . '] so it\'s finished');
                    $act->status = 'finished';
                    $act->save();
                } else if ($formattedNow < $act->start_date) {

                    Log::debug('Auction [' . $act->id . '] is COMING SOON [Show view] ! ');
                } else {

                    $act->status = 'live';
                    $act->save();
                    Log::debug('Auction [' . $act->id . '] is LIVE [Show view] ! ');
                }
            }
        }

        if (Auth::guard('seller')->user()) {

            $id = Auth::guard('seller')->user()->id;
            $auction = Auction::where('seller_id', $id)
                ->where('id', $auction->id)
                ->firstOrFail();
            return view('auctions.show_auction', compact('auction', 'bidders_count', 'formattedNow'));
        } else if (Auth::guard('buyer')->user()) {

            $buyer = Buyer::where('id', Auth::guard('buyer')->user()->id)->firstOrFail();

            return view('auctions.show_auction', compact('auction', 'buyer', 'bidders_count', 'formattedNow'));
        } else {
            return view('auctions.show_auction', compact('auction', 'bidders_count', 'formattedNow'));
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
        if (Bidding::find(1)) {

            $bidders_count = Bidding::find(1)->bidders($auction->id);
        } else {
            $bidders_count = 0;
        }

        $buyer_id = Auth::guard('buyer')->user()->id;

        $auctions = Auction::where('buyer_id', Auth::guard('buyer')->user()->id)
            ->join('biddings', 'auctions.id', '=', 'biddings.auction_id')
            ->select('auctions.id', 'auctions.image_url', 'auctions.title', 'auctions.description', 'auctions.current_price', 'auctions.start_date', 'auctions.end_date', 'auctions.status')
            ->distinct('auctions.id')
            ->paginate(5)->onEachSide(0);

        return view('auctions.my_auctions', compact('auctions', 'bidders_count', 'buyer_id'));
    }

    public function updateStatus(Request $request)
    {

        $auction = Auction::find($request->auction_id);
        $auction->status = $request->status;
        $auction->save();
        return response($request, Response::HTTP_CREATED);
    }
}
