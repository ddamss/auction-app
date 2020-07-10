<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        if (Auth::guard('buyer')->user()->id==$buyer->id)
        {
            $id=$buyer->id;
            return view('buyer.profile_show', ['buyer' => Buyer::findOrFail($id)]);
        }else{
            return 'you\'re trying to access to another user';
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit(Buyer $buyer)
    {
        if (Auth::guard('buyer')->user()->id==$buyer->id)
        {
            $id=$buyer->id;
            return view('buyer.profile_edit', ['buyer' => Buyer::findOrFail($id)]);
        }else{
            return 'you\'re trying to access to another user';
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
     * @param  \App\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer)
    {
        //
    }
}
