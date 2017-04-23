<?php
header('Content-Type: application/json');

$SUPERSECRETKEY = "abc123";

if($_GET["key"] !== $SUPERSECRETKEY) {
    echo json_encode(array("status" => "error", "error" => "unauthorized"));
    return;
}

$target = "./" . basename($_FILES["file"]["name"]);


if (file_exists($target_file)) {
    echo json_encode(array("status" => "error", "error" => "file exists already"));
    return;
}

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target)) {
    echo json_encode(array("status" => "ok", "url" => "http://" . $_SERVER['SERVER_NAME'] . dirname($_SERVER['REQUEST_URI']) . $_FILES["file"]["name"])); // http because WPF hates https for a reason
} else {
    echo json_encode(array("status" => "error", "error" => "file upload error, check your server"));
}