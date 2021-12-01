<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>NadeSoft Task</title>
    <link   href="{{asset('assets/css/style.css')}}"  rel="stylesheet" type="text/css" >
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dropzone.css') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/dropzone.js') }}"></script>
    <style>
        .dropzoneDragArea {
            background-color: #fbfdff;
            border: 1px dashed #c0ccda;
            border-radius: 6px;
            padding: 60px;
            text-align: center;
            margin-bottom: 15px;
            cursor: pointer;
        }
        .dropzone{
            box-shadow: 0px 2px 20px 0px #f2f2f2;
            border-radius: 10px;
        }
        .error{
            outline: 1px solid red;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row pt-5">
        <div class="col-lg-6">
            <div class="logo"></div>
        </div>
        <div class="col-lg-6">
            <img src="{{asset('assets/images/Group 1813.svg')}}" alt="" class="side pull-right">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center">Nadosft -Cutomer Support Form</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12" id="topbar">
            <div class="mx-auto d-block center-image"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h2 class="text-center please pt-5">Please fill the form below:</h2>
        </div>
    </div>
    <div id="top" style="display: none">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong> Thank you, </strong>your details have been successfully registered.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
    <form action="{{ route('form.data') }}" name="demoform" id="demoform" method="POST" class="dropzone row pt-5" enctype="multipart/form-data">
        @csrf
        <input type="hidden" class="userid" name="userid" id="userid" value="">

        <div class="col-lg-3">
            <label for="firstName" class="text-bold label-new" id="fname-label">Reporter Name <span class="text-success">*</span></label>
            <input type="text" class="form-control h-150 " id="fname" name="fname" placeholder="First name" value="{{ old('fname') }}">
            <span class="text-danger" id="fname-error"></span>
        </div>
        <div class="col-lg-3">
            <label for="lastName" class="text-bold label-new opacity-"  id="lname-label">Last Name</label>
            <input type="text" class="form-control h-150" id="lname" name="lname" placeholder="Last name" value="{{ old('lname') }}">
            <span class="text-danger" id="lname-error"></span>
        </div>


        <div class="col-lg-6 ">
            <label for="email" class="text-bold label-new">Email <span class="text-success">*</span></label>
            <input type="text" class="form-control h-150" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}">
            <span class="text-danger" id="email-error"></span>
        </div>

        <div class="col-lg-6 pt-4">
            <label for="phone" class="text-bold label-new">Phone Number <span class="text-success">*</span></label>
            <input type="text" class="form-control h-150" id="phone" name="phone" placeholder="Please fill your mobile number for contact" value="{{ old('phone') }}">
            <span class="text-danger" id="phone-error"></span>
        </div>
        <div class="col-lg-6 pt-4">
            <label for="project" class="text-bold label-new">Project <span class="text-success">*</span></label>
            <input type="text" class="form-control h-150" id="project" name="project" placeholder="Enter the title of your project and domain name (if there is)" value="{{ old('project') }}">
            <span class="text-danger" id="project-error"></span>
        </div>
        <div class="col-lg-12 pt-4">
            <label for="email" class="text-bold label-new">Classification <span class="text-success">*</span></label>
        </div>
        <div class="col-lg-6 radio">
            <div class="form-control h-150">
                <label class="pl-5 pt-2"> Bug Fix
                    <input type="radio" name="classification" value="Bug Fix">
                    <span class="checkmark"></span>
                </label>

            </div>

        </div>
        <div class="col-lg-6 radio">
            <div class="form-control h-150">
                <label class="pl-5 pt-2"> New Requirement
                    <input type="radio" name="classification" value="New Requirement">
                    <span class="checkmark"></span>
                </label>

            </div>

        </div>
        <div class="col-lg-12">
            <span class="text-danger" id="classification-error"></span>
        </div>
        <div class="col-lg-12 pt-5">
            <label for="issue" class="text-bold label-new"> Issue Tittle  <span class="text-success">*</span></label>
            <input type="text" class="form-control h-150" id="issue" name="issue" placeholder="Fill The Summary of the issue" value="{{ old('issue') }}">
            <span class="text-danger" id="issue-error"></span>
        </div>
        <div class="col-lg-12 pt-5 rel">
            <label for="description" class="text-bold label-new"> Issue Tittle  <span class="text-success">*</span></label>
            <small class="text-right load">0/200</small>
            <textarea class="form-control" id="description" rows="5" name="description" placeholder="Describe in details your issue" value="{{ old('description') }}"></textarea>
            <span class="text-danger" id="description-error"></span>
        </div>
        <div class="col-lg-12 pt-4">
            <label for="email" class="text-bold label-new">Priority <span class="text-success">*</span></label>
            <h6 >The emergency level</h6>
        </div>
        <div class="col-lg-4 radio">
            <div class="form-control h-150 ">
                <label class="pl-5 pt-2"> Low
                    <input type="radio" name="priority" value="Low">

                    <span class="checkmark"></span>
                </label>
            </div>
        </div>
        <div class="col-lg-4 radio">
            <div class="form-control h-150">
                <label class="pl-5 pt-2"> Medium
                    <input type="radio" name="priority" value="Medium">
                    <span class="checkmark"></span>
                </label>
            </div>

        </div>
        <div class="col-lg-4 radio">
            <div class="form-control h-150">
                <label class="pl-5 pt-2"> High
                    <input type="radio" name="priority" value="High">
                    <span class="checkmark"></span>
                </label>
            </div>

        </div>
        <div class="col-lg-12">
            <span class="text-danger" id="priority-error"></span>
        </div>
        <div class="col-lg-12 pt-4">
            <label for="email" class="text-bold label-new">Add ScreenShots <span class="text-success">*</span></label>
        </div>
        <div class="col-lg-12">
            <div id="dropzoneDragArea" class="dz-default dz-message dropzoneDragArea">
                <span>Upload file</span>
            </div>
            <div class="dropzone-previews"></div>
        </div>

        <div class="col-lg-12">
            <input type="hidden" name="screan" id="screan">
            <span class="text-danger" id="screan-error"></span>
        </div>
        <div class="col-lg-12  text-center">
            <div class="form-group text-center">
                <button class="pl-5 pr-5 pt-2 pb-2 rounded-pill  bg-success text-white ">Submit</button>
            </div>
        </div>
    </form>

