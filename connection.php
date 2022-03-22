<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "Project";

$connection = mysqli_connect($servername,$username,$password,$database);

if($connection){
    echo "Good";
}
else{
    echo "Bad";
}

?>