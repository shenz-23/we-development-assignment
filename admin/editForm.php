<?php

include 'config/database.php';

$id = $_GET['id'];

$sql = "SELECT * FROM veicles WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<form action="editVehicles.php?id=<?php echo $id; ?>" method="POST">

Type:
<input type="text" name="type" value="<?php echo $row['type']; ?>">
<br><br>

Brand:
<input type="text" name="brand" value="<?php echo $row['brand']; ?>">
<br><br>

Seats:
<input type="text" name="seats" value="<?php echo $row['seats']; ?>">
<br><br>

Status:
<input type="text" name="status" value="<?php echo $row['status']; ?>">
<br><br>

<input type="submit" name="update" value="Update">

</form>