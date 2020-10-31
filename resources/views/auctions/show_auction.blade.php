@extends('layouts.app')
<!-- view code from : https://bootsnipp.com/snippets/EzK6y -->

@push('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<style>
ul>li {
    margin-right: 25px;
    font-weight: lighter;
    cursor: pointer
}

li.active {
    border-bottom: 3px solid silver;
}

.item-photo {
    display: flex;
    justify-content: center;
    align-items: center;
    border-right: 1px solid #f6f6f6;
}

.menu-items {
    list-style-type: none;
    font-size: 11px;
    display: inline-flex;
    margin-bottom: 0;
    margin-top: 20px
}

.btn-success {
    width: 100%;
    border-radius: 0;
}

.section {
    width: 100%;
    margin-left: -15px;
    padding: 2px;
    padding-left: 15px;
    padding-right: 15px;
    background: #f8f9f9
}

.title-price {
    margin-top: 30px;
    margin-bottom: 0;
    color: black
}

.title-attr {
    margin-top: 0;
    margin-bottom: 0;
    color: black;
}

.btn-minus {
    cursor: pointer;
    font-size: 7px;
    display: flex;
    align-items: center;
    padding: 5px;
    padding-left: 10px;
    padding-right: 10px;
    border: 1px solid gray;
    border-radius: 2px;
    border-right: 0;
}

.btn-plus {
    cursor: pointer;
    font-size: 7px;
    display: flex;
    align-items: center;
    padding: 5px;
    padding-left: 10px;
    padding-right: 10px;
    border: 1px solid gray;
    border-radius: 2px;
    border-left: 0;
}

div.section>div {
    width: 100%;
    display: inline-flex;
}

div.section>div>input {
    margin: 0;
    padding-left: 5px;
    font-size: 10px;
    padding-right: 5px;
    max-width: 18%;
    text-align: center;
}

.attr,
.attr2 {
    cursor: pointer;
    margin-right: 5px;
    height: 20px;
    font-size: 10px;
    padding: 2px;
    border: 1px solid gray;
    border-radius: 2px;
}

.attr.active,
.attr2.active {
    border: 1px solid orange;
}

@media (max-width: 426px) {
    .container {
        margin-top: 0px !important;
    }

    .container>.row {
        padding: 0 !important;
    }

    .container>.row>.col-xs-12.col-sm-5 {
        padding-right: 0;
    }

    .container>.row>.col-xs-12.col-sm-9>div>p {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    .container>.row>.col-xs-12.col-sm-9>div>ul {
        padding-left: 10px !important;

    }

    .section {
        width: 104%;
    }

    .menu-items {
        padding-left: 0;
    }
}
</style>

@endpush


@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-4 item-photo">
            <img style="max-width:100%;" src="{{$auction->image_url}}" />
        </div>
        <div class="col-xs-5" style="border:0px solid gray">
            <!-- Datos del vendedor y titulo del producto -->
            <h3>{{$auction->title}}</h3>

            <!-- Precios -->
            <h5 class="title-price" style="display:inline-block;">Price : </h5>
            <h3 style="margin-top:0px;display:inline-block;" id="auction_price">
                ${{$auction->current_price}}
            </h3><br>

            @if (Auth::guard('buyer')->user())
            @if(is_null(Auth::guard('buyer')->user()->deposit_amount)==false)

            <input id="access_token" type="hidden" value="{{$buyer->access_token}}">

            <bid-component :access_token="'{{$buyer->access_token}}'" :buyer_id="'{{$buyer->id}}'"
                :auction_id="'{{$auction->id}}'" :auction_current_price="'{{$auction->current_price}}'"
                :deposit_amount="'{{Auth::guard('buyer')->user()->deposit_amount}}'">
            </bid-component>

            @elseif (is_null(Auth::guard('buyer')->user()->deposit_amount)==true)

            <p style="color:red;">you need to set a deposit_amount in order to bid! Click <a
                    href="{{ route('buyer.show',Auth::guard('buyer')->user()->id) }}">here</a> to do so</p>

            @endif

            @else

            @endif

            <!-- Detalles especificos del producto -->

            <div class="section" style="padding-bottom:5px;">
                <h6 class="title-attr"><small>Start date : {{$auction->start_date}}</small></h6>
                <h6 class="title-attr" id="auction_end_date" value="{{$auction->end_date}}"><small>End date :
                        {{$auction->end_date}}</small></h6>
                <h6 class="title-attr"><small>Time left : <span id="left_time"></span></small></h6>
                <br>
                <div>
                    <div> <small>
                            {{$auction->description}}
                        </small></div>
                </div>

            </div>

        </div>
    </div>

    @endsection('content')

    @push('scripts')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

    <script>
    //Get auction end date and current date
    var end_date = document.getElementById("auction_end_date").getAttribute("value")
    var auction_end_date = new Date(end_date)
    console.log("auction_end_date => " + auction_end_date)

    //Regular comparison between auction end date and current date

    var timer;

    $(document).ready(function() {
        timer = setInterval("showTime()", 4000);
    });

    function showTime() {

        var current_date = new Date()

        //Stop timer if auction end date has been reached out
        if (auction_end_date <= current_date) {
            clearInterval(timer);
            console.log("Auction finished !")
            $("#left_time").html("Auction finished !");
            $("#left_time").css("color", "red");

        } else {
            console.log("Auction live...")
            $("#left_time").html("Auction live. Current date => " + current_date.toLocaleTimeString() +
                ", auction end date => " +
                auction_end_date.toLocaleTimeString());
        }
    }

    auction_price = document.getElementById('auction_price')
    Echo.channel('bid')
        .listen('BidRegistered', (e) => {
            console.log(e);
            console.log(e.auction[0].current_price);
            auction_price.setAttribute("value", "$" + e.auction[0].current_price)
            auction_price.innerHTML = "$" + e.auction[0].current_price
            console.log('price==> ' + auction_price.getAttribute("value"))
        });
    </script>
    @endpush