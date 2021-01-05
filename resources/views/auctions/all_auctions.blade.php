@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<style>
    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }
</style>

@endpush

@section('content')

<div id="desktop_view">

    @foreach ($auctions as $auction) <div class="container-fluid auction">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-horizontal">
                        <div class="col-5 img-square-wrapper" style="width:auto;"><a href="{{route('auctions.show',$auction->id)}}" style="text-decoration: none;color:inherit;">
                                <img class="" style="height:auto;max-width:80%; display: block; margin-left: auto; margin-right: auto;" src="{{$auction->image_url}}" alt="{{$auction->title}}">
                            </a>
                        </div>
                        <div class="col-5 card-body">
                            <h2 class="card-title" style="text-align: left;">{{$auction->title}}</h2>
                            <p class="card-text" style="text-align: left;">{{$auction->description}}</p>
                            <p class="card-text" style="text-align: left;">bidders :
                                @if (gettype($bidders_count)=='object')
                                {{$bidders_count->bidders($auction->id)}}
                                @else
                                0
                                @endif
                            </p>

                        </div>
                        <div style="margin: auto;" class="col-2">
                            <h2 class="card-title" style="text-align: center; color:grey;">
                                ${{$auction->current_price}}
                            </h2>
                        </div>
                        <div style="width:10px;">
                        </div>
                    </div>

                    @if($auction->status=='live')
                    <div class="card-footer" style="text-align: center;background-color:#ADD8E6;">
                        <small>start the <b>[{{$auction->start_date}}]</b> and
                            end the
                            <b>[{{$auction->end_date}}]</b></small>
                    </div>
                    @elseif($auction->status == 'coming')
                    <div class="card-footer" style="text-align: center;background-color:#20B2AA;">
                        the auction is <b>coming to start</b> on the {{$auction->start_date}}
                    </div>
                    @else
                    <div class="card-footer" style="text-align: center;background-color:#FF6347;">
                        the auction has <b>finished</b> on the {{$auction->end_date}}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @endforeach


    <div style="text-align:center;">
        {{ $auctions->links() }}
    </div>

</div>

<div id="mobile_view">
    @foreach ($auctions as $auction)

    <div class="col d-flex justify-content-center">
        <div class="row">
            <div class="card">
                <div class="col-xs-9" style="text-align:center;background-color:#8ec3eb;">
                    <h4 style="display:inline-block;">{{$auction->title}}</h4> - ${{$auction->current_price}}
                </div>

                <div class="row" class="justify-content-center">
                    <div class="col-12 col-xs-6" class="col-5 img-square-wrapper"><a href="{{route('auctions.show',$auction->id)}}" style="text-decoration: none;color:inherit;">
                            <img src="{{$auction->image_url}}" style="max-width: 100%;display: block;margin-left: auto;margin-right: auto;"></a>
                    </div>
                </div>

                <div class="row" class="justify-content-center">
                    <div class="col-12 col-xs-6">

                        <b><u>Bidders</u></b> :
                        @if (gettype($bidders_count)=="object")
                        {{$bidders_count->bidders($auction->id)}}
                        @else
                        0
                        @endif
                        <br>


                    </div>
                </div>

                <div class="row" class="justify-content-center">
                    <div class="col-12 col-xs-6">
                        <b><u>Description</u></b> : <br>
                        <p style="text-align:center;">{{$auction->description}}</p>
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

    @endforeach

    <div style="text-align:center;">
        {{ $auctions->links() }}
    </div>

</div>

@endsection('content')

@push('scripts')
<script>
    //Conditional rendering that manages mobile or desktop

    let isMobileRender = matchMedia('(max-width: 500px)').matches;
    console.log(isMobileRender)
    var auctions = document.getElementsByClassName("auction")
    console.log(auctions)
    var mobileView = document.getElementById("mobile_view")
    var desktopView = document.getElementById("desktop_view")

    if (isMobileRender) {

        for (i = 0; i < auctions.length; i++) {
            auctions[i].style.display = 'none'
        }
        // auctions.style.display = 'none'
        console.log('MOBILE VERSION')
        // renderTxt.innerHTML = "MOBILE VERSION DISPLAYED"
        desktopView.style.display = 'none'

    } else {
        console.log('DESKTOP VERSION')
        mobileView.style.display = 'none'

    }
</script>
@endpush