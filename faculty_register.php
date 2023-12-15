<?php
session_start();

// Connect to the database
$db = mysqli_connect("localhost", "root", "", "pcshs");

// Initialize session variables
$last_name_value = '';
$first_name_value = '';
$middle_name_value = '';
$birthday_value = '';
$sex_value = '';
$student_id_value = '';

// Handle registration
if (isset($_POST['register_btn'])) {
    $last_name = ucwords(strtolower(mysqli_real_escape_string($db, $_POST['last_name'])));
    $first_name = ucwords(strtolower(mysqli_real_escape_string($db, $_POST['first_name'])));
    $middle_name = ucwords(strtolower(mysqli_real_escape_string($db, $_POST['middle_name'])));
    $birthday = mysqli_real_escape_string($db, $_POST['birthday']);
    $sex = mysqli_real_escape_string($db, $_POST['sex']);
    $employee_id = mysqli_real_escape_string($db, $_POST['employee_id']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $con_password = mysqli_real_escape_string($db, $_POST['con_password']);

    // Check if the student_id already exists in the database
    $user_check_query = "SELECT * FROM faculty WHERE employee_id='$employee_id' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);

    if ($result === false) {
        die(mysqli_error($db)); // Display the database error if any
    }

    if (mysqli_num_rows($result) > 0) {
        // Set the error message in the session
        $_SESSION['message'] = "Employee ID already exists. Please choose a different Employee ID.";

        // Set the session variables with the user-entered data
        $_SESSION['last_name_value'] = $last_name;
        $_SESSION['first_name_value'] = $first_name;
        $_SESSION['middle_name_value'] = $middle_name;
        $_SESSION['birthday_value'] = $birthday;
        $_SESSION['sex_value'] = $sex;
        $_SESSION['employee_id_value'] = $employee_id;

        // Open the modal with JavaScript
        echo '<script language="javascript">';
        echo 'document.addEventListener("DOMContentLoaded", function() {';
        echo 'var modal = document.getElementById("errorModal");';
        echo 'modal.style.display = "block";';
        echo '});';
        echo '</script>';
    } else {
        if ($password == $con_password) {
            // Hash password before storing for security purposes
            $password = md5($password);

            // Insert user details into the database
            $sql = "INSERT INTO faculty (last_name, first_name, middle_name, employee_id, birthday, sex, password, con_password) VALUES ('$last_name', '$first_name', '$middle_name', '$employee_id', '$birthday', '$sex', '$password', '$con_password')";
            mysqli_query($db, $sql);

            $_SESSION['message'] = "Account successfully created!";
            $_SESSION['employee_id'] = $employee_id;

            // Open the success modal with JavaScript
            echo '<script language="javascript">';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo 'var successModal = document.getElementById("successModal");';
            echo 'successModal.style.display = "block";';
            echo '});';
            echo '</script>';

            // Redirect to home page after a short delay (adjust as needed)
            echo '<script>setTimeout(function(){ window.location.href = "faculty_profile.php"; }, 3000);</script>';
        } else {
            header("location:faculty_register.php");
            exit(); // Add exit to stop further execution
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Faculty - Sign Up</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/pcshs_logo.jfif" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <style>
         body {
        background-image: url("assets/img/pcshs_school.png");
        margin: 0; /* Add this line to remove the default margin */
    }

    .card {
        height: 100vh;
    background-color: #fff;
    margin: 0;
    padding: 0;
    }

    .card-body {
        padding: 2rem;
    }
    </style>
</head>

<body>

  <main>
    <div class="container-fluid">
            <div class="row">

                <!-- Left side content (with an image) -->
                <div class="col-lg-6 d-none d-lg-block">
                </div>

                <!-- Right side content -->
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h1 class="card-title text-center pb-0 fs-4">PCSHS</h1>
                    <p class="text-center small">Register an Account</p>
                  </div>

                  <form method="post" action="faculty_register.php" class="row g-3" onsubmit="return validatePassword()">
                    <div class="row">
                      <div class="col-12">
                      </div>
                      <div class="col-4">
                        <label><b>Last Name*</label></b>
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Dela Cruz" required pattern="[A-Za-z\s]+" style="text-transform: capitalize;" autocomplete="off" title="It should not contain special characters and numbers.">
                        <div class="invalid-feedback">Please, enter your Last Name!</div>
                      </div>
                      <div class="col-4">
                        <label><b>First Name*</label></b>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Juan" required pattern="[A-Za-z\s]+" style="text-transform: capitalize;" autocomplete="off" title="It should not contain special characters and numbers.">
                        <div class="invalid-feedback">Please, enter your First Name!</div>
                      </div>
                      <div class="col-4">
                        <label><b>Middle Name</label></b>
                        <input type="text" name="middle_name" class="form-control" id="middle_name" placeholder="Reyes" pattern="[A-Za-z\s]+" style="text-transform: capitalize;" autocomplete="off" title="It should not contain special characters and numbers.">
                        <div class="invalid-feedback">Please, enter your Middle Name!</div>
                      </div>
                    </div>

                    <div class="col-lg-6">
                      <label><b>Birthday*</label></b>
                      <input type="date" name="birthday" class="form-control" placeholder="Birthday" id="birthday" required>
                      <div class="invalid-feedback">Please enter your birthday!</div>
                    </div>

                    <div class="col-lg-6">
                      <label><b>Sex*</label></b>
                      <select name="sex" class="form-select" id="sex" required>
                        <option value="" disabled selected>Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                      <div class="invalid-feedback">Please select your sex!</div>
                    </div>

                    <div class="col-4">
                      <label><b>Employee ID*</label></b>
                      <input type="text" name="employee_id" class="form-control" placeholder="XXX-XXXXXXX-XXXX" id="employee_id" pattern="^\d{3}-faculty-\d{4}$" required title="Please enter a valid Employee ID in the format: 001-faculty-2023" autocomplete="off" maxlength="16">
                      <div class="invalid-feedback">Please enter a valid Employee ID!</div>
                    </div>

                    <div class="col-4">
                      <label><b>Password*</label></b>
                      <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*_?&])[A-Za-z\d@$!%*_?&]{10}$" title="Password must be exactly 10 characters long, contain one uppercase, one lowercase, a special character, and a number" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="bi bi-eye"></i></button>
                      </div>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-4">
                      <label><b>Confirm Password*</label></b>
                      <div class="input-group">
                        <input type="password" name="con_password" class="form-control" id="con_password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*_?&])[A-Za-z\d@$!%*_?&]{10}$" title="Password must be exactly 10 characters long, contain one uppercase, one lowercase, a special character, and a number" required>
                        <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword"><i class="bi bi-eye"></i></button>
                      </div>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>


                    <div class="col-12">
                      <div id="passwordError" class="text-danger"></div>
                      <button class="btn btn-primary w-100" type="submit" name="register_btn">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="student_login.php">Log in</a></p>
                    </div>

                    <div id="errorModal" class="modal">
                      <div class="modal-content">
                        <span class="close" onclick="document.getElementById('errorModal').style.display='none'">&times;</span>
                        <p><?php echo $_SESSION['message']; ?></p>
                      </div>
                    </div>

                    <script>
                      const togglePassword = document.getElementById('togglePassword');
                      const password = document.getElementById('password');

                      togglePassword.addEventListener('click', function () {
                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                        password.setAttribute('type', type);
                        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
                        });

                      const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
                      const confirmPassword = document.getElementById('con_password');

                      toggleConfirmPassword.addEventListener('click', function () {
                        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                        confirmPassword.setAttribute('type', type);
                        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
                        });

                      const form = document.querySelector('form');
                      form.addEventListener('submit', function (event) {
                        const passwordValue = password.value;
                        const confirmPasswordValue = confirmPassword.value;

                        if (passwordValue !== confirmPasswordValue) {
                        event.preventDefault(); // Prevent the form submission

                        // Set the error message
                        document.getElementById('passwordError').textContent = 'The two passwords do not match.';

                        // Add the is-invalid class to the input fields
                        password.classList.add('is-invalid');
                        confirmPassword.classList.add('is-invalid');
                        } else {
                          document.getElementById('passwordError').textContent = ''; // Clear the error message

                          // Remove the is-invalid class from the input fields
                          password.classList.remove('is-invalid');
                          confirmPassword.classList.remove('is-invalid');
                        }
                      });
                    </script>

                  </form>
                </div>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <div id="successModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="document.getElementById('successModal').style.display='none'">&times;</span>
    <p>Account successfully created!</p>
  </div>
</div>

</body>

</html> 