<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" href="./style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

</head>
<body>
<div class="container d-flex justify-content-center align-items-center height">
    <div class="card py-3">
        <div class="p-3 d-flex align-items-center justify-content-center">
            <h5>Formulaire</h5>
        </div>
        <form id='form' method="POST" action="signup.php" enctype="multipart/form-data" class="p-3 px-4 py-2" autocomplete="off"> 
            <div class="row">
            <div class="col-md-6">
            <span  class="font-weight-normal quote">First Name</span> 
            <input id="first-name" name='firstname' type="text" class="form-control mb-2" placeholder="your first name" /> 
            </div>    
            <div class="col-md-6">
            <span  class="font-weight-normal quote">Last Name</span> 
            <input id="last-name" type="text" name='lastname' class="form-control mb-2" placeholder="your last name" /> 
            </div>
            </div>
            <span class="font-weight-normal quote">Phone Number</span> 
            <input id="phone" name='phone' type="text" class="form-control mb-2" placeholder="your phone number" />
            <span class="font-weight-normal quote">Mail</span> 
            <input id="mail-email" name='email' type="text" class="form-control mb-2" placeholder="your email address" />
            <span class="font-weight-normal quote">Password</span> 
            <input id="password" name='password' type="password" class="form-control mb-2" placeholder="Your password " />
             <span class="font-weight-normal quote">Message</span>
            <div class="form"> 
                <input id="file"  type="file" name='file'  class="form-control mb-3 description-area" >
                </input> 
            </div>
            <div class="text-right">
                 <button id="mail-submit" type="submit" class="btn btn-danger send">Send Message</button> 
            </div>
        </form>
        <p id="form-message"></p>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
    $('#form').on('submit',function(e){
    e.preventDefault();
    $.ajax({
        type:"POST",
        url:"signup.php",
        data:new FormData(this),
        dataType:"json",
        contentType:false,
        cache:false,
        processData:false,
        success:function(res){
        $('#form-message').css("display","block");

        //When the form is submitted it means equal to 1
        if (res.status==1){
        $('#form')[0].reset(); //resets the form 
        $('#form-message').html('<p>' + res.message + '</p>');
        toastr.success(res.message) ;
        }else{
        //error message will be shown 
    
        $('#form-message').html('<p>' + res.message + '</p>'); 
        toastr.warning(res.message) ;



        }   
        }

    })
    })
    })
    //File validation 

    $('#file').change(function(){
        var file =this.files[0]; 
        //files create a list of files ,
        // here we are selecting the first file 
        var fileType=file.type;
        var match=['image/jpeg','image/jpg','image/png'];
        if (!((fileType == match[0])|| (fileType == match[1])|| (fileType == match[2]))){
         alert("Sorry , only JPEG,JPG,PNG are allowed to upload !");
         $('#file').val('');
         return false; 
        }

    })

</script>
</body>
</html>