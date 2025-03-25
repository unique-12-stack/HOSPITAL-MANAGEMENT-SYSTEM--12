<?php
include 'connection.php'; 

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $fullname = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $department = isset($_POST['department']) ? trim($_POST['department']) : '';
    $date = isset($_POST['appointmentdate']) ? trim($_POST['appointmentdate']) : '';
    $timestamp = date('Y-m-d H:i:s'); 

    
    $sql = "INSERT INTO appointment (fullname, email, department, date) VALUES ('$fullname', '$email', '$department', '$date')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Appointment booked successfully!'); window.location.href = 'index.html';</script>";
    } else {
        echo "<script>alert('Database error: " . mysqli_error($conn) . "');</script>";
    }
}


mysqli_close($conn);
?>
