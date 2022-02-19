<?php
$SERVER_NAME="localhost";
$DB_NAME="ajaxForm";
$PASSWORD="";
$USER_NAME="root";

$conn=mysqli_connect($SERVER_NAME,$USER_NAME,$PASSWORD,$DB_NAME);
if (!$conn ){
    echo "connexion failed ";
    exit();
}
