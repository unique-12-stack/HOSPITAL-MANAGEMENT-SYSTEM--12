

<?php
include('connection.php');

if (isset($_GET['full_name'])) {
    $full_name = $_GET['full_name'];
    
    // Delete query
    $sql = "DELETE FROM patient WHERE full_name = '$full_name'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Patient deleted successfully');
                window.location.href='admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting Patient');
                window.location.href='admin.php';
              </script>";
    }
    
    $conn->close();
} else {
    echo "<script>
            alert('No username provided');
            window.location.href='admin.php';
          </script>";
}
?>