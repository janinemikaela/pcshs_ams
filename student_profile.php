  <?php
  session_start();
  $db = mysqli_connect("localhost", "root", "", "pcshs");

  // Fetch student information from the database
  if (isset($_SESSION["student_id"])) {
      $student_id = $_SESSION['student_id'];
      $query = "SELECT last_name, first_name, middle_name, sex, birthday, contact_no, email, address, section FROM students WHERE student_id = '$student_id'";
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
          echo "Error fetching record: " . mysqli_error($db);
          exit();
      }
  } else {
      header("location:student_login.php");
      exit();
  }

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contact_no = mysqli_real_escape_string($db, $_POST['contact_no']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $address = mysqli_real_escape_string($db, $_POST['address']);
    $section = mysqli_real_escape_string($db, $_POST['section']);

    // Construct the table name based on the selected section
    $table_name = strtolower($section);

    // Update the main students table with the new information
    $update_query_students = "UPDATE students SET contact_no = '$contact_no', email = '$email', address = '$address', section = '$section' WHERE student_id = '$student_id'";
    $update_result_students = mysqli_query($db, $update_query_students);

    if ($update_result_students) {
        // Check if the section-specific table exists
        $check_table_query = "SHOW TABLES LIKE '$table_name'";
        $check_table_result = mysqli_query($db, $check_table_query);

        if (mysqli_num_rows($check_table_result) > 0) {
            // If the table exists, update the data
            $update_section_query = "UPDATE $table_name SET contact_no = '$contact_no', email = '$email', address = '$address' WHERE student_id = '$student_id'";
            $update_section_result = mysqli_query($db, $update_section_query);

            if ($update_section_result) {
                // Fetch data from the students table
                $select_query = "SELECT * FROM students WHERE student_id = '$student_id'";
                $select_result = mysqli_query($db, $select_query);
                $student_data = mysqli_fetch_assoc($select_result);

                // Insert data into the section-specific table
                $insert_section_query = "INSERT INTO $table_name (student_id, last_name, first_name, middle_name, sex, birthday, contact_no, email, address) VALUES ('$student_id', '{$student_data['last_name']}', '{$student_data['first_name']}', '{$student_data['middle_name']}', '{$student_data['sex']}', '{$student_data['birthday']}', '$contact_no', '$email', '$address')";
                $insert_section_result = mysqli_query($db, $insert_section_query);

                if ($insert_section_result) {
                    // Redirect back to the profile page
                    header("Location: student_profile.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error inserting data into section-specific table: " . mysqli_error($db);
                }
            } else {
                $_SESSION['message'] = "Error updating section-specific data: " . mysqli_error($db);
            }
        } else {
            $_SESSION['message'] = "Error: Section-specific table does not exist.";
        }
    } else {
        // Set the error message in the session
        $_SESSION['message'] = "Error updating main students data: " . mysqli_error($db);

        // Set the session variables with the user-entered data
        $_SESSION['contact_no_value'] = $contact_no;
        $_SESSION['email_value'] = $email;
        $_SESSION['address_value'] = $address;
        $_SESSION['section_value'] = $section;
    }

    // Open the modal with JavaScript
    echo '<script language="javascript">';
    echo 'document.addEventListener("DOMContentLoaded", function() {';
    echo 'var successModal = document.getElementById("successModal");';
    echo 'successModal.style.display = "block";';
    echo '});';
    echo '</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Student - Profile</title>
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

  <style>
    .profile-card {
      font-size: 20px;
      line-height: 1.6;
    }

    form input,
    form button {
      margin-top: 10px;
      padding: 5px;
      font-size: 16px;
    }
  </style>

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

                <!-- Profile Card -->
                <div class="col-xxl-4 col-md-12">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Personal Data</h5>

                            <div class="profile-card">
                                <p>Name: <?php echo "$last_name, $first_name $middle_name"; ?></p>
                                <p>Sex: <?php echo "$sex"; ?></p>
                                <p>Date of birth: <?php echo "$birthday"; ?></p>
                                <form method="post" action="student_profile.php">
                                    <label>Contact no.:</label>
                                    <input type="text" name="contact_no" value="<?php echo $contact_no; ?>" maxlength="11" autocomplete="off"><br/><br/>
                                    <label>Email Address:</label>
                                    <input type="text" name="email" value="<?php echo $email; ?>" autocomplete="off"><br/><br/>
                                    <label>Address:</label>
                                    <input type="text" name="address" value="<?php echo $address; ?>" autocomplete="off"><br/><br/>
                                    <label>Section:</label>
                                      <select name="section">
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

                                    <button type="submit">Update</button>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
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


