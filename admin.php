<?php
$user = 'root';
$password = '';
$database = 'edoc';
$servername = 'localhost';
$mysqli = new mysqli($servername, $user, $password, $database);

if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$sql_doctor = "SELECT * FROM doctor";
$result_doctor = $mysqli->query($sql_doctor);

$sql_patient = "SELECT * FROM patient";
$result_patient = $mysqli->query($sql_patient);

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        table {
            margin: 20px auto;
            font-size: large;
            width: 80%;
            border-collapse: collapse;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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
        h1 {
            text-align: center;
            color: #006600;
            font-size: xx-large;
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', 'sans-serif';
        }
        th, td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        td {
            background-color: #f9f9f9;
            transition: background-color 0.2s;
        }
        tr:hover td {
            background-color: #f1f1f1;
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
            background-color: #2196F3;
        }
        .edit-btn:hover {
            background-color: #0b7dda;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
    <section>
        <h1>MedCare Doctors</h1>
        <table>
            <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Address</th>
                <th>Specialties</th>
                <th>Update/Delete</th>
            </tr>
            <?php while ($row = $result_doctor->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['docname']; ?></td>
                    <td><?php echo $row['docusername']; ?></td>
                    <td><?php echo $row['docemail']; ?></td>
                    <td><?php echo $row['docaddress']; ?></td>
                    <td><?php echo $row['specialities']; ?></td>
                    <td>
                        <a href="update.php?docusername=<?php echo urlencode($row['docusername']); ?>" class="btn edit-btn">Edit</a> ||
                        <a href="delete_doctor.php?docusername=<?php echo urlencode($row['docusername']); ?>" class="btn delete-btn" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>
    <div class="form-container">
        <a href="adddoc.php" class="add-button">Add Doctor</a>
    </div><br>
    
    <div class="form-container">
        <a href="add.php" class="add-button">Add Patient</a>
    </div>

    <section>
        <h1>MedCare Patient Data</h1>
        <table>
            <tr>
                <th>Full Name</th>
                <th>Email</th>
                <th>Age</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Update/Delete</th>
            </tr>
            <?php while ($row = $result_patient->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone_number']; ?></td>
                    <td>
                        <a href="update_patient.php?full_name=<?php echo urlencode($row['full_name']); ?>" class="btn edit-btn">Edit</a> ||
                        <a href="delete_patient_admin.php?full_name=<?php echo urlencode($row['full_name']); ?>" class="btn delete-btn" onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </section>
</body>
</html>