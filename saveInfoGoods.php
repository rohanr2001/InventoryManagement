<?php
// Connect to the MySQL database
$host = "localhost";
$username = "root";
$password = "";
$database = "inventory";

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$company_name = $_POST['company-name'];
$company_email = $_POST['company-email'];
$contact_number = $_POST['contact-number'];
$pickup_date = $_POST['pickup-date'];
$reason_for_storage = $_POST['reason-for-storage'];
$list_of_goods = $_POST['list-of-goods'];
$approx_space_needed = $_POST['approx-space-needed'];
$duration_of_storage = $_POST['duration-of-storage'];

// Define the SQL query to insert form data into the database
$sql = "INSERT INTO storage_form (company_name, company_email, contact_number, pickup_date, reason_for_storage, list_of_goods, approx_space_needed, duration_of_storage) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the SQL statement
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  die("Error: " . mysqli_error($conn));
}

// Bind the form data to the SQL statement
mysqli_stmt_bind_param($stmt, "ssssssss", $company_name, $company_email, $contact_number, $pickup_date, $reason_for_storage, $list_of_goods, $approx_space_needed, $duration_of_storage);

// Execute the SQL statement
if (mysqli_stmt_execute($stmt)) {
  header("Location: success.html"); // redirect to success.html
} else {
  echo "Error: " . mysqli_error($conn);
}

// Close the prepared statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);
?>
