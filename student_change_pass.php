
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Student - Change Password</title>
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

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <i class="bi bi-list toggle-sidebar-btn"></i>

    <div class="d-flex align-items-center justify-content-between">
      <a href="faculty_profile.php" class="logo d-flex align-items-center">
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
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12 col-md-6">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title">Change Password</h5>
                  </div>
                  <div class="phppot-container tile-container">
                    <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
                      <div class="mb-3">
                        <label for="currentPassword" class="form-label">Current Password*</label>
                        <div class="input-group">
                          <input type="password" name="currentPassword" class="form-control" id="currentPassword" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*_?&])[A-Za-z\d@$!%*_?&]{10}$" title="Password must be exactly 10 characters long, contain one uppercase, one lowercase, a special character, and a number" required>
                          <span class="input-group-text toggle-password" onclick="togglePassword('currentPassword')">
                            <i class="bi bi-eye"></i>
                          </span>
                        </div>
                        <span id="currentPassword" class="validation-message"></span>
                      </div>
                      <div class="mb-3">
                        <label for="newPassword" class="form-label">New Password*</label>
                        <div class="input-group">
                          <input type="password" name="newPassword" class="form-control" id="newPassword" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*_?&])[A-Za-z\d@$!%*_?&]{10}$" title="Password must be exactly 10 characters long, contain one uppercase, one lowercase, a special character, and a number" required>
                          <span class="input-group-text toggle-password" onclick="togglePassword('newPassword')">
                            <i class="bi bi-eye"></i>
                          </span>
                        </div>
                        <span id="newPassword" class="validation-message"></span>
                      </div>
                      <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password*</label>
                        <div class="input-group">
                          <input type="password" name="confirmPassword" class="form-control" id="confirmPassword" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*_?&])[A-Za-z\d@$!%*_?&]{10}$" title="Password must be exactly 10 characters long, contain one uppercase, one lowercase, a special character, and a number" required>
                          <span class="input-group-text toggle-password" onclick="togglePassword('confirmPassword')">
                            <i class="bi bi-eye"></i>
                          </span>
                        </div>
                        <span id="confirmPassword" class="validation-message"></span>
                      </div>
                      <center>
                        <div class="mb-3">
                          <input type="submit" name="submit" value="Update Password" class="btn btn-primary">
                        </div>
                      </center>
                    </form>
                  </div>
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

   <script>
    $(document).ready(function() {
      $('#studentsTable').DataTable();
    });

    function togglePassword(elementId) {
      var passwordInput = document.getElementById(elementId);
      var icon = passwordInput.parentElement.querySelector('.toggle-password i');
      if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
      } else {
        passwordInput.type = "password";
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
      }
    }
  </script>
  
</body>

</html>
