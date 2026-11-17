<?php

include '../config/database.php';
include '../config/response.php';

$sql = "SELECT * FROM vehicles";
$result = mysqli_query($conn,$sql);

echo '<table border = "1" cellspacing = "2" cellpadding = "2">
        <tr>
            <td>ID</td>
            <td>Type</td>
            <td>Brand</td>
            <td>Seats</td>
            <td>Status</td>
            <td>Action</td>
            <td>Action</td>
            <td>Action</td>
        </tr>';

if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $id = $row["id"];
        $type = $row["type"];
        $brand = $row["brand"];
        $seats = $row["seats"];
        $status = $row["status"];

        echo '<tr>
                <td>'.$id.'</td>
                <td>'.$type.'</td>
                <td>'.$brand.'</td>
                <td>'.$seats.'</td>
                <td>'.$status.'</td>
                <td><a href="../admin/deleteVehicle.php?id='.$id.'"> Delete</a></td>
                <td><a href="../admin/editVehicles.php?id='.$id.'"> Edit</a></td>
                <td><a href="../admin/addVehicleDetails.php?id='.$id.'"> Add</a></td>
        </tr>';

    }
}

?>
