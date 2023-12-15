<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "pcshs");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["employee_id"])) {
        $employee_id = $_SESSION["employee_id"];
        $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $address = mysqli_real_escape_string($db, $_POST['address']);

        $update_query = "UPDATE faculty SET contact_no = '$contact_no', email = '$email', address = '$address' WHERE employee_id = '$employee_id'";
        $update_result = mysqli_query($db, $update_query);

        if ($update_result) {
            // Redirect back to the faculty profile page after successful update
            header("Location: faculty_profile.php");
            exit();
        } else {
            // Handle the case where the update query fails
            echo "Error updating record: " . mysqli_error($db);
            exit();
        }
    } else {
        // Redirect to login page if the faculty is not logged in
        header("location:faculty_login.php");
        exit();
    }
} else {
    // Redirect to the faculty profile page if the form is not submitted
    header("Location: faculty_profile.php");
    exit();
}
?>