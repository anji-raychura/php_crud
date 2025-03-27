<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";

$conn = mysqli_connect($servername,$username,$password,$dbname);

if($conn)
{
 // echo "Connection Done <br>";
}
else
{
    echo "connection Failed".mysqli_connect_error();
}
?>