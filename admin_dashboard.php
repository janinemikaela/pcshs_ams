<?php
// Include the database connection file
require_once("connect.php");

// Function to get counts
function getCount($mysqli, $table)
{
    $query = "SELECT COUNT(*) AS count FROM $table";
    $result = mysqli_query($mysqli, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    } else {
        return 0;
    }
}

// Get counts
$studentCount = getCount($mysqli, 'students');
$teacherCount = getCount($mysqli, 'faculty');
$attendanceCount = 4003; // Replace this with your actual query to get attendance count

// ... Your existing PHP code

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin - Dashboard</title>
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
      <a href="admin_dashboard.php" class="logo d-flex align-items-center">
        <img src="assets/img/pcshs_logo.jfif" alt="">
        <span class="d-none d-lg-block">PACITA COMPLEX SENIOR HIGH SCHOOL</span>
      </a>
    </div><!-- End Logo -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="admin_dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Students</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="admin_students.php">
              <i class="bi bi-circle"></i><span>All students</span>
            </a>
          </li>
          <li>
            <a href="11_archimedes.php">
              <i class="bi bi-circle"></i><span>11 - Archimedes</span>
            </a>
          </li>
          <li>
            <a href="11_bernoulli.php">
              <i class="bi bi-circle"></i><span>11 -  Bernoulli</span>
            </a>
          </li>
          <li>
            <a href="11_curie.php">
              <i class="bi bi-circle"></i><span>11 - Curie</span>
            </a>
          </li>
          <li>
            <a href="12_alcala.php">
              <i class="bi bi-circle"></i><span>12 - Alcala</span>
            </a>
          </li>
          <li>
            <a href="12_del_mundo.php">
              <i class="bi bi-circle"></i><span>12 - Del Mundo</span>
            </a>
          </li>
          <li>
            <a href="12_zara.php">
              <i class="bi bi-circle"></i><span>12 - Zara</span>
            </a>
          </li>
        </ul>
      </li><!-- End Students Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#forms-nav" href="admin_subjects.php">
          <i class="bi bi-journal-text"></i><span>Subjects</span>
        </a>
      </li><!-- End Subjects Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#icons-nav" href="admin_teachers.php">
          <i class="bi bi-gem"></i><span>Teachers</span>
        </a>
      </li><!-- End Teachers Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#forms-nav" href="admin_logout.php">
          <i class="bi bi-journal-text"></i><span>Logout</span>
        </a>
      </li><!-- End Logout Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Admin</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Students Card -->
  <div class="col-xxl-4 col-md-4">
    <div class="card info-card sales-card">

      <div class="card-body">
        <h5 class="card-title">Students <span>| Total count</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-group-line" style="color: #e1ad01;"></i>
          </div>
          <div class="ps-3">
            <h6><?php echo $studentCount; ?></h6>
            <span class="text-muted small pt-2 ps-1">students</span>
          </div>
        </div>
      </div>

    </div>
  </div><!-- End Students Card -->

  <!-- Teachers Card -->
  <div class="col-xxl-4 col-md-4">
    <div class="card info-card revenue-card">

      <div class="card-body">
        <h5 class="card-title">Teachers <span>| Total count</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-user-line" style="color: #e1ad01;"></i>
          </div>
          <div class="ps-3">
            <h6><?php echo $teacherCount; ?></h6>
            <span class="text-muted small pt-2 ps-1">teachers</span>
          </div>
        </div>
      </div>

    </div>
  </div><!-- End Teachers Card -->

  <!-- Attendance Card -->
  <div class="col-xxl-4 col-md-4">
    <div class="card info-card customers-card">

      <div class="card-body">
        <h5 class="card-title">Attendance <span>| This Year</span></h5>

        <div class="d-flex align-items-center">
          <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="ri-file-list-line" style="color: #e1ad01;"></i>
          </div>
          <div class="ps-3">
            <h6><?php echo $attendanceCount; ?></h6>
            <span class="text-muted small pt-2 ps-1">total attendance</span>
          </div>
        </div>

      </div>
    </div>

  </div><!-- End Attendance Card -->
          </div>
        </div>
        
            <!-- Reports -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Students Card/Left -->
          <div class="col-xxl-4 col-md-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>

                <div class="card-body">
                  <h5 class="card-title">Attendance</h5>

                  <!-- Attendance Chart -->
                  <canvas id="barChart" style="max-height: 400px;"></canvas>
                  <script>
                   document.addEventListener("DOMContentLoaded", () => {
                      new Chart(document.querySelector('#barChart'), {
                        type: 'bar',
                        data: {
                          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                         datasets: [{
                          label: 'Bar Chart',
                          data: [65, 59, 80, 81, 56, 55, 40],
                          backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                          ],
                          borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                           'rgb(201, 203, 207)'
                          ],
                         borderWidth: 1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                         }
                       }
                     }
                    });
                  });
                </script>
                <!-- End Attendance Chart -->
              </div>
            </div>
          </div>

            <!-- Student Chart -->
            <div class="col-12">
              <div class="card">

                <div class="filter">
                  <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                      <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                  </ul>
                </div>
              <div class="card-body">
                <h5 class="card-title">Student <span>| Per Academic Year</span></h5>

                  <!-- Line Chart -->
                  <canvas id="lineChart" style="max-height: 400px;"></canvas>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      new Chart(document.querySelector('#lineChart'), {
                        type: 'line',
                        data: {
                          labels: ['2021-2023', '2023-2024', '2024-2025', '2025-2026', '2026-2027', '2027-2028', '2028-2029'],
                          datasets: [{
                          label: 'Line Chart',
                          data: [65, 59, 80, 81, 56, 55, 40],
                          fill: false,
                          borderColor: 'rgb(75, 192, 192)',
                          tension: 0.1
                        }]
                      },
                      options: {
                        scales: {
                          y: {
                            beginAtZero: true
                          }
                        }
                     }
                    });
                  });
                </script>
                <!-- End Student CHart -->
             </div>
            </div>
          </div>
      </div>
    </section>

  </main><!-- End of main -->

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