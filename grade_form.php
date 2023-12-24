
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Grades</title>

    <script src="assets/vendor/tinymce/tinymce.min.js"></script>

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

    <script>
    // JavaScript remains unchanged
    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
</script>

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
        <a class="nav-link" data-bs-target="#forms-nav" href="faculty_profile.php">
          <i class="bi bi-journal-text"></i><span>Profile</span>
        </a>
      </li><!-- End Student Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#forms-nav" href="faculty_student.php">
          <i class="bi bi-journal-text"></i><span>Students</span>
        </a>
      </li><!-- End Subjects Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#icons-nav" href="faculty_change_pass.php">
          <i class="bi bi-gem"></i><span>Change Password</span>
        </a>
      </li><!-- End Teachers Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#forms-nav" href="faculty_logout.php">
          <i class="bi bi-journal-text"></i><span>Logout</span>
        </a>
      </li><!-- End Logout Nav -->
    </ul>

  </aside><!-- End Sidebar-->

    <main id="main" class="main">
      <div class="container">

    <section class="section">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-12 col-md-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- Default Table -->
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateForm();">
                                        <table id="subjectTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Teacher</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Assuming $studentSection contains the student's section information
                                                $studentSection = "11_archimedes"; // Replace this with actual section data

                                                // Fetch data based on the student's section
                                                if ($studentSection == "11_archimedes" || $studentSection == "11_bernoulli") {
                                                    $table1 = "11_stem_1";
                                                    $table2 = "11_stem_2";
                                                } elseif ($studentSection == "11_ramos" || $studentSection == "11_litonjua") {
                                                    $table1 = "11_abm_1";
                                                    $table2 = "11_abm_2";
                                                }

                                                // Assuming $conn is your database connection object
                                                // Adjust the SQL query based on your actual database schema
                                                $sql = "SELECT * FROM $table1 UNION SELECT * FROM $table2";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo "<tr>";
                                                        echo "<td></td>";
                                                        echo "<td>" . $row["subject"] . "</td>";
                                                        echo "<td>" . $row["teacher"] . "</td>";
                                                        echo "<td>Actions</td>";
                                                        echo "</tr>";
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='4'>No data available</td></tr>";
                                                }

                                                // Close the database connection
                                                $conn->close();
                                                ?>
                                            </tbody>
                                        </table>
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
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

  </body>

  </html>