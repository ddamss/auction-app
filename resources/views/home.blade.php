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
                        <li>PHP/Laravel framework 8.x</li>
                    </ul>
                    <ul>
                        <li>Laravel Passeport for the API side</li>
                    </ul>
                    <ul>
                        <li>Pusher + Laravel Echo for the real time bidding</li>
                    </ul>
                    <br>
                    <li class="list-group-item active">Font-end</li><br>
                    <ul>
                        <li>Javascript/Vue.js</li>
                    </ul>
                    <ul>
                        <li>Bootstrap</li>
                    </ul>
                    <ul>
                        <li>Laravel blade</li>
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

                    {{ __('You are logged in !') }}

                    <b> {{ Auth::guard('buyer')->user()?Auth::guard('buyer')->user()->name:Auth::guard('seller')->user()->name   }}
                        <span class="caret"></span></b>
                    <br>

                    {{Auth::id()}}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection