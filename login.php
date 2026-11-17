<?php
include 'config/database.php';
include 'config/response.php';


session_start();

//receive JSON data
$data = getInput();

$email = $data['email'];
$password = $data['password'];

//Check user in database
$sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0)
    {
        $user = mysqli_fetch_assoc($result);

        //Store user details in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        sendResponse(true, "Login successful", [
            "id" => $user['id'],
            "name" => $user['name'],
            "email" => $user['email'],
            "role" => $user['role'],
        ]);
    } else {
        sendResponse(false, "Invalid email or password");
    }

?>