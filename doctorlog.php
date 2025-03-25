<?php
session_start();
include('connection.php'); 


$error_message = "";

if (isset($_POST['doctor'])) {
    $docusername = mysqli_real_escape_string($conn, $_POST['docusername']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    
    $query = "SELECT * FROM doctor WHERE docusername='$docusername'";
    $result = mysqli_query($conn, $query);
    $doctor = mysqli_fetch_assoc($result);


    if ($doctor && $password === $doctor['password']) { 
        $_SESSION['docusername'] = $doctor['docusername'];
        header("Location: doctor_dashboard.php");
        exit();
    } else {
        $error_message = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Login - MediCare Plus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <img src="https://images.unsplash.com/photo-1505751172876-fa1923c5c528?ixlib=rb-1.2.1&auto=format&fit=crop&w=50&h=50&q=80" alt="Logo" class="rounded-circle mb-3" width="60">
                            <h4 class="text-primary">Doctor Login</h4>
                        </div>
                        <form action="doctorlog.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="docusername" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                            <?php if ($error_message): ?>
                                <div class="alert alert-danger mt-3">
                                    <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>
                            <button type="submit" name="doctor" class="btn btn-primary w-100">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="index.html" class="text-decoration-none">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