</div>
<div class="container-fluid m-0 p-0">
    <div class="footer text-center pt-4">
        <h5 class="text-white">All Rights Reserved - Nadsoft © 2021</h5>
    </div>
</div>
<!-- Adding a script for dropzone -->
<script>
    Dropzone.autoDiscover = false;
    // Dropzone.options.demoform = false;
    let token = $('meta[name="csrf-token"]').attr('content');
    $(function() {
        var myDropzone = new Dropzone("div#dropzoneDragArea", {
            paramName: "file",
            url: "{{ url('/storeimgae') }}",
            previewsContainer: 'div.dropzone-previews',
            addRemoveLinks: true,
            autoProcessQueue: false,
            parallelUploads:10,
            uploadMultiple:true,
            params: {
                _token: token
            },
            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;

                //form submission code goes here
                $("form[name='demoform']").submit(function(event) {
                    //Make sure that the form isn't actully being sent.
                    event.preventDefault();
                    if(myDropzone.files.length > 0){
                        $('#screan').val(myDropzone.files.length);
                    }else{
                        $('#screan').val(null);
                    }

                    URL = $("#demoform").attr('action');
                    formData = $('#demoform').serialize();
                    $( '#screan-error' ).html(" ");
                    $( '#fname-error' ).html(" ");
                    $( '#lname-error' ).html(" ");
                    $( '#email-error' ).html(" ");
                    $( '#phone-error' ).html(" ");
                    $( '#project-error' ).html(" ");
                    $( '#classification-error' ).html(" ");
                    $( '#issue-error' ).html(" ");
                    $( '#description-error' ).html(" ");
                    $( '#priority-error' ).html(" ");
                    $.ajax({
                        type: 'POST',
                        url: URL,
                        data: formData,
                        success: function(result){
                            if(result.errors){
                                if(result.errors.screan){
                                    $( '#screan-error' ).html( result.errors.screan[0] );
                                }
                                if(result.errors.priority){
                                    $( '#priority-error' ).html( result.errors.priority[0] );
                                }
                                if(result.errors.description){
                                    $( '#description-error' ).html( result.errors.description[0] );
                                }
                                if(result.errors.issue){
                                    $( '#issue-error' ).html( result.errors.issue[0] );
                                }
                                if(result.errors.classification){
                                    $( '#classification-error' ).html( result.errors.classification[0] );
                                }

                                if(result.errors.project){
                                    $( '#project-error' ).html( result.errors.project[0] );
                                }
                                if(result.errors.phone){
                                    $( '#phone-error' ).html( result.errors.phone[0] );
                                }
                                if(result.errors.email){
                                    $( '#email-error' ).html( result.errors.email[0] );
                                }
                                if(result.errors.lname){
                                    $( '#lname-error' ).html( result.errors.lname[0] );
                                }
                                if(result.errors.fname){
                                    $( '#fname-error' ).html( result.errors.fname[0] );
                                }
                                scrollTo('#'+result.first+'-error')
                            }
                            if(result.status == "success"){
                                // fetch the useid
                                var userid = result.user_id;
                                $("#userid").val(userid); // inseting userid into hidden input field
                                //process the queue
                                $('#top').css('display','block');
                                $('html, body').animate({
                                    scrollTop: $("#topbar").offset().top
                                }, 1500);
                                myDropzone.processQueue();

                            }else{
                                console.log("error");
                            }
                        }
                    });
                });

                //Gets triggered when we submit the image.
                this.on('sending', function(file, xhr, formData){
                    //fetch the user id from hidden input field and send that userid with our image
                    let userid = document.getElementById('userid').value;
                    formData.append('userid', userid);
                });

                this.on("success", function (file, response) {
                    //reset the form
                    $('#demoform')[0].reset();
                    //reset dropzone
                    $('.dropzone-previews').empty();
                });

                this.on("queuecomplete", function () {

                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });

                this.on("successmultiple", function(files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });

                this.on("errormultiple", function(files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });
            }
        });
    });
    $('#demoform input[type="text"]').blur(function(){
        if(!$(this).val()){
            $(this).addClass("error");
        } else{
            $(this).removeClass("error");
        }
    });
    function scrollTo(id){
        $('html, body').animate({
            scrollTop: $(id).offset().top -100
        }, 1000);
    }
</script>

</body>
</html>
