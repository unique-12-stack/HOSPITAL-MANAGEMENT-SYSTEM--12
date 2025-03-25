<?php
// Connection settings
$user = 'root';
$password = '';
$database = 'edoc';
$servername = 'localhost';
$mysqli = new mysqli($servername, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// SQL query to select data from patient table
$sql_patient = "SELECT * FROM patient";
$result_patient = $mysqli->query($sql_patient);

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <style>
    
    table {
        margin: 20px auto;
        font-size: large;
        width: 80%;
        border-collapse: collapse; 
    }
    
    
    .appointments-table {
        margin: 20px auto;
        font-size: large;
        width: 80%;
        border-collapse: collapse; 
    }
    
    
    th, td {
        padding: 10px;
        text-align: center;
        border: 1px solid #333; 
    }
    
    th {
        background-color: #A0C49D;
        color: #333; 
    }
    
    td {
        background-color: #E4F5D4;
    }
    
    
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    .form-container {
        text-align: center;
        margin-bottom: 20px;
    }
    .add-button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
    }
    .add-button:hover {
        background-color: #45a049;
    }
    .btn {
        padding: 10px 15px;
        text-decoration: none;
        border-radius: 5px;
        color: white;
        font-weight: bold;
        text-align: center;
        display: inline-block;
        transition: background-color 0.3s ease;
    }
    .edit-btn {
        background-color: blue;
    }
    .edit-btn:hover {
        background-color: darkblue;
    }
    .delete-btn {
        background-color: red;
    }
    .delete-btn:hover {
        background-color: darkred;
    }
    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    </style>
</head>
<body>


<h2>Patients</h2>
<table>
    <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Age</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    <?php while ($row = $result_patient->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone_number']; ?></td>
            <td><a href="delete_patient_doc.php?full_name=<?php echo $row['full_name']; ?>" class="btn edit-btn">Delete</a></td>
            <td><a href="update_patient_doc.php?full_name=<?php echo $row['full_name']; ?>" class="btn delete-btn">Edit</a></td>
        </tr>
    <?php } ?>
</table>
<div class="form-container">
    <a href="add.php" class="add-button">Add Patient</a>
</div>



</body>
</html>
<?php
include 'connection.php'; // Database connection

// Query to fetch data from the appointment table
$sql = "SELECT * FROM appointment";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments List</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS file -->
</head>
<body>
    <div class="container">
        <h2>Appointments List</h2>
        <table class="appointments-table">
            <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Appointment Date</th>
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are any records and display them
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['fullname']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['department']}</td>
                                <td>{$row['date']}</td>
                                
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No appointments found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
