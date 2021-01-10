@extends('layouts.app')
<!-- view code from : https://bootsnipp.com/snippets/EzK6y -->

@push('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<style>
    ul>li {
        margin-right: 25px;
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
        animation-duration: 1.5s;
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
<link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

@endpush


@section('content')
<div id="desktop_view">

    <div class="container">
        <div class="row">
            <div class="col-xs-4 item-photo">
                <img style="max-width:100%;" src="{{$auction->image_url}}" />
            </div>
            <div class="col-xs-5" style="border:0px solid gray">
                <h3>{{$auction->title}}</h3>
                <!-- , date {{date('Y-m-d H:i:s')}} -->

                <h5 style="display:inline-block;">Price : </h5>
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
                @if($auction->status != 'coming' && $auction->status !='finished' &&
                is_null(Auth::guard('buyer')->user()->deposit_amount)==false)

                <div id="bid-component">
                    <input id="access_token" type="hidden" value="{{$buyer->access_token}}">

                    <bid-component :access_token="'{{$buyer->access_token}}'" :buyer_id="'{{$buyer->id}}'" :auction_id="'{{$auction->id}}'" :auction_current_price="'{{$auction->current_price}}'" :deposit_amount="'{{Auth::guard('buyer')->user()->deposit_amount}}'">
                    </bid-component>
                </div>

                @elseif (is_null(Auth::guard('buyer')->user()->deposit_amount)==true && $auction->status !='finished')

                <p style="color:red;">you need to set a deposit_amount in order to bid! Click <a href="{{ route('buyer.show',Auth::guard('buyer')->user()->id) }}">here</a> to do so</p>

                @else
                <div id="bid-component" style="display:none;">
                    <input id="access_token" type="hidden" value="{{$buyer->access_token}}">

                    <bid-component :access_token="'{{$buyer->access_token}}'" :buyer_id="'{{$buyer->id}}'" :auction_id="'{{$auction->id}}'" :auction_current_price="'{{$auction->current_price}}'" :deposit_amount="'{{Auth::guard('buyer')->user()->deposit_amount}}'">
                    </bid-component>
                </div>
                @endif

                @else

                @endif

                <div class="section" style="padding-bottom:5px;">
                    <!-- <h6 class="title-attr"><small>Local server time : {{$formattedNow}}</small></h6> -->
                    <h6 class="title-attr" id="auction_start_date" value="{{$auction->start_date}}"><small>Start date :
                            {{$auction->start_date}}</small></h6>
                    <h6 class="title-attr" id="auction_end_date" value="{{$auction->end_date}}"><small>End date :
                            {{$auction->end_date}}</small></h6>
                    <h6 class="title-attr" id="status_block">
                        <span id="status" value="{{$auction->status}}"></span>
                    </h6>
                    <br>
                    <p>Product description :</p>
                    <div>
                        <div> <small>
                                {{$auction->description}}
                            </small></div>
                    </div>

                    @if (Auth::guard('buyer')->user() && $auction->status=='finished' )

                    @if(!empty($auction->winner($auction->id)) && $auction->winner($auction->id)[0]->buyer_id ==
                    $buyer->id)
                    <div class="card-text" style="background-color:#82E0AA ;opacity:50%;">
                        <p style="color:black;opacity:100%;"> You've
                            won this auction <i class="em em---1" aria-role="presentation" aria-label="THUMBS UP SIGN"></i>
                        </p>
                    </div>
                    @endif
                    @endif

                </div>
                @if($auction->status=='finished')
                <div class="card-footer" style="text-align: center;background-color:#FF6347;">
                    the auction has <b>finished</b> on the {{$auction->end_date}}
                </div>
                @endif
            </div>

        </div>
    </div>
</div>

<!-- responsive version code below -->

<div id="mobile_view">

    <div class="col d-flex justify-content-center">
        <div class="row">
            <div class="card">
                <div class="col-xs-12" style="text-align:center;background-color:#8ec3eb;">
                    <h4 style="display:inline-block;" class="auction-title">{{$auction->title}}</h4> -
                    <span id="auction_price">${{$auction->current_price}}</span>
                </div>

                <div class="row" class="justify-content-center">
                    <div class="col-12 col-xs-6" class="col-5 img-square-wrapper"><a href="{{route('auctions.show',$auction->id)}}" style="text-decoration: none;color:inherit;">
                            <img src="{{$auction->image_url}}" style="max-width: 100%;display: block;margin-left: auto;margin-right: auto;"></a>
                    </div>
                </div>

                <div class="row" class="justify-content-center">
                    <div class="col-12 col-xs-6">
                        <b><u>Bidders</u></b> : {{$bidders_count}}
                        <br>
                    </div>
                </div>

                <div class="row" class="justify-content-center">
                    <div class="col-12 col-xs-6">
                        <b><u>Description</u></b> : <br>
                        <p style="text-align:center;">{{$auction->description}}</p>
                    </div>
                </div>


                <div class="row" class="justify-content-center">
                    <div class="col-12 col-xs-6">

                        @if (Auth::guard('buyer')->user())
                        @if($auction->status != 'coming' && $auction->status !='finished' &&
                        is_null(Auth::guard('buyer')->user()->deposit_amount)==false)

                        <div id="bid-component" style="text-align:center;">
                            <input id="access_token" type="hidden" value="{{$buyer->access_token}}">

                            <bid-component :access_token="'{{$buyer->access_token}}'" :buyer_id="'{{$buyer->id}}'" :auction_id="'{{$auction->id}}'" :auction_current_price="'{{$auction->current_price}}'" :deposit_amount="'{{Auth::guard('buyer')->user()->deposit_amount}}'">
                            </bid-component>
                        </div>

                        @elseif (is_null(Auth::guard('buyer')->user()->deposit_amount)==true && $auction->status
                        !='finished')

                        <p style="color:red;">you need to set a deposit_amount in order to bid! Click <a href="{{ route('buyer.show',Auth::guard('buyer')->user()->id) }}">here</a> to do so</p>

                        @else
                        <div id="bid-component" style="display:none;">
                            <input id="access_token" type="hidden" value="{{$buyer->access_token}}">

                            <bid-component :access_token="'{{$buyer->access_token}}'" :buyer_id="'{{$buyer->id}}'" :auction_id="'{{$auction->id}}'" :auction_current_price="'{{$auction->current_price}}'" :deposit_amount="'{{Auth::guard('buyer')->user()->deposit_amount}}'">
                            </bid-component>
                        </div>
                        @endif

                        @else

                        @endif
                    </div>
                </div>

                @if($auction->status=='live')
                <div class="card-footer" style="text-align: center;background-color:#c1cec9;">
                    <small>will finish on the<b>[{{$auction->end_date}}]</b></small>
                </div>
                @elseif($auction->status == 'coming')
                <div class="card-footer" style="text-align: center;background-color:#c1cec9;">
                    <b>coming to start</b> on the {{$auction->start_date}}
                </div>
                @else
                <div class="card-footer" style="text-align: center;background-color:#c1cec9;">
                    <b>finished</b> on the {{$auction->end_date}}
                </div>
                @endif

            </div>
        </div>
    </div>

    <div style="display:block;margin-top:10px;"></div>

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
    //Conditional rendering that manages mobile or desktop

    var isMobileRender = matchMedia('(max-width: 500px)').matches;
    var auctions = document.getElementsByClassName("auction")
    var mobileView = document.getElementById("mobile_view")
    var desktopView = document.getElementById("desktop_view")
    var main = document.getElementsByClassName("py-4")

    if (isMobileRender) {
        desktopView.style.display = 'none'
        mobileView.style.display = ''
        main[0].insertBefore(mobileView, main[0].childNodes[0])

        console.log("show mobile")
    } else {
        mobileView.style.display = 'none'
        desktopView.style.display = ''
        main[0].insertBefore(desktopView, main[0].childNodes[0])

    }

    //real time resize on screen size change
    $(window).resize(function() {

        if (window.screen.width <= 500) {

            desktopView.style.display = 'none'
            mobileView.style.display = ''
            main[0].insertBefore(mobileView, main[0].childNodes[0])

        } else {

            mobileView.style.display = 'none'
            desktopView.style.display = ''
            main[0].insertBefore(desktopView, main[0].childNodes[0])

        }

    });

    //Function to display realtime countdown betfore auction start date or auction end date

    function renderCountdown(dateStart, dateEnd, count) {

        var currentDate = dateStart.getTime();

        var targetDate = dateEnd.getTime(); // set the countdown date
        var days, hours, minutes, seconds; // variables for time units

        var getCountdown = function(c) {
            // find the amount of "seconds" between now and target
            var secondsLeft = ((targetDate - currentDate) / 1000) - c;
            days = pad(Math.floor(secondsLeft / 86400));
            secondsLeft %= 86400;
            hours = pad(Math.floor(secondsLeft / 3600));
            secondsLeft %= 3600;
            minutes = pad(Math.floor(secondsLeft / 60));
            seconds = pad(Math.floor(secondsLeft % 60));
            // format countdown string + set tag value
            $("#status").html("<br>Current date/time : " + dateStart + ". Days left : " + days +
                ". Time left : " +
                hours + ":" + minutes + ":" +
                seconds)
        }

        function pad(n) {
            return (n < 10 ? '0' : '') + n;
        }
        getCountdown(count);

    }

    //Get auction end date and current date
    var end_date = document.getElementById("auction_end_date").getAttribute("value")
    var auction_end_date = new Date(end_date)

    var start_date = document.getElementById("auction_start_date").getAttribute("value")
    var auction_start_date = new Date(start_date)

    var current_date_static = new Date()

    var current_date_static =
        `${current_date_static.getFullYear().toString().padStart(4, '0')}-${(current_date_static.getMonth()+1).toString().padStart(2, '0')}-${current_date_static.getDate().toString().padStart(2, '0')} ${current_date_static.getHours().toString().padStart(2, '0')}:${current_date_static.getMinutes().toString().padStart(2, '0')}:${current_date_static.getSeconds().toString().padStart(2, '0')}`;

    //Recurring comparison between auction end date and current date

    var timer;
    timer = setInterval("showTime()", 1000);


    $(document).ready(function() {

        var status = $("#status").attr("value");

        if (status == 'finished') {
            $("#status_block").remove()
            $("#bid-component").remove();

        } else if (status == 'coming') {
            $("#status").html("Auction " + status + " !");
            $("#status").css("color", "orange");

        } else {
            // $("#status").html("Auction is" + status + " !");
            // $("#status").css("color", "red");
        }

    });


    function updateStatus(auction_id, status) {

        api_url = ''
        if (window.location.hostname == 'auctions-webapp.herokuapp.com') {
            api_url = 'https://auctions-webapp.herokuapp.com/api'
        } else {
            api_url = 'http://127.0.0.1/auction-app/public/api'
        }

        window.axios
            .post(
                api_url + "/auction-status/" + auction_id, {
                    status,
                    auction_id
                }
            )
            .then((response) => {

                console.log(response);

            });
    }

    var count = 0

    function showTime() {

        var current_date = new Date()
        var current_date_renderCount =
            `${current_date.getFullYear().toString().padStart(4, '0')}-${(current_date.getMonth()+1).toString().padStart(2, '0')}-${current_date.getDate().toString().padStart(2, '0')} ${current_date.getHours().toString().padStart(2, '0')}:${current_date.getMinutes().toString().padStart(2, '0')}:${current_date.getSeconds().toString().padStart(2, '0')}`;

        var current_date_1 = new Date(current_date)
        current_date_1.setSeconds(current_date.getSeconds() - 1)

        var current_date_2 = new Date(current_date)
        current_date_2.setSeconds(current_date.getSeconds() + 1)

        //Stop timer if auction end date has been reached out
        if (auction_end_date <= current_date) {
            status = 'finished'
            clearInterval(timer);
            console.log("Auction finished !")
            status = 'finished'
            $("#status").css("color", "red");
            $("#status").html("Auction finished !");
            $("#bid-component").remove();

            updateStatus(auction_id, status)

        } else if (current_date < auction_start_date) {

            status = 'coming'
            $("#bid-component").hide();

            //Real time countdown before auction end date : renderCountdown(start_date,end_date)

            renderCountdown(new Date(current_date_static), new Date(start_date), count)

        } else if (auction_start_date >= current_date_1 && auction_start_date <= current_date_2) {

            $("#bid-append").replaceWith($("#bid-component"));
            status = 'live'
            console.log("STATUS setInterval==> " + status)

            console.log('Auction is starting now !')

            updateStatus(auction_id, status)

        } else {

            $("#bid-component").show();
            $("#status").css("color", "blue");

            //Real time countdown before auction end date

            renderCountdown(new Date(current_date_static), new Date(end_date), count)
        }
        count++
    }

    auction_price = document.getElementById('auction_price')
    // bids_count = document.getElementById('bids_count')
    bidders_count = document.getElementById('bidders_count')

    var url = window.location.href;
    var type = url.split('/auctions/');
    var auction_id = '';
    if (type.length > 1)
        auction_id = type[1];

    var auction_price_background = document.getElementById("auction_price_background")

    Echo.channel('bid')
        .listen('BidRegistered', (e) => {

            //compare auction_id in the URL and the one received from the Laravel Echo event listener 

            //if the condition above is validated, then auction price is updated in real time for the current auction
            if (auction_id == e.auction[0].id) {

                console.log(e);
                auction_price.setAttribute("value", "$" + e.auction[0].current_price)
                auction_price.innerHTML = "$" + e.auction[0].current_price

                // Fade in/out background color effect manage in the CSS in <head> tag above
                auction_price.setAttribute("id", "fade")

                bidders_count.setAttribute("value", e.bidders)
                bidders_count.innerHTML = e.bidders

                setTimeout(
                    function() {
                        auction_price.setAttribute("id", "out")
                    }, 1500);

            }

        });
</script>
@endpush