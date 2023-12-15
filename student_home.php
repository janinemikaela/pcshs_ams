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

  <title>Student - Home</title>
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

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Vision Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Vision</h5>
                    <span class="text-success small pt-1 fw-bold">We dream of Filipinos<br/>who passionately love their country<br/>and whose values and competencies<br/>enable them to realize their full potential<br/>and contribute meaningfully to building the nation.<br/><br/>As a learner-centered public institution,<br/>the Department of Education<br/>continuously improves itself<br/>to better serve its stakeholders.<br/><br/><br/>
                    </span>
                </div>
              </div>
            </div><!-- End Vision Card -->

            <!-- Mission Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Mission</h5>
                    <span class="text-success small pt-1 fw-bold">To protect and promote the right of every Filipino to quality, equitable, culture-based, and complete basic education where:<br/><br/>

                    Students learn in a child-friendly, gender-sensitive, safe, and motivating environment.
                    Teachers facilitate learning and constantly nurture every learner.<br/>
                    Administrators and staff, as stewards of the institution, ensure an enabling and supportive environment for effective learning to happen.<br/>
                    Family, community, and other stakeholders are actively engaged and share responsibility for developing life-long learners.
                    </span>
                </div>
              </div>
            </div><!-- End Mission Card -->
          </div>
        </div>

        <div class="col-lg-12">
          <div class="row">
            <!-- School Hymn Card -->
            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">School Hymn</h5>
                    <span class="text-success small pt-1 fw-bold">Verse I<br/>We honor thy alma mater<br/>Virtue and excellence<br/>Maroon and gold now forever<br/>Hail! Hail! It takes us further<br/><br/>Oh mother P-C-S-H-S<br/>Thy noble name<br/>Ye deserve honor and fame<br/><br/>Chorus<br/>Pacita Complex Senior High School<br/>Our beloved alma mater<br/>Hail! Hail! We pledge our loyalty<br/><br/>Ye train thy brains<br/>We break thy chains<br/>Feet are firm<br/>Reputation affirmed<br/><br/>Verse II<br/>In our needs ye are the answer<br/>We dream and build together<br/>Our hearts ye lit up flames<br/>Future and lives entrusted<br/><br/>Oh mother P-C-S-H-S<br/>Thy noble name<br/>Success is what we aim!<br/><br/>(repeat chorus)
                    </span>
                </div>
              </div>

            </div><!-- End School Hymn Card -->

            <div class="col-xxl-4 col-xl-6">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Core Values</h5>
                    <span class="text-success small pt-1 fw-bold">Maka-Diyos<br/>Maka-tao<br/>Makakalikasan<br/>Makabansa
                    </span>
                </div>
              </div>
            </div>

        </div><!-- End Left side columns -->

      </div>
    </section>

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