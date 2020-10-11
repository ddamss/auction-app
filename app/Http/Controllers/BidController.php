<?php

namespace App\Http\Controllers;

use App\Bidding;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::debug($request);
        Log::debug($request->jsonSerialize());

        // if (Response::HTTP_CREATED) {
        //     Log::debug('OK');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function show(Bidding $bidding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function edit(Bidding $bidding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bidding $bidding)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bidding  $bidding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bidding $bidding)
    {
        //
    }
}
