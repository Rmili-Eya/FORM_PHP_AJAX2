<?php
if (isset($_POST['submit'])){
$file=$_FILES['file'];
$fileName=$_FILES['file']['name'];
$fileSize=$_FILES['file']['size'];
$fileError=$_FILES['file']['error'];
$fileType=$_FILES['file']['type'];
$tmp_name=$_FILES['file']['tmp_name'];

$fileExt=explode('.',$fileName);//explode returns a array 
$fileActualExt=strtolower(end($fileExt));

$allowed=array('jpg','jpeg','png','pdf');
if (in_array($fileActualExt,$allowed)){

if ($fileError ===0){
    if ($fileSize<1000000){
    $fileNewName=uniqid('',true).".".$fileActualExt;
    $fileDestination='uploads/'.$fileNewName;
     move_uploaded_file($tmp_name,$fileDestination);
}else{
    echo 'your file is too big  !';

}
}else{
    echo 'there is an error uploading the file !';
}}

else{
    echo 'failure ';
}}


