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
                            <div class="col-sm-5 col-xs-2" id="deposit_amount" value="{{$buyer->deposit_amount}}">
                                {{$buyer->deposit_amount}}
                            </div>
                            <!-- <div class="col-sm-2" id="edit"> <span class="glyphicon glyphicon-edit" class="btn btn-primary" id="btn-edit" style="color:#008CBA;"></span> </div> -->
                            <div class="col-sm-1 col-xs-3" id="edit">
                                <a href="#" class="btn btn-primary a-btn-slide-text" style="font-size:10px;" id="btn-edit">
                                    <span class="glyphicon glyphicon-edit" id="btn-glyphicon" aria-hidden="true" style="font-size:10px;"></span>
                                    <span style="font-size:10px;" id="btn-txt">Edit</span>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>

                            <!-- /.box-body -->
                            </input>
                            <!-- /.box -->

                        </div>

                    </div>
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
            user_id = user_id.replace('#', '');
            let editBtn = document.getElementById("btn-edit")
            let deposit_amount_elt = document.getElementById("deposit_amount")
            console.log(deposit_amount_elt)

            //create element that will show input
            let newElt = document.createElement("input")
            // newElt.classList.add('col-sm-5')
            newElt.setAttribute("id", "deposit_amount")
            newElt.setAttribute("name", "deposit_amount")
            newElt.setAttribute("type", "number")
            newElt.setAttribute("value", (deposit_amount_elt.innerHTML).replace(/\s/g, ''))
            // newElt.value = deposit_amount_elt.innerHTML

            newElt.classList.add('col-sm-3', 'col-xs-3')

            //create element that wil show update icon
            //Text element
            let newEditBtnTxt = document.createElement("span")
            newEditBtnTxt.style.fontSize = '10px'
            newEditBtnTxt.innerText = "Update"
            // newEditBtnTxt.setAttribute('id', 'update')
            newEditBtnTxt.setAttribute('type', 'submit')

            //Icon element
            let newEditBtnIcon = document.createElement("span")
            newEditBtnIcon.classList.add('glyphicon', 'glyphicon-check')
            newEditBtnIcon.style.fontSize = '10px'

            let title_deposit_amount = document.getElementById("title_deposit_amount")


            //Onclick to show input + wrap it by formElt
            editBtn.addEventListener("click", function() {

                //replace existing deposit_amount value by input field
                deposit_amount_elt.parentNode.replaceChild(newElt, deposit_amount_elt)

                //replace edit icon by validate one
                let EditBtnTxt = document.getElementById('btn-txt')
                EditBtnTxt.parentNode.replaceChild(newEditBtnTxt, EditBtnTxt)

                //Remove the event listener to enable the update on next event listener 
                this.removeEventListener('click', arguments.callee, false);
            });

            //Onclick to send input value
            newEditBtnTxt.addEventListener("click", function(e) {
                console.log("click on newEditBtnTxt")
                //Get form sublitted values
                let deposit_amount_val = document.getElementById("deposit_amount").value
                console.log("deposit_amount : " + deposit_amount_val)

                let api_url = ''
                if (window.location.hostname == 'auctions-webapp.herokuapp.com') {
                    api_url = 'https://auctions-webapp.herokuapp.com/api'
                    console.log(api_url)
                } else {
                    api_url = 'http://127.0.0.1/auction-app/public/api'
                    console.log(api_url)
                }

                window.axios.put(api_url + '/buyer/' + Number(user_id), {
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
                        deposit_amount_upt.classList.add('col-sm-5', 'col-xs-2')
                        deposit_amount_upt.value = deposit_amount_val
                        deposit_amount_upt.innerHTML = deposit_amount_val
                        newElt.parentNode.replaceChild(deposit_amount_upt, newElt)
                        //Put back the edit icon
                        let EditBtnBack = document.createElement("span")
                        EditBtnBack.classList.add('glyphicon', 'glyphicon-edit', 'col-sm-2')
                        EditBtnBack.style.fontSize = '10px'
                        EditBtnBack.style.color = '#008CBA'
                        newEditBtnTxt.innerText = 'Edit'
                        newEditBtnTxt.id = 'btn-txt'
                        newEditBtnTxt.removeAttribute('type')

                        newEditBtnIcon.parentNode.replaceChild(EditBtnBack, newEditBtnIcon)

                        //restore event listener on Edit btn 

                        editBtn.addEventListener("click", function() {})
                    });
            })
        }
    </script>


    @endpush

    @endsection