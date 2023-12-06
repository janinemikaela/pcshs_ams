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
                        <input type="text" id="qr-data" placeholder="Enter data">
    <button id="generate-qr">Generate QR Code</button>
    <div id="qrcode"></div>

    <script>
        const qrCodeDiv = document.getElementById('qrcode');
        const qrDataInput = document.getElementById('qr-data');
        const generateButton = document.getElementById('generate-qr');

        // Check if there is saved QR code data in local storage.
        const savedQRData = localStorage.getItem('savedQRData');

        if (savedQRData) {
            qrDataInput.value = savedQRData;
            generateQRCode(savedQRData);
            qrDataInput.disabled = true;
            generateButton.disabled = true;
        }

        generateButton.addEventListener('click', function () {
            const qrData = qrDataInput.value;
            generateQRCode(qrData);
            qrDataInput.disabled = true;
            generateButton.disabled = true;
        });

        function generateQRCode(data) {
            const qr = qrcode(0, 'L'); // Create a QR code instance with error correction level 'L'.
            qr.addData(data);
            qr.make();
            qrCodeDiv.innerHTML = qr.createImgTag();

            // Save the entered QR data to local storage for future visits.
            localStorage.setItem('savedQRData', data);
        }
    </script>
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
        </div>
        </div>
        </div>
    </section>

  </main><!-- End #main -->

  <script>
        document.getElementById('qr-form').addEventListener('submit', function (event) {
            event.preventDefault();
            const name = document.getElementById('name').value;
            const studentId = document.getElementById('student-id').value;
            const birthday = document.getElementById('birthday').value;
            const userData = `Name: ${name}\nStudent ID: ${studentId}\nBirthday: ${birthday}`;

            if (userData) {
                const qr = new QRious({
                    element: document.getElementById('qr-code'),
                    value: userData,
                    size: 200,
                });
            }
        });
    </script>

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