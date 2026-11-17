<?php

function sendResponse($success,$message,$data = null)
{
    echo json_encode([
        "success" => $success,
        "message" => $message,
        "data" => $data
    ]);
    exit;
}
function getInput()
{
    $input = file_get_contents("php://input");
    return json_decode($input, true);
}
?>