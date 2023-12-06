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

    // Refresh the page to reflect changes
    header("Refresh:0");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Faculty - Profile</title>
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
        <a class="nav-link" data-bs-target="#forms-nav" href="faculty_logout.php">
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
            <a class="breadcrumb-item active" href="faculty_home.php"><?php echo $employee_id; ?></a>
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
                                <form method="post" action="faculty_profile.php">
                                    <label>Contact no.:</label>
                                    <input type="text" name="contact_no" value="<?php echo $contact_no; ?>" maxlength="11"><br/><br/>
                                    <label>Email Address:</label>
                                    <input type="text" name="email" value="<?php echo $email; ?>"><br/><br/>
                                    <label>Address:</label>
                                    <input type="text" name="address" value="<?php echo $address; ?>"><br/><br/>
                                    <label>Section:</label>
                                      <select name="section">
                                        <option value="11 - Archimedes" <?php if($section == '11 - Archimedes') echo 'selected="selected"'; ?>>11 - Archimedes</option>
                                        <option value="11 - Bernoulli" <?php if($section == '11 - Bernoulli') echo 'selected="selected"'; ?>>11 - Bernoulli</option>
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


