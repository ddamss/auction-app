<?php

namespace App;

use App\Events\BidRegistered;
use Illuminate\Database\Eloquent\Model;

class Bidding extends Model
{
    public $fillable = ['auction_id', 'buyer_id', 'bidded_price'];

    protected $dispatchesEvents = [
        'created' => BidRegistered::class
    ];

    public function auction()
    {
        return $this->hasOne('App\Models\Auction');
    }
}