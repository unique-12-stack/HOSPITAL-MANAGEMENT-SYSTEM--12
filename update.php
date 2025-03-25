<?php
// update_doctor.php
include('connection.php');

// Get doctor data
if(isset($_GET['docusername'])) {
    $username = $_GET['docusername'];
    $sql = "SELECT * FROM doctor WHERE docusername='$username'";
    $result = $conn->query($sql);
    $doctor = $result->fetch_assoc();
}

// Update doctor
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $original_username = $_POST['original_username'];
    $docname = $_POST['docname'];
    $docusername = $_POST['docusername'];
    $docemail = $_POST['docemail'];
    $docaddress = $_POST['docaddress'];
    $specialities = $_POST['specialities'];
    
    $sql = "UPDATE doctor SET 
            docname='$docname', 
            docusername='$docusername', 
            docemail='$docemail', 
            docaddress='$docaddress', 
            specialities='$specialities' 
            WHERE docusername='$original_username'";
    
    if($conn->query($sql)) {
        echo "<script>alert('Doctor updated!'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('Error updating doctor');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Doctor</title>
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
            color: #333;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #45a049;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Doctor</h2>
        
        <?php if($doctor): ?>
        <form method="post">
            <input type="hidden" name="original_username" value="<?php echo $doctor['docusername']; ?>">
            
            <div class="form-group">
                <label>Full Name:</label>
                <input type="text" name="docname" value="<?php echo $doctor['docname']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="docusername" value="<?php echo $doctor['docusername']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="docemail" value="<?php echo $doctor['docemail']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Address:</label>
                <input type="text" name="docaddress" value="<?php echo $doctor['docaddress']; ?>">
            </div>
            
            <div class="form-group">
                <label>Specialties:</label>
                <input type="text" name="specialities" value="<?php echo $doctor['specialities']; ?>">
            </div>
            
            <button type="submit">Update Doctor</button>
        </form>
        <?php else: ?>
            <p>Doctor not found.</p>
        <?php endif; ?>
        
        <a href="admin.php" class="back-link">← Back to Admin</a>
    </div>
</body>
</html>