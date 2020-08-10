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

@foreach ($auctions as $auction)
<div class="container-fluid">
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-horizontal">
                    <div class="col-5 img-square-wrapper" style="width:auto;"><a href="{{route('auctions.show',$auction->id)}}" style="text-decoration: none;color:inherit;">
                            <img class="" style="height:auto;max-width:30%;" src="{{$auction->image_url}}" alt="{{$auction->title}}">
                        </a>
                    </div>
                    <div class="col-5 card-body">
                        <h4 class="card-title" style="text-align: left;">{{$auction->title}}</h4>
                        <p class="card-text" style="text-align: left;">{{$auction->description}}</p>
                    </div>
                    <div style="margin: auto;" class="col-2">
                        <h4 class="card-title" style="text-align: center;">{{$auction->current_price}} $ </h4>
                    </div>
                    <div style="width:10px;">
                    </div>
                </div>
                <div class="card-footer" style="text-align: center;">
                    <small class=" text-muted">start the {{$auction->start_date}} and end the {{$auction->end_date}}</small>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach

@endsection('content')