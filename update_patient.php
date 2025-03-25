<?php
// update_patient.php
include('connection.php');

// Get patient data
if(isset($_GET['full_name'])) {
    $full_name = $_GET['full_name'];
    $sql = "SELECT * FROM patient WHERE full_name='$full_name'";
    $result = $conn->query($sql);
    $patient = $result->fetch_assoc();
}

// Update patient
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $original_name = $_POST['original_name'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    
    $sql = "UPDATE patient SET 
            full_name='$full_name', 
            email='$email', 
            age='$age', 
            address='$address', 
            phone_number='$phone' 
            WHERE full_name='$original_name'";
    
    if($conn->query($sql)) {
        echo "<script>alert('Patient updated!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Error updating patient');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Patient</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        h2 {
            color: #2c3e50;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #34495e;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background: #3498db;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }
        button:hover {
            background: #2980b9;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #3498db;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Patient Information</h2>
        
        <?php if($patient): ?>
        <form method="post">
            <input type="hidden" name="original_name" value="<?php echo $patient['full_name']; ?>">
            
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="full_name" value="<?php echo $patient['full_name']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $patient['email']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Age:</label>
                <input type="number" name="age" value="<?php echo $patient['age']; ?>">
            </div>
            
            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="address" value="<?php echo $patient['address']; ?>">
            </div>
            
            <div class="form-group">
                <label>Phone Number:</label>
                <input type="text" name="phone" value="<?php echo $patient['phone_number']; ?>">
            </div>
            
            <button type="submit">Update Patient</button>
            <a href="admin.php" class="back-link">← Back to Admin Panel</a>
        </form>
        <?php else: ?>
            <p>Patient not found.</p>
            <a href="admin.php" class="back-link">← Back to Admin Panel</a>
        <?php endif; ?>
    </div>
</body>
</html>