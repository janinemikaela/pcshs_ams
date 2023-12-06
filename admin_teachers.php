  <?php
  // Include the database connection file
  require_once("connect.php");

  // Handle delete operation
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_btn'])) {
      $deleteId = mysqli_real_escape_string($mysqli, $_POST['delete_id']);

      // Perform the delete query
      $deleteResult = mysqli_query($mysqli, "DELETE FROM faculty WHERE employee_id = '$deleteId'");

      if ($deleteResult) {
          echo "<p><font color='green'>Row deleted successfully!</font></p>";
      } else {
          echo "<p><font color='red'>Error deleting row: " . mysqli_error($mysqli) . "</font></p>";
      }
  }

  // Handle section assignment
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_section_btn'])) {
      $teacherId = mysqli_real_escape_string($mysqli, $_POST['teacher_id']);
      $selectedSection = mysqli_real_escape_string($mysqli, $_POST['section']);

      // Perform the update query to assign the section
      $updateResult = mysqli_query($mysqli, "UPDATE faculty SET assigned_section = '$selectedSection' WHERE employee_id = '$teacherId'");

      if ($updateResult) {
          echo "<p><font color='green'>Section assigned successfully!</font></p>";
      } else {
          echo "<p><font color='red'>Error assigning section: " . mysqli_error($mysqli) . "</font></p>";
      }
  }

  // Fetch data from the database
  $result = mysqli_query($mysqli, "SELECT * FROM faculty");

  // HTML starts here
  ?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Admin - Teachers</title>
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
          <div class="container">
              <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                  <div class="container">
                      <div class="row justify-content-center">
                          <div class="col-lg-12 col-md-6">
                              <div class="card mb-3">
                                  <div class="card-body">
                                      <div class="pt-4 pb-2">
                                          <h5 class="card-title">List of Teachers</h5>
                                      </div>
                                      <table class="table datatable">
                                          <thead>
                                              <tr>
                                                  <th scope="col">#</th>
                                                  <th scope="col">Employee ID</th>
                                                  <th scope="col">Name of Teacher</th>
                                                  <th scope="col">Contact no.</th>
                                                  <th scope="col">Birthday</th>
                                                  <th scope="col">Sex</th>
                                                  <th scope="col">Option</th> <!-- Added column for section assignment -->
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                            $count = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                              echo "<tr>";
                                              echo "<th scope='row'>" . $count . "</th>";
                                              echo "<td>" . $row['employee_id'] . "</td>";
                                              echo "<td>" . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . "</td>";
                                              echo "<td>" . $row['contact_no'] . "</td>";
                                              echo "<td>" . $row['birthday'] . "</td>";
                                              echo "<td>" . $row['sex'] . "</td>";

                                              echo "<td>
                                                <form method='post' action='admin_teachers.php'>
                                                <input type='hidden' name='delete_id' value='" . $row['employee_id'] . "'>
                                                <button type='submit' class='btn btn-danger' name='delete_btn'>Delete</button>
                                                </form>
                                              </td>";

                                              echo "</tr>";
                                              $count++;
                                            }
                                          ?>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </section>
          </div>
      </main><!-- End #main --> 

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
      <div class="copyright">
        &copy; Copyright <strong><span>PCSHS</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </footer><!-- End Footer -->

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