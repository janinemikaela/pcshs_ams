<?php
// Include the database connection file
require_once("connect.php");

$host = "localhost";
$username = "root";
$password = "";
$dbname = "pcshs";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the request method is POST and if the 'delete' parameter is set
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete'])) {
    $subjectToDelete = $_POST['delete'][0];

    // Your SQL query to delete the subject from the database
    $deleteQuery = "DELETE FROM 11_abm_1 WHERE subject = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $subjectToDelete);
        mysqli_stmt_execute($stmt);

        $affectedRows = mysqli_stmt_affected_rows($stmt);

        mysqli_stmt_close($stmt);

        if ($affectedRows > 0) {
            // Subject deleted successfully
            echo json_encode(['success' => true]);
        } else {
            // Subject not found or deletion failed
            echo json_encode(['success' => false, 'message' => 'Subject not found or deletion failed.']);
        }
    } else {
        // Error in preparing the SQL statement
        echo json_encode(['success' => false, 'message' => 'Error preparing the SQL statement.']);
    }
} else {
    // Invalid request
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

// Close the database connection
mysqli_close($conn);
?>