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

class BidRegistered implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public $auction_id;

    public function __construct($auction_id)
    {
        $this->auction_id=$auction_id;

        Log::debug('Bidregistered constructor');
        Log::debug($this->auction_id);

        // // $auction=Auction::()        
        // $lastBid=Bidding::where('auction_id',2)->latest()->first();//get latest bid for the specific auction_id
        // Log::debug($lastBid);
        // Log::debug('last bid price => '.$lastBid->bidded_price);
        
        // // $auction->current_price = $lastBid->bidded_price;
        // // $auction->save();
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
