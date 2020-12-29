@extends('layouts.app')

@push('styles')
<style>
    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }
</style>
<link href="https://emoji-css.afeld.me/emoji.css" rel="stylesheet">

@endpush

@section('content')

@if(!$auctions->isEmpty())

@foreach ($auctions as $auction)
<div class="container-fluid">
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
                            {{$bidders_count}}</p>


                        @if($auction->winner($auction->id)[0]->buyer_id == $buyer_id)
                        <div class="card-text" style="text-align: left; background-color:#82E0AA ;text-align: center;opacity:50%;">
                            <p style="color:black;opacity:100%;"> You've
                                won this auction <i class="em em---1" aria-role="presentation" aria-label="THUMBS UP SIGN"></i> </p>
                        </div>
                        @endif

                    </div>

                    <div style="margin: auto;" class="col-2">
                        <h2 class="card-title" style="text-align: center; color:grey;">${{$auction->current_price}}
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

@else

<p>you don't have any auctions yet</p>

@endif


@endsection('content')