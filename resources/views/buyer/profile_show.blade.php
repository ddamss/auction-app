@extends('layouts.app')

@section('content')

@push('styles')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@endpush

@push('styles')
<style>
input.hidden {
    position: absolute;
    left: -9999px;
}

#profile-image1 {
    cursor: pointer;
  
     width: 100px;
    height: 100px;
	border:2px solid #03b1ce ;}
	.tital{ font-size:16px; font-weight:500;}
	 .bot-border{ border-bottom:1px #f8f8f8 solid;  margin:5px 0  5px 0}	
</style>

@endpush

@push('scripts')
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endpush

<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">       
        
        <div class="col-md-7 ">

    <div class="panel panel-default">
        <div class="panel-heading">  <h4 >User Profile</h4></div>
        <div class="panel-body">
        
        <div class="box box-info">
            
                <div class="box-body">
                        <div class="col-sm-6">
                        <div align="center"> <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> </div>          
                <br>
                </div>
                
                <div class="col-sm-6">
                <h4 style="color:#00b1b1;">{{$buyer->name}} </h4></span>
                <span><p>buyer profile</p></span>            
                </div>
        
                <div class="clearfix"></div>
                <hr style="margin:5px 0 5px 0;"> 

    <div class="col-sm-5 col-xs-6 tital " >Email</div><div class="col-sm-7"> {{$buyer->email}}</div>
    <div class="clearfix"></div>
    <div class="bot-border"></div>

    <div class="col-sm-5 col-xs-6 tital " >Deposit amount</div><div class="col-sm-7"> {{$buyer->deposit_amount}}</div>
    <div class="clearfix"></div>
    <div class="bot-border"></div>

                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            </div>

        </div> 
        <div style="display:inline-block;margin-left:10%;margin-right:50%;"><button type="button" class="btn btn-primary">Edit details</button></div>
        <div style="display:inline-block;"><button type="button" class="btn btn-danger">Delete account</button></div>
       

        </div>
</div>  
        
   </div>
</div>

@endsection