<?php

include '../config/database.php';
$deleteId = $_GET['id'];

$sql = "DELETE FROM vehicles WHERE id='$deleteId'";

$result = mysqli_query($conn, $sql);
if($result == true){
    echo "Record has been deleted!";
}else{
    echo "Error : " .mysqli_error($conn);
}

?>