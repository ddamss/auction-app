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
                    <li class="list-group-item active"><b>Back-end</b></li><br>
                    <ul>
                        <li>PHP 7.4.0 along with <a href="https://laravel.com/docs/8.x" target="_blank">Laravel</a>
                            framework 8.x</li>
                    </ul>
                    <ul>
                        <li>MySQL open-source Relational Database Management System</li>
                    </ul>
                    <ul>
                        <li><a href="https://laravel.com/docs/8.x/passport" target="_blank">Laravel Passeport</a> for
                            the API
                            authentication</li>
                    </ul>
                    <ul>
                        <li><a href="https://laravel.com/docs/8.x/broadcasting#concept-overview" target="_blank">Laravel
                                Broadcasting</a> integrated with Pusher (below) to share the bidding events between
                            server-side
                            code and client-side JavaScript application.</li>
                    </ul>
                    <br>

                    <li class="list-group-item active"><b>Font-end</b></li><br>
                    <ul>
                        <li>Javascript along with <a href="https://vuejs.org/" target="_blank">Vue.js</a> v2 framework
                        </li>
                    </ul>
                    <ul>
                        <li><a href="https://laravel.com/docs/8.x/broadcasting#installing-laravel-echo"
                                target="_blank">Laravel Echo</a>
                            to listen for bidding events broadcast by Laravel for the real time bidding</li>
                    </ul>
                    <ul>
                        <li>Bootstrap</li>
                    </ul>
                    <ul>
                        <li>Laravel <a href="https://laravel.com/docs/8.x/blade" target="_blank">blade templates</a>
                        </li>
                    </ul>
                    <br>

                    <li class="list-group-item active"><b>Third-party service solutions</b></li><br>
                    <ul>
                        <li><a href="https://pusher.com/channels" target="_blank">Pusher</a> to broadcast
                            server-side Laravel events (bidding) to the client-side JS application</li>
                    </ul>
                    <ul>
                        <li><a href="https://aws.amazon.com/s3/getting-started/?trkCampaign=acq_paid_search_brand&sc_channel=PS&sc_campaign=acquisition_EMEA&sc_publisher=Google&sc_category=Storage&sc_country=EMEA&sc_geo=EMEA&sc_outcome=acq&sc_detail=%2Bamazon%20%2Bs3&sc_content={ad%20group}&sc_matchtype=b&sc_segment=468756605427&sc_medium=ACQ-P|PS-GO|Brand|Desktop|SU|Storage|S3|EMEA|EN|Sitelink|xx|non-EU&s_kwcid=AL!4422!3!468756605427!b!!g!!%2Bamazon%20%2Bs3&ef_id=CjwKCAiAv4n9BRA9EiwA30WNDxS4TOLZe2Poayosib1Pm6zyZiYRt5ImPiqJwB1Vl4FQ2Bop78meTBoCjqUQAvD_BwE:G:s&s_kwcid=AL!4422!3!468756605427!b!!g!!%2Bamazon%20%2Bs3"
                                target="_blank">
                                AWS Simple Storage Service (Amazon S3)</a> for auction images hosting</li>
                    </ul>
                    <br>
                </ul>
                <br>

                <li class="list-group-item active"><b>Packages</b></li><br>
                <ul>
                    <li>...</li>
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