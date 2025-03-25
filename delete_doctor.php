<?php
include('connection.php');

if (isset($_GET['docusername'])) {
    $docusername = $_GET['docusername'];
    
    // Delete query
    $sql = "DELETE FROM doctor WHERE docusername = '$docusername'";
    
    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Doctor deleted successfully');
                window.location.href='admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting doctor');
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