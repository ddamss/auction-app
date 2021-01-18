@extends('layouts.app_2')

@push('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

@endpush

@section('content')


<div class="container">
    <div class="row">
        <div class='col-sm-10'>

            <form method="POST" action="{{route('auctions.store')}}" enctype="multipart/form-data" id="form">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea type="text" class="form-control" id="description" name="description"></textarea required>
                </div>

                <div class="form-group">
                    <label for="about" class="col-sm-3 control-label">Upload image</label>
                        <input type="file" class="form-control" name="image" id="image" placeholder="Image upload" required>
                </div>

                <div class="form-group">
                    <label for="start_price">Start price :</label>
                    <input type="number" class="form-control" id="start_price" name="start_price" required>
                </div>

                <div class="form-group row">
                    <label for="start_date">Start date (Gulf Standard Time) :</label>
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='text' class="form-control" name="start_date" id="start_date" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="end_date">End date (Gulf Standard Time) :</label>
                    <div class='input-group date' id='datetimepicker2'>
                        <input type='text' class="form-control" name="end_date" id="end_date" required>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>

                <input type="hidden" name="seller_id" value="{{$seller->id}}">
                <div style="margin-top:10px;"></div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

        </div>
    </div>
</div>

@endsection('content')

@push('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js">
</script>

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

    $("#form").submit(function(e) {

        var start_date=$("#start_date").val()
        var end_date=$("#end_date").val()
        var current_date = new Date();
        var dd = current_date.getDate();
        var mm = current_date.getMonth()+1; 
        var yyyy = current_date.getFullYear();
        var hours=current_date.getHours()
        var minutes=current_date.getMinutes()
        var seconds=current_date.getSeconds()

        if(dd<10) 
        {
            dd=`0${dd}`;
        } 

        if(mm<10) 
        {
            mm=`0${mm}`;
        } 

        if(hours<10){
            hours=`0${hours}`;   
        }

        if(minutes<10){
            minutes=`0${minutes}`;   
        }

        if(seconds<10){
            seconds=`0${seconds}`;   
        }

        current_date = `${yyyy}-${mm}-${dd} ${hours}:${minutes}:${seconds}`;
    
        if (start_date <= current_date) {
            
            // console.log('start date = ' + start_date + ' < current_date=' + current_date)
            alert('Start date '+[start_date]+' should be after current date '+[current_date])
            return false;

        } else if(start_date >= end_date){
            
            // console.log('start date = ' + start_date + ' >= end_date=' + end_date)
            alert('Start date'+[start_date]+' should be before end_date '+[end_date])
            return false;
        
        } else if(end_date <= current_date){
            
            // console.log('end date = ' + end_date + ' <= current_date=' + current_date)
            alert('End date '+[end_date]+' should be after current_date '+[current_date])
            return false;

        }else{
            
            console.log('start date = ' + start_date + ' >= current_date=' + current_date)
            return true;
        
        }
        
    });

});
</script>

@endpush