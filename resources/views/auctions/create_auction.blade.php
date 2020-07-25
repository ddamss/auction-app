@extends('layouts.app')

@section('content')

@push('styles')
<!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/> -->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css">

@endpush


<form action="{{route('auctions.store')}}" method="POST">
  @csrf
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
    <label for="start_date" class="col-2 col-form-label">Start date</label>
      <div class='input-group date' id='datetimepicker'>
        <input type='text' class="form-control" name="start_date">
        <span class="input-group-addon">
        <span class="glyphicon glyphicon-calendar"></span>
        </span>
      </div>
      
        <!-- <div class="col-10">
            <input class="form-control" type="datetime-local" id="start_date" name="start_date">
        </div> -->
    </div>

    <div class="form-group row">
    <label for="end_date" class="col-2 col-form-label">End date</label>
        <div class="col-10">
            <input class="form-control" type="datetime-local" id="end_date" name="end_date">
        </div>
    </div>

    <input type="hidden" name="sellerID" value="{{$seller->id}}"> 

  <button type="submit" class="btn btn-default">Submit</button>
</form>

@push('scripts')

<!-- 
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.js"></script> -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<script>

  $(function () {
    $('#datetimepicker').datetimepicker();
    });
</script>

@endpush

@endsection