<?php

namespace App\Http\Controllers;

use App\Buyer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
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
        dd('edit controller');
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

            $buyer->deposit_amount=$request->deposit_amount_val;
            $buyer->save();
            Log::debug($request);
            Log::debug($buyer->jsonSerialize());            
            return response($buyer->jsonSerialize(),Response::HTTP_CREATED);

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
