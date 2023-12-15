<?php
// Include the database connection file
require_once("connect.php");

$section = '';


// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_all_btn'])) {
    // Fetch data from the database
    $result = mysqli_query($mysqli, "SELECT * FROM students");

    while ($row = mysqli_fetch_assoc($result)) {
        // Check if the section is set for the current student
        if (isset($_POST['section'][$row['student_id']]) && !empty($_POST['section'][$row['student_id']])) {
            $selectedSection = mysqli_real_escape_string($mysqli, $_POST['section'][$row['student_id']]);
            $tableName = "section_" . $selectedSection;

            // Check if the table exists, create it if not
            $checkTableQuery = "CREATE TABLE IF NOT EXISTS $tableName (
                student_id INT PRIMARY KEY,
                first_name VARCHAR(255),
                middle_name VARCHAR(255),
                last_name VARCHAR(255),
                contact_no VARCHAR(20),
                birthday DATE,
                sex VARCHAR(10)
            )";

            mysqli_query($mysqli, $checkTableQuery);

            // Insert data into the corresponding table
            $insertQuery = "INSERT INTO $tableName (student_id, first_name, middle_name, last_name, contact_no, birthday, sex) 
                            VALUES ('{$row['student_id']}', '{$row['first_name']}', '{$row['middle_name']}', '{$row['last_name']}', '{$row['contact_no']}', '{$row['birthday']}', '{$row['sex']}')";

            $insertResult = mysqli_query($mysqli, $insertQuery);

            if (!$insertResult) {
                die("Error inserting data: " . mysqli_error($mysqli));
            }
        }
    }
}
?>

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Faculty - Students</title>
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

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-12 col-md-6">

                <div class="card mb-3">

                  <div class="card-body">

                    <div class="pt-4 pb-2">
                      <h5 class="card-title">List of Students</h5>
                    </div>

                    <form method='post' action='faculty_student.php'>
                      <label>Section:</label>
                                      <select name="section" id="sectionDropdown">
                                        <option value="11_archimedes" <?php if($section == '11_archimedes') echo 'selected="selected"'; ?>>11 - Archimedes</option>
                                        <option value="11_bernoulli" <?php if($section == '11_bernoulli') echo 'selected="selected"'; ?>>11 - Bernoulli</option>
                                        <option value="11_curie" <?php if($section == '11_curie') echo 'selected="selected"'; ?>>11 - Curie</option>
                                        <option value="11_descartes" <?php if($section == '11_descartes') echo 'selected="selected"'; ?>>11 - Descartes</option>
                                        <option value="11_banatao" <?php if($section == '11_banatao') echo 'selected="selected"'; ?>>11 - Banatao</option>
                                        <option value="11_ramos" <?php if($section == '11_ramos') echo 'selected="selected"'; ?>>11 - Ramos</option>
                                        <option value="11_litonjua" <?php if($section == '11_litonjua') echo 'selected="selected"'; ?>>11 - Lintonjua</option>
                                        <option value="12_alcala" <?php if($section == '12_alcala') echo 'selected="selected"'; ?>>12 - Alcala</option>
                                        <option value="12_fronda" <?php if($section == '12_fronda') echo 'selected="selected"'; ?>>12 - Fronda</option>
                                        <option value="12_escuro" <?php if($section == '12_escuro') echo 'selected="selected"'; ?>>12 - Escuro</option>
                                        <option value="12_del_mundo" <?php if($section == '12_del_mundo') echo 'selected="selected"'; ?>>12 - Del Mundo</option>
                                        <option value="12_magsaysay" <?php if($section == '12_magsaysay') echo 'selected="selected"'; ?>>12 - Magsaysay</option>
                                        <option value="12_gandionco" <?php if($section == '12_gandionco') echo 'selected="selected"'; ?>>12 - Gandionco</option>
                                        <option value="12_sia" <?php if($section == '12_sia') echo 'selected="selected"'; ?>>12 - Sia</option>
                                      </select><br/><br/>
                      <table class="table" id="studentsTable">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Name of Student</th>
                            <th scope="col">Section</th>
                            <th scope="col">Contact no.</th>
                            <th scope="col">Birthday</th>
                            <th scope="col">Sex</th>
                            <th scope="col">Grades</th>
                          </tr>
                        </thead>
                      <tbody>

                        <?php
                        $count = 1;
                        $result = mysqli_query($mysqli, "SELECT * FROM students");
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo "<tr>";
                          echo "<th scope='row'>" . $count . "</th>";
                          echo "<td>" . $row['student_id'] . "</td>";
                          echo "<td>" . $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'] . "</td>";
                          echo "<td>" . $row['section'] . "</td>";
                          echo "<td>" . $row['contact_no'] . "</td>";
                          echo "<td>" . $row['birthday'] . "</td>";
                          echo "<td>" . $row['sex'] . "</td>";
                          echo "<td>
                            <a href='grade_form.php?student_id={$row['student_id']}' class='ri-file-text-line'></a>
                            </td>";
                          echo "</tr>";
                          $count++;
                          }
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
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
    $(document).ready(function() {
    // Initialize DataTable
    var table = $('#studentsTable').DataTable({
      // Add the orderMulti option to allow multiple column sorting
      orderMulti: true
    });

    // Add event listener to section dropdown
    $('#sectionDropdown').on('change', function() {
      var selectedSection = $(this).val();

      // Clear previous search
      table.search('').draw();

      // Filter the table based on the selected section
      if (selectedSection !== '') {
        table.column(3).search(selectedSection).draw();
      }
    });
  });
  </script>

  </body>

  </html>
