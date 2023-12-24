<?php
// Assuming you have a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pcshs";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateButton'])) {
    $subjects = $_POST['subject'];
    $teachers = $_POST['teacher'];


    // Assuming you have a table named '12_stem_2' with columns 'subject' and 'teacher'
    $tableName = "12_stem_2";

    // Clear existing data in the table
    $conn->query("TRUNCATE TABLE $tableName");

    // Insert new data into the table
    for ($i = 0; $i < count($subjects); $i++) {
        $subject = $conn->real_escape_string($subjects[$i]);
        $teacher = $conn->real_escape_string($teachers[$i]);

        $sql = "INSERT INTO $tableName (subject, teacher) VALUES ('$subject', '$teacher')";
        $conn->query($sql);
    }

    echo "Data updated successfully!";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Subjects</title>

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
            <a href="11_descartes.php">
              <i class="bi bi-circle"></i><span>11 - Descartes</span>
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
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Report Card</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="11_stem_1.php">
              <i class="bi bi-circle"></i><span>11 - STEM (1st Sem)</span>
            </a>
          </li>
          <li>
            <a href="11_stem_2.php">
              <i class="bi bi-circle"></i><span>11 - STEM (2nd Sem)</span>
            </a>
          </li>
          <li>
            <a href="11_abm_1.php">
              <i class="bi bi-circle"></i><span>11 -  ABM (1st Sem)</span>
            </a>
          </li>
          <li>
            <a href="11_abm_2.php">
              <i class="bi bi-circle"></i><span>11 -  ABM (2nd Sem)</span>
            </a>
          </li>
          <li>
            <a href="12_stem_1.php">
              <i class="bi bi-circle"></i><span>12 - STEM (1st Sem)</span>
            </a>
          </li>
          <li>
            <a href="12_stem_2.php">
              <i class="bi bi-circle"></i><span>12 - STEM (2nd Sem)</span>
            </a>
          </li>
          <li>
            <a href="12_abm_1.php">
              <i class="bi bi-circle"></i><span>12 -  ABM (1st Sem)</span>
            </a>
          </li>
          <li>
            <a href="12_abm_2.php">
              <i class="bi bi-circle"></i><span>12 -  ABM (2st Sem)</span>
            </a>
          </li>
        </ul>
      </li><!-- End Section Nav -->

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

    <section class="section">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-12 col-md-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">12 - STEM (Second Semester)</h5>

              <!-- Default Table -->
                <form method="post" action="12_stem_2.php" onsubmit="return validateForm();">
    <table id="subjectTable" class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Subject</th>
                <th scope="col">Teacher</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < 8; $i++) { ?>
                <tr>
                    <td><?php echo $i + 1; ?></td>
                    <td>
                        <select name="subject[<?php echo $i; ?>]" class="custom-dropdown">
    <option value="" <?php if(isset($_POST['subject'][$i]) && $_POST['subject'][$i] == '') echo 'selected'; ?>></option>
    <option value="Math" <?php if(isset($_POST['subject'][$i]) && $_POST['subject'][$i] == 'Math') echo 'selected'; ?>>Math</option>
    <option value="Science" <?php if(isset($_POST['subject'][$i]) && $_POST['subject'][$i] == 'Science') echo 'selected'; ?>>Science</option>
    <option value="English" <?php if(isset($_POST['subject'][$i]) && $_POST['subject'][$i] == 'English') echo 'selected'; ?>>English</option>
     <option value="Filipino" <?php if(isset($_POST['subject'][$i]) && $_POST['subject'][$i] == 'Filipino') echo 'selected'; ?>>Filipino</option>
    <!-- Add more subjects as needed -->
</select>

                    </td>
                    <td>
                        <select name="teacher[<?php echo $i; ?>]" class="custom-dropdown">
    <option value="" <?php if(isset($_POST['teacher'][$i]) && $_POST['teacher'][$i] == '') echo 'selected'; ?>></option>
    <option value="Mr. Smith" <?php if(isset($_POST['teacher'][$i]) && $_POST['teacher'][$i] == 'Mr. Smith') echo 'selected'; ?>>Mr. Smith</option>
    <option value="Ms. Johnson" <?php if(isset($_POST['teacher'][$i]) && $_POST['teacher'][$i] == 'Ms. Johnson') echo 'selected'; ?>>Ms. Johnson</option>
    <option value="Dr. Brown" <?php if(isset($_POST['teacher'][$i]) && $_POST['teacher'][$i] == 'Dr. Brown') echo 'selected'; ?>>Dr. Brown</option>
    <!-- Add more teachers as needed -->
</select>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <div class="text-end">
        <button type="submit" class="btn btn-warning" name="updateButton">Update</button>
    </div>
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