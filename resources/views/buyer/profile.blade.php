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
        border: 2px solid #03b1ce;
    }

    .tital {
        font-size: 16px;
        font-weight: 500;
    }

    .bot-border {
        border-bottom: 1px #f8f8f8 solid;
        margin: 5px 0 5px 0
    }
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
                <div class="panel-heading">
                    <h4>User Profile</h4>
                </div>
                <div class="panel-body">

                    <div class="box box-info">

                        <div class="box-body">
                            <div class="col-sm-6">
                                <div align="center"> <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive"> </div>
                                <br>
                            </div>

                            <div class="col-sm-6">
                                <h4 style="color:#00b1b1;">{{$buyer->name}} </h4></span>
                                <span>
                                    <p>buyer profile</p>
                                </span>
                            </div>

                            <div class="clearfix"></div>
                            <hr style="margin:5px 0 5px 0;">

                            <div class="col-sm-5 col-xs-6 tital ">Email</div>
                            <div class="col-sm-7"> {{$buyer->email}}</div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                            <input id="access_token" type="hidden" value="{{$buyer->access_token}}">
                            <div class="col-sm-5 col-xs-6 tital " id="title_deposit_amount">Deposit amount</div>
                            <div class="col-sm-5" id="deposit_amount" value="{{$buyer->deposit_amount}}">
                                {{$buyer->deposit_amount}}</div>
                            <div class="col-sm-2" id="edit"> <span class="glyphicon glyphicon-edit" class="btn btn-primary" id="btn-edit"></span> </div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <!-- /.box-body -->
                            </input>
                            <!-- /.box -->

                        </div>

                    </div>
                    <div style="margin: auto;text-align: center;"><button type="button" class="btn btn-danger" id="delete">Delete account</button></div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')

    <script>
        window.onload = function(e) {

            let access_token = document.getElementById("access_token").value

            //Get user_id from URL
            let URL = window.location.href.split('/');
            let user_id = URL.pop() || URL.pop();
            let editBtn = document.getElementById("btn-edit")
            let deposit_amount_elt = document.getElementById("deposit_amount")

            //create element that will show input
            let newElt = document.createElement("input")
            // newElt.classList.add('col-sm-5')
            newElt.setAttribute("id", "deposit_amount")
            newElt.setAttribute("name", "deposit_amount")
            newElt.setAttribute("type", "number")
            newElt.value = deposit_amount_elt.innerHTML

            //Create form element
            let formElt = document.createElement("form")
            formElt.setAttribute('id', 'form1')
            newElt.classList.add('col-sm-5')

            //create element that wil show update icon
            let newEditBtn = document.createElement("span")
            newEditBtn.classList.add('glyphicon', 'glyphicon-check', 'col-sm-2')
            newEditBtn.setAttribute('id', 'update')
            newEditBtn.setAttribute('type', 'submit')
            let title_deposit_amount = document.getElementById("title_deposit_amount")

            //Onclick to show input + wrap it by formElt
            editBtn.addEventListener("click", function() {
                //replace existing deposit_amount value by input field
                deposit_amount_elt.parentNode.replaceChild(newElt, deposit_amount_elt)
                //replace edit icon by validate one
                editBtn.parentNode.replaceChild(newEditBtn, editBtn)
                newElt.parentNode.appendChild(formElt)
                formElt.appendChild(newElt)
                title_deposit_amount.parentNode.insertBefore(formElt, title_deposit_amount.nextSibling)
            });

            //Onclick to send input value
            newEditBtn.addEventListener("click", function(e) {
                //Get form sublitted values
                let deposit_amount_val = document.getElementById("form1").elements[0].value
                console.log("deposit_amount : " + deposit_amount_val)

                window.axios.put('https://auctions-webapp.herokuapp.com/api/buyer/' + Number(user_id), {
                        deposit_amount_val
                    }, {
                        headers: {
                            'Authorization': 'Bearer ' + access_token
                        }
                    })
                    .then((response) => {

                        console.log(response);
                        //Create div element to show with deposit_amount updated value
                        let deposit_amount_upt = document.createElement("div")
                        deposit_amount_upt.setAttribute('id', 'deposit_amount')
                        deposit_amount_upt.setAttribute('class', 'col-sm-5')
                        deposit_amount_upt.value = deposit_amount_val
                        deposit_amount_upt.innerHTML = deposit_amount_val
                        newElt.parentNode.replaceChild(deposit_amount_upt, newElt)
                        //Put back the edit icon
                        let EditBtn = document.createElement("span")
                        EditBtn.classList.add('glyphicon', 'glyphicon-edit', 'col-sm-2')
                        EditBtn.setAttribute('id', 'btn-edit')
                        newEditBtn.parentNode.replaceChild(EditBtn, newEditBtn)
                    });
            })
        }
    </script>


    @endpush

    @endsection