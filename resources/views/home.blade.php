@extends('layouts.app')

@section('content')
@if (!Auth::guard('buyer')->user() AND !Auth::guard('seller')->user())

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="display-7" style="text-align:center;">Technologies used to build this web-app</h1>
            <br>
            <div class="card">
                <ul class="list-group">
                    <li class="list-group-item active">Back-end</li><br>
                    <ul>
                        <li>PHP using <a href="https://laravel.com/docs/8.x">Laravel</a> framework 8.x</li>
                    </ul>
                    <ul>
                        <li><a href="https://laravel.com/docs/8.x/passport">Laravel Passeport</a> for the API
                            authentication</li>
                    </ul>
                    <ul>
                        <li><a href="https://laravel.com/docs/8.x/broadcasting#concept-overview">Pusher</a> to broadcast
                            server-side Laravel events (bidding) to the client-side JS application</li>
                    </ul>
                    <br>
                    <li class="list-group-item active">Font-end</li><br>
                    <ul>
                        <li>Javascript/<a href="https://vuejs.org/">Vue.js</a></li>
                    </ul>
                    <ul>
                        <li><a href="https://laravel.com/docs/8.x/broadcasting#installing-laravel-echo">Laravel Echo</a>
                            to listen for bidding events broadcast by Laravel for the real time bidding</li>
                    </ul>
                    <ul>
                        <li>Bootstrap</li>
                    </ul>
                    <ul>
                        <li>Laravel <a href="https://laravel.com/docs/8.x/blade">blade templates</a></li>
                    </ul>
                    <br>
                </ul>
                @else
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="container">
                        <p style="text-align:center;">{{ __('You are logged in !') }}
                            <b> {{ Auth::guard('buyer')->user()?Auth::guard('buyer')->user()->name:Auth::guard('seller')->user()->name   }}
                                <span class="caret"></span></b>
                        </p>
                    </div>

                    <br>

                    {{Auth::id()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection