@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @if (!Auth::guard('buyer')->user() AND !Auth::guard('seller')->user())
                    no user connected
                        @else
                                {{ Auth::guard('buyer')->user()?Auth::guard('buyer')->user()->name:Auth::guard('seller')->user()->name   }} <span class="caret"></span>

                        @endif                </div>
            </div>
        </div>
    </div>
</div>
@endsection
