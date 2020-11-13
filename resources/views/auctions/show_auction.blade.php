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

#fade {
    background-color: #00BFFF;
    animation-name: bckanim;
    animation-fill-mode: forwards;
    animation-duration: 3s;
    animation-delay: 0s;
}

@keyframes bckanim {
    0% {
        background-color: #00BFFF;
    }

    100% {
        background-color: transparent;
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
            <!-- , date {{date('Y-m-d H:i:s')}} -->

            <!-- Precios -->
            <h5 class="title-price" style="display:inline-block;">Price : </h5>
            <h4 style="margin-top:0px;display:inline-block;" id="auction_price">
                ${{$auction->current_price}}
            </h4>
            <br>
            <!-- <h5 style="display:inline-block;">Number of bids : </h5>
            <h5 style="margin-top:0px;display:inline-block;" id="bids_count">
                {{$auction->bids_count}}
            </h5> -->

            <br>

            <h5 style="display:inline-block;">Number of bidders : </h5>
            <h5 style="margin-top:0px;display:inline-block;" id="bidders_count">
                {{$bidders_count}}
            </h5><br>

            @if (Auth::guard('buyer')->user())
            @if($auction->status != 'coming' && $auction->status !='finished')

            <div id="bid-component">
                <input id="access_token" type="hidden" value="{{$buyer->access_token}}">

                <bid-component :access_token="'{{$buyer->access_token}}'" :buyer_id="'{{$buyer->id}}'"
                    :auction_id="'{{$auction->id}}'" :auction_current_price="'{{$auction->current_price}}'"
                    :deposit_amount="'{{Auth::guard('buyer')->user()->deposit_amount}}'">
                </bid-component>
            </div>

            @elseif (is_null(Auth::guard('buyer')->user()->deposit_amount)==true && $auction->status !='finished')

            <p style="color:red;">you need to set a deposit_amount in order to bid! Click <a
                    href="{{ route('buyer.show',Auth::guard('buyer')->user()->id) }}">here</a> to do so</p>

            @else
            <div id="bid-component" style="display:none;">
                <input id="access_token" type="hidden" value="{{$buyer->access_token}}">

                <bid-component :access_token="'{{$buyer->access_token}}'" :buyer_id="'{{$buyer->id}}'"
                    :auction_id="'{{$auction->id}}'" :auction_current_price="'{{$auction->current_price}}'"
                    :deposit_amount="'{{Auth::guard('buyer')->user()->deposit_amount}}'">
                </bid-component>
            </div>
            @endif

            @else

            @endif

            <!-- Detalles especificos del producto -->

            <div class="section" style="padding-bottom:5px;">
                <h6 class="title-attr"><small>Local server time : {{$formattedNow}}</small></h6>
                <h6 class="title-attr" id="auction_start_date" value="{{$auction->start_date}}"><small>Start date :
                        {{$auction->start_date}}</small></h6>
                <h6 class="title-attr" id="auction_end_date" value="{{$auction->end_date}}"><small>End date :
                        {{$auction->end_date}}</small></h6>
                <h6 class="title-attr" id="status_block"><small>Time left :
                        <span id="status" value="{{$auction->status}}"></span></small></h6>
                <br>
                <p>Product description :</p>
                <div>
                    <div> <small>
                            {{$auction->description}}
                        </small></div>
                </div>

            </div>
            @if($auction->status=='finished')
            <div class="card-footer" style="text-align: center;background-color:#FF6347;">
                the auction has <b>finished</b> on the {{$auction->end_date}}
            </div>
            @endif
        </div>

    </div>

    @endsection('content')

    @push('scripts')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    //Get auction end date and current date
    var end_date = document.getElementById("auction_end_date").getAttribute("value")
    var auction_end_date = new Date(end_date)

    var start_date = document.getElementById("auction_start_date").getAttribute("value")
    var auction_start_date = new Date(start_date)

    //Recurring comparison between auction end date and current date

    var timer;

    $(document).ready(function() {

        var status = $("#status").attr("value");

        if (status == 'finished') {
            $("#status_block").remove()

            $("#bid-component").remove();

        } else {
            $("#status").html("Auction " + status + " !");
            $("#status").css("color", "blue");
        }

        timer = setInterval("showTime()", 1000);
    });


    function updateStatus(auction_id, status) {
        window.axios
            .post(
                "http://127.0.0.1/auction-app/public/api/auction-status/" + auction_id, {
                    status,
                    auction_id
                }
            )
            .then((response) => {

                console.log(response);

            });
    }

    function showTime() {

        var current_date = new Date()

        var current_date_1 = new Date(current_date)
        current_date_1.setSeconds(current_date.getSeconds() - 1)

        var current_date_2 = new Date(current_date)
        current_date_2.setSeconds(current_date.getSeconds() + 1)

        //Stop timer if auction end date has been reached out
        if (auction_end_date <= current_date) {
            clearInterval(timer);
            console.log("Auction finished !")
            status = 'finished'
            $("#status").css("color", "red");
            $("#status").html("Auction finished !");
            $("#bid-component").remove();

            updateStatus(auction_id, status)

        } else if (current_date < auction_start_date) {

            $("#bid-component").hide();
            console.log("Auction starting soon...")
            $("#status").html("Auction coming soon ...");
            $("#status").css("color", "green");

        } else if (auction_start_date >= current_date_1 && auction_start_date <= current_date_2) {

            $("#bid-append").replaceWith($("#bid-component"));
            status = 'live'
            // console.log('auction just went LIVE now ! start_date [' + auction_start_date +
            //     '] is between current_date_1 [' + current_date_1 + '] and [' + current_date_2 + ']')
            console.log('Auction is starting now !')
            updateStatus(auction_id, status)

        } else {

            $("#bid-component").show();;
            console.log("Auction live...")
            $("#status").css("color", "blue");
            $("#status").html("Auction live. <br> Current date => " + current_date.toLocaleTimeString() +
                "<br> auction end date => " +
                auction_end_date.toLocaleTimeString() +
                "<br><br>current day = [" + current_date
                .getDate() + "] end day = [" + auction_end_date.getDate() +
                "]<br><br>current month = [" + current_date
                .getMonth() + "] end month = [" + auction_end_date.getMonth() +
                "]<br><br>current hour = [" + current_date
                .getHours() + "] end hour = [" + auction_end_date.getHours() +
                "]<br><br>current minute = [" + current_date
                .getMinutes() + "] end minutes = [" + auction_end_date.getMinutes() +
                "]<br><br>current second = [" + current_date
                .getSeconds() + "] end seconds = [" + auction_end_date.getSeconds() + "]");

            // $("#status_2").html("test left time 2 : " + " day[" + auction_end_date.getSeconds() - current_date
            //     .getSeconds() + "]");$
            var secCountdown = (auction_end_date.getSeconds() - 1);
            $("#status_2").html("countdown=> " + (auction_end_date.getSeconds() - current_date
                .getSeconds()));
        }
    }

    auction_price = document.getElementById('auction_price')
    // bids_count = document.getElementById('bids_count')
    bidders_count = document.getElementById('bidders_count')

    var url = window.location.href;
    var type = url.split('/auctions/');
    var auction_id = '';
    if (type.length > 1)
        auction_id = type[1];
    console.log('auction_id===>' + auction_id)

    var auction_price_background = document.getElementById("auction_price_background")

    Echo.channel('bid')
        .listen('BidRegistered', (e) => {

            //compare auction_id in the URL and the one received from the Laravel Echo event listener 

            //if the condition above is validated, then auction price is updated in real time for the current auction
            if (auction_id == e.auction[0].id) {

                console.log(e);
                console.log('current auction => ' + e.auction[0].id);
                console.log(e.auction[0].current_price);
                console.log('nbr bidders => ');
                console.log(e.bidders);

                auction_price.setAttribute("value", "$" + e.auction[0].current_price)
                auction_price.innerHTML = "$" + e.auction[0].current_price

                // Fade in/out background color effect manage in the CSS in <head> tag above
                auction_price.setAttribute("id", "fade")

                bidders_count.setAttribute("value", e.bidders)
                bidders_count.innerHTML = e.bidders
            }

        });
    </script>
    @endpush