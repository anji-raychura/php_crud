<?php

include("connection.php");

$ID = $_GET['id'];

$delete_query = "DELETE FROM newdata WHERE ID='$ID'";
$data = mysqli_query($conn,$delete_query);

if($data)
{
    echo "Deleted Succesfully";
?>
<meta http-equiv = "refresh" content = "0; url =            
http://localhost:800/allfiles/Mantis-Bootstrap/Mantis-Bootstrap/dashboard/index.php"/>

<?php
}
else
{
    echo "not deleted";
}
?>