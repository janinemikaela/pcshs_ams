<?php
session_start();

// Connect to the database
$db = mysqli_connect("localhost", "root", "", "pcshs");
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form is submitted with the login_btn
    if (isset($_POST['login_btn'])) {
        // Get user input from the submitted form
        $employee_id = mysqli_real_escape_string($db, $_POST['employee_id']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // Query to check if the user exists in the database
        $query = "SELECT * FROM faculty WHERE employee_id = '$employee_id'";
        $result = mysqli_query($db, $query);

        // Check if a matching faculty user is found
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch user data from the result
            $user = mysqli_fetch_assoc($result);

            // Verify password
            if (password_verify($password, $user['password'])) {
                // Set session variables for faculty
                $_SESSION['employee_id'] = $user['employee_id'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['middle_name'] = $user['middle_name'];
                $_SESSION['sex'] = $user['sex'];
                $_SESSION['birthday'] = $user['birthday'];
                $_SESSION['contact_no'] = $user['contact_no'];

                // Redirect to the faculty profile page
                header("Location: faculty_profile.php");
                exit();
            } else {
                // Invalid password, show an error message
                $errorMessage = "Invalid Password";
            }
        } else {
            // Invalid employee_id, show an error message
            $errorMessage = "Invalid Employee ID";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Faculty - Sign In</title>
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

</head>

<body style="background-color:#800000">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">PCSHS</h5>
                    <p class="text-center small">Faculty Module</p>
                  </div>

                  <form method="post" action="faculty_login.php" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <input type="text" name="employee_id" class="form-control" placeholder="Employee ID" id="employee_id" pattern="^\d{3}-faculty-\d{4}$" required title="Please enter a valid Employee ID in the format: 001-faculty-2023" autocomplete="off" maxlength="16">
                      <div class="invalid-feedback">Please enter a valid Employee ID!</div>
                    </div>

                    <div class="col-12">
                      <label><b>Password</label></b>
                      <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*_?&])[A-Za-z\d@$!%*_?&]{10}$" title="Password must be exactly 10 characters long, contain one uppercase, one lowercase, a special character, and a number" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="bi bi-eye"></i></button>
                      </div>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login_btn">Sign in</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Don't have account? <a href="faculty_register.php">Create an account</a></p>
                    </div>

                    <center>
                    <div class="col-12">
                      <a href="reset_pass.php"><u>Reset Password</a></u>
                    </div>
                    </center>

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
                    </script>
                    
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

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

   <?php
    if(isset($_SESSION['message']))
    {
         echo "<div id='error_msg'>".$_SESSION['message']."</div>";
         unset($_SESSION['message']);
    }
    ?>

</body>

</html>