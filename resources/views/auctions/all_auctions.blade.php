@extends('layouts.app')

@push('styles')
<style>
    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }
</style>

@endpush

@section('content')

@foreach ($auctions as $auction) <div class="container-fluid">
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
                            @if (gettype($bidders_count)=="object")
                            {{$bidders_count->bidders($auction->id)}}
                            @else
                            0
                        </p>
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


@endsection('content')