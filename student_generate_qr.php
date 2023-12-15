<?php
session_start();
// Connect to the database
$db = mysqli_connect("localhost", "root", "", "pcshs");

// Check if the user is logged in
if (isset($_SESSION["student_id"])) {
    // Fetch student information from the database
    $student_id = $_SESSION['student_id'];
    $query = "SELECT last_name, first_name, middle_name FROM students WHERE student_id = '$student_id'";
    $result = mysqli_query($db, $query);
    
    // Check if the query was successful
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $last_name = strtoupper($row['last_name']);
        $first_name = strtoupper($row['first_name']);
        $middle_name = strtoupper($row['middle_name']);
    } else {
        // Handle the case where the query fails
        // You might want to redirect or show an error message
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Student - QR Code</title>
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
  <script src="https://cdn.rawgit.com/neocotic/qrious/master/dist/qrious.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/qrcode-generator/qrcode.js"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <i class="bi bi-list toggle-sidebar-btn"></i>

    <div class="d-flex align-items-center justify-content-between">
      <a href="student_home.php" class="logo d-flex align-items-center">
        <img src="assets/img/pcshs_logo.jfif" alt="">
        <span class="d-none d-lg-block">PACITA COMPLEX SENIOR HIGH SCHOOL</span>
      </a>
    </div><!-- End Logo -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="student_home.php">
          <i class="bi bi-grid"></i>
          <span>Home</span>
        </a>
      </li><!-- End Home Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#components-nav" href="student_profile.php">
          <i class="bi bi-menu-button-wide"></i><span>Profile</span>
        </a>
        
      </li><!-- End Profile Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#forms-nav" href="student_attendance.php">
          <i class="bi bi-journal-text"></i><span>Attendance</span>
        </a>
      </li><!-- End Attendance Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#charts-nav" href="student_grades.php">
          <i class="bi bi-bar-chart"></i><span>Grades</span>
        </a>
      </li><!-- End Grades Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#icons-nav" href="student_generate_qr.php">
          <i class="bi bi-gem"></i><span>QR Code</span>
        </a>
      </li><!-- End QR Code Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#icons-nav" href="student_change_pass.php">
          <i class="bi bi-gem"></i><span>Change Password</span>
        </a>
      </li><!-- End Change Password Nav -->


      <li class="nav-item">
        <a class="nav-link" data-bs-target="#forms-nav" href="student_logout.php">
          <i class="bi bi-journal-text"></i><span>Logout</span>
        </a>
      </li><!-- End Logout Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?php echo "$last_name, $first_name $middle_name"; ?></h1>
        <nav>
          <ol class="breadcrumb">
            <a class="breadcrumb-item active" href="student_home.php"><?php echo $student_id; ?></a>
          </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

          <div class="col-lg-12">
            <div class="row"> 

            <div class="col-xxl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Generate QR Code</h5>

                      <form method="post" action="student_generate_qr.php" class="row g-3" onsubmit="return validatePassword()">
                      <div class="col-12">
                        <label><b>Name</label></b>
                        <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Juan Dela Cruz" required pattern="[A-Za-z\s]+" style="text-transform: capitalize;" autocomplete="off" title="It should not contain special characters and numbers.">
                        <div class="invalid-feedback">Please, enter your Last Name!</div>
                      </div>

                    <div class="col-12">
                      <label><b>Student ID</label></b>
                      <input type="text" name="student_id" class="form-control" placeholder="XXX-XXXXXXX-XXXX" id="student_id" pattern="^\d{3}-student-\d{4}$" required title="Please enter a valid student ID in the format: 001-student-2023" autocomplete="off" maxlength="16">
                      <div class="invalid-feedback">Please enter a valid Student ID!</div>
                    </div>

                    <div class="col-lg-12">
                      <label><b>Birthday</label></b>
                      <input type="date" name="birthday" class="form-control" placeholder="Birthday" id="birthday" required>
                      <div class="invalid-feedback">Please enter your birthday!</div><br>
                    </div>

                    <div class="col-12">
                      <div id="passwordError" class="text-danger"></div>
                      <button class="btn btn-primary w-100" type="submit" name="register_btn">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="student_login.php">Log in</a></p>
                    </div>

                  </form>
        </div>


        </div>
        
        </div>
      <div class="col-xxl-4 col-md-6">
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">QR Code</h5>
                        <div id="qr-code"></div>
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

</body>
  
</html>
<?php } else {header("location:student_login.php");} ?>