<?php
// Database connection
$host = 'localhost';  // Change if needed
$username = 'root';  // Your database username
$password = '';  // Your database password
$dbname = 'edoc';

$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $docname = mysqli_real_escape_string($conn, $_POST['docname']);
    $docusername = mysqli_real_escape_string($conn, $_POST['docusername']);
    $docemail = mysqli_real_escape_string($conn, $_POST['docemail']);
    $password= mysqli_real_escape_string($conn, $_POST['password']);
    $docaddress = mysqli_real_escape_string($conn, $_POST['docaddress']);
    $specialities = mysqli_real_escape_string($conn, $_POST['specialities']);

    // Insert doctor data into the database
    $sql = "INSERT INTO doctor (docname, docusername, docemail, password, docaddress, specialities) 
            VALUES ('$docname','$docusername', '$docemail','$password', '$docaddress', '$specialities')";

    if (mysqli_query($conn, $sql)) {
        $success_message = "Doctor added successfully!";
    } else {
        $error_message = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor - QuantumCare Hospital</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Add Doctor</h2>

        <!-- Display success or error message -->
        <?php if (isset($success_message)) { ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php } elseif (isset($error_message)) { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>

        <!-- Doctor Form -->
        <form method="POST">
            <div class="mb-3">
                <label for="docname" class="form-label">Doctor Name</label>
                <input type="text" class="form-control" id="docname" name="docname" required>
            </div>
            <div class="mb-3">
                <label for="docusername" class="form-label">Doctor Username</label>
                <input type="text" class="form-control" id="docusername" name="docusername" required>
            </div>
            <div class="mb-3">
                <label for="docemail" class="form-label">Email</label>
                <input type="email" class="form-control" id="docemail" name="docemail" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Doctor Password</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="docaddress" class="form-label">Address</label>
                <textarea class="form-control" id="docaddress" name="docaddress" required></textarea>
            </div>
            <div class="mb-3">
                <label for="specialities" class="form-label">Specialities</label>
                <input type="text" class="form-control" id="specialities" name="specialities" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Doctor</button>
        </form>
    </div>
</body>
</html>