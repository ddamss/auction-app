@extends('layouts.app')

@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

@endpush

@section('content')

<div id="test">hello test</div>
<br><br><br>

<div class="container">
    <div class="row">
        <div class='col-sm-10'>

            <form action="{{route('auctions.store')}}" method="POST">
                @csrf

                <div class="form-group row">
                    <label for="start_date">Start date :</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" name="start_date">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="end_date">End date :</label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' class="form-control" name="end_date">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>


@endsection('content')

@push('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $('#test').css('background', 'red');
</script>



<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<script>
    $(document).ready(function() {

        $(function() {
            $('#datetimepicker1').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });

        $(function() {
            $('#datetimepicker2').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });
        });

    });
</script>

@endpush