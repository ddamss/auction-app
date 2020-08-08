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
                    <div class="img-square-wrapper"><a href="{{route('auctions.show',$auction->id)}}" style="text-decoration: none;color:inherit;">
                            <img class="" src="http://via.placeholder.com/300x180" alt="Card image cap">
                        </a>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{$auction->title}}</h4>
                        <p class="card-text">{{$auction->description}}</p>
                    </div>
                    <div style="margin: auto;">
                        <h4 class="card-title">{{$auction->current_price}} $ </h4>
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

<!-- @foreach ($auctions as $auction)

<div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
        <div class="col-md-4">
            <svg class="bd-placeholder-img" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" role="img">
                <title>{{$auction->title}}</title>
                <rect width="100%" height="100%" fill="#868e96" /><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text>
            </svg>

        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{$auction->title}}</h5>
                <p class="card-text">{{$auction->current_price}}</p>
                <p class="card-text">{{$auction->description}}</p>
                <p class="card-text"><small class="text-muted">{{$auction->start_date}}</small></p>
                <p class="card-text"><small class="text-muted">{{$auction->end_date}}</small></p>
            </div>
        </div>
    </div>
</div>
@endforeach

-->

<div class="list-group" style="display:block;margin:50px 50px;">

    @foreach($auctions as $auction)
    <div class="list-group">
        <div>
            <svg class="bd-placeholder-img" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" role="img">
                <title>{{$auction->title}}</title>
                <rect width="100%" height="100%" fill="#868e96" /><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text>
            </svg>
        </div>
        <div class="list-group-item list-group-item-action"><a href="{{route('auctions.show',$auction->id)}}" style="text-decoration: none;color:inherit;">
                <div class="d-flex w-100 justify-content-between">
                    <h4>{{$auction->title}}</h4>
                    <b>{{$auction->id}}</b>
                </div>
                <p>{{$auction->description}}</p>
        </div></a><br>
    </div>
    @endforeach
</div>
@endsection('content')