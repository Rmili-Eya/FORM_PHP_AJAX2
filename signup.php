<?php

//associative array 
$response = array(
  'status' => 0,
  'message' =>'Form submition faiiled',
);
$uploadDir='uploads/';
$errorEmpty=false;
$errorEmail=false;

if(isset($_POST['firstname'])||isset($_POST['lastname'])||isset($_POST['email'])
||isset($_POST['password'])||isset($_POST['file'])){
    include 'config.php';

  
   //Get the submitted form data 
   $firstname =$_POST['firstname'];
   $lastname =$_POST['lastname'];
   $email =$_POST['email'];
   $password =$_POST['password'];
   $phone=$_POST['phone'];
   $tel=str_replace(['','.','-','(',')'],'',$phone);

 if (!empty($firstname) && !empty($lastname) && !empty($email) 
 && !empty($password) && !empty($_FILES['file']['name'])){
    // if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
    //  $response['message']='Invalid Email';
    //   $errorEmail=true; 
    // }

    if (!preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)){
      $response['message']='Invalid Email';
    }
    else if (!preg_match("/^[a-zA-Z]*$/",$firstname)||!preg_match("/^[a-zA-Z]*$/",$lastname)){
    $response['message']="Only letters  allowed";

    }else if (!preg_match('/^[0-9]{8,14}\z/', $tel)){

    $response['message']="INvalid phone number !";

    }
    
   else{
  //if the input fields and email are not empty 
  //and valid then we are going to upload the file 
       if ($errorEmpty==false && $errorEmail==false){
      
      $uploadStatus=1;

      //upload file 
      $uploadFile='';
      if(!empty($_FILES['file']['name'])){
          //file path info 
          $fileName=basename($_FILES['file']['name']);
          $targetFilePath=$uploadDir.$fileName;
          //$fileType=pathinfo($targetFilePath, PATHINFO_EXTENSION);
          //Check if file exists 
          if (file_exists($targetFilePath)){
              $response['message']="Sorry file already exists ! ";
              $uploadStatus=0;
          }else{
              //Check the file size 
             if ($_FILES['file']['size']>10000000){//500kb in bytes
                $response['message']="Sorry your file is too large! ";
                $uploadStatus=0;
             }else {
                 if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFilePath)){
                     $uploadFile=$fileName;
                     $uploadStatus=1;
                 }else{
                    $response['message']="Sorry an error occured ! ";
                    $uploadStatus=0;
                 }
             }
          }
      }if ($uploadStatus == 1){ 
       //encode the password with md5 php function 
       $hash=md5($password);

       $check ="SELECT * FROM user where email=$email";
       $result=mysqli_query($conn,$check);
       if (mysqli_num_rows($result)==1){
           $response['message']='Sorry ! Email already exists';
       }else{
           $query="INSERT INTO user (firstName,lastName,email,password,image) 
           VALUES ('$firstname','$lastname','$email','$password','$uploadFile') ";

           if (mysqli_query($conn,$query)){
            $response['message']='Data inserted successfully !';
            $response['status'] = 1;
           }
       }

   }
  }
 }
}
else{
    $response['message']='Empty !';
    $errorEmpty=true;
  
    }
           }
//encode response to json format 
echo json_encode($response);

?>