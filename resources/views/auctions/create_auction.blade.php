@extends('layouts.app')

@section('content')

@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

@endpush


@csrf
<div class="container">
    <div class="row">
        <div class='col-sm-10'>

            <form action="{{route('auctions.store')}}" method="POST">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>

                <div class="form-group">
                    <label for="start_price">Start price :</label>
                    <input type="number" class="form-control" id="start_price" name="start_price">
                </div>

                <div class="form-group row">
                    <label for="start_date">Start date :</label>
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control" name="start_date">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="end_date">End date :</label>
                    <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control" name="end_date">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <input type="hidden" name="sellerID" value="{{$seller->id}}">
                <div style="margin-top:10px;"></div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

        </div>
    </div>
</div>




@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
</script>


<script>
$(function() {
    $('#datetimepicker1').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss'
    });
});
</script>

@endpush

@endsection