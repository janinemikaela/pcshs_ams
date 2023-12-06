<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "pcshs");

// Fetch faculty information from the database
if (isset($_SESSION["employee_id"])) {
    $employee_id = $_SESSION['employee_id'];
    $query = "SELECT last_name, first_name, middle_name, sex, birthday, contact_no, email, address, section FROM faculty WHERE employee_id = '$employee_id'";
    $result = mysqli_query($db, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $last_name = strtoupper($row['last_name']);
        $first_name = strtoupper($row['first_name']);
        $middle_name = strtoupper($row['middle_name']);
        $sex = $row['sex'];
        $birthday = $row['birthday'];
        $contact_no = $row['contact_no'];
        $email = $row['email'];
        $address = $row['address'];
        $section = $row['section'];
    } else {
        // Handle the case where the query fails
        // You might want to redirect or show an error message
        echo "Error fetching record: " . mysqli_error($db);
        exit();
    }
} else {
    header("location:faculty_login.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $section = mysqli_real_escape_string($db, $_POST['section']);

    // Update the database with the new information
    $update_query = "UPDATE faculty SET contact_no = '$contact_no', email = '$email', address = '$address', section = '$section' WHERE employee_id = '$employee_id'";
    $update_result = mysqli_query($db, $update_query);

    if ($update_result) {
        // Update successful
        $_SESSION['message'] = "Profile updated successfully!";
    } else {
        // Update failed
        $_SESSION['message'] = "Failed to update profile. Please try again.";
    }

    // Construct the table name based on the selected section
    $table_name = str_replace(" ", "_", strtolower($section));

    // Fetch data from the corresponding table
    $section_query = "SELECT * FROM $table_name";
    $section_result = mysqli_query($db, $section_query);

    if ($section_result) {
        // Store the data in an array for later use in HTML
        $section_data = [];
        while ($row = mysqli_fetch_assoc($section_result)) {
            $section_data[] = $row;
        }
    } else {
        // Handle the case where fetching section data fails
        echo "Error fetching section data: " . mysqli_error($db);
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
        <a class="nav-link" data-bs-target="#icons-nav" href="# ">
          <i class="bi bi-gem"></i><span>Change Password</span>
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
                    <h5 class="card-title">List of Students - <?php echo $section; ?></h5>
                  </div>

                  <table class="table datatable">
                    <thead>
                      <tr class="year-2021">
                        <th scope="col">Student ID</th>
                        <th scope="col">Name of Student</th>
                        <th scope="col">Attendance</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Display the fetched data in the HTML table
                      if (isset($section_data) && is_array($section_data)) {
                          foreach ($section_data as $row) {
                              echo "<tr>";
                              echo "<td>{$row['student_id']}</td>";
                              echo "<td>{$row['name']}</td>";
                              echo "<td>{$row['attendance']}</td>";
                              echo "<td></td>"; // Add your action column data here
                              echo "</tr>";
                          }
                      }
                      ?>
                    </tbody>
                  </table>
                  <!-- End Table with stripped rows -->
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
    document.addEventListener("DOMContentLoaded", function () {
      const filterDropdown = document.getElementById("filterDropdown");
      const tableRows = document.querySelectorAll(".datatable tbody tr");

      filterDropdown.addEventListener("change", function () {
        const selectedYear = filterDropdown.value;

        tableRows.forEach(function (row) {
          if (selectedYear === "all" || row.classList.contains("year-" + selectedYear)) {
            row.style.display = "";
          } else {
            row.style.display = "none";
          }
        });
      });
    });
  </script>

</body>

</html>
