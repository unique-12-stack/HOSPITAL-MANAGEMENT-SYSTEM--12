<?php
include('connection.php'); 

// Database connection
$conn = new mysqli('localhost', 'root', '', 'edoc');

// Check connection
if ($conn->connect_error) {
    die("Connection failed!");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Insert patient data
    $sql = "INSERT INTO patient (full_name, age, address, email, phone_number) 
            VALUES ('$full_name', '$age', '$address', '$email', '$phone_number')";

    $message = $conn->query($sql) ? "Patient added successfully!" : "Error adding patient!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add Patient</h2>

        <?php if (isset($message)) { ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php } ?>

        <form method="POST">
            <input type="text" class="form-control mb-3" name="full_name" placeholder="Full Name" required>
            
            <input type="number" class="form-control mb-3" name="age" placeholder="Age" required> 

            <textarea class="form-control mb-3" name="address" placeholder="Address" required></textarea>

            <input type="email" class="form-control mb-3" name="email" placeholder="Email" required>

            <input type="text" class="form-control mb-3" name="phone_number" placeholder="Phone Number" required>
            <button type="submit" class="btn btn-primary w-100">Add Patient</button>
        </form>
    </div>
</body>
</html>
