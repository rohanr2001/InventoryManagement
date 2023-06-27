<?php
include("database.php");

$mobileNo = $_POST['mobileNo'];
$orderType = $_POST['orderType'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($orderType == "storage") {
    $table = "storage_form";
} elseif ($orderType == "vehicle") {
    $table = "vehicle_form";
} else {
    echo "Please select the order type.";
    exit;
}

$sql = "SELECT * FROM $table WHERE contact_number='$mobileNo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: approved.html");
} else {
    header("Location: notApproved.html");
}

$conn->close();

?>
