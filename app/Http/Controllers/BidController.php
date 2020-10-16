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

        return response($request, Response::HTTP_CREATED);
    }
}
