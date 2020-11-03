<?php

namespace App\Events;

use Illuminate\Support\Facades\Log;
use App\Buyer;
use App\Bidding;
use App\Auction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Database\Eloquent\Collection;

class BidRegistered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $bidding;
    public $auction;
    public $bidders;

    public function __construct($bidding)
    {
        $this->bidding=$bidding;
        $this->bidders=$bidding->bidders($bidding->auction_id);
        $this->auction=Auction::where('id',$bidding->auction_id)->get();     

        if ($this->bidding){

            Log::debug('Bid registered from BidRegistered event class=> ');
            Log::debug($bidding);

            //Update the current price of the auction using the bidded_price just registered here
            $this->auction[0]->current_price = $bidding->bidded_price;
            $this->auction[0]->save();
            Log::debug('auction after update from BidRegistered event class');        
            Log::debug($this->auction);  
            
        }

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        Log::debug('bid from Bidregistered event class-----');
        Log::debug('-----');
        return new Channel('bid');
    }
}