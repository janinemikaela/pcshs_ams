<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "pcshs";

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the faculty table
$facultyQuery = "SELECT * FROM faculty";
$facultyResult = mysqli_query($conn, $facultyQuery);

// Fetch data from the subjects table
$subjectQuery = "SELECT * FROM 11_stem_1";
$subjectResult = mysqli_query($conn, $subjectQuery);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted with data
    if (!empty($_POST['subject']) && !empty($_POST['teacher'])) {
        // Loop through the submitted subjects and insert/update them in the database
        $subjects = $_POST['subject'];
        $teachers = $_POST['teacher'];

        foreach ($subjects as $key => $subject) {
            $teacher = mysqli_real_escape_string($conn, $teachers[$key]);

            // Assuming 'teacher_id' is the correct column name in the '11_stem_1' table
            $insertQuery = "INSERT INTO 11_stem_1 (subject, teacher) VALUES (?, ?)
                            ON DUPLICATE KEY UPDATE teacher = VALUES(teacher)";

            $stmt = mysqli_prepare($conn, $insertQuery);
            mysqli_stmt_bind_param($stmt, "ss", $subject, $teacher);
            mysqli_stmt_execute($stmt);
        }

        echo "Subjects saved successfully!";
    } else {
        // Check if there are rows to delete
        if (!empty($_POST['delete'])) {
            $deleteSubjects = $_POST['delete'];

            // Delete selected rows from the database
            foreach ($deleteSubjects as $subject) {
                $deleteQuery = "DELETE FROM 11_stem_1 WHERE subject = ?";
                $stmt = mysqli_prepare($conn, $deleteQuery);
                mysqli_stmt_bind_param($stmt, "s", $subject);
                mysqli_stmt_execute($stmt);
            }

            echo "Selected subjects deleted successfully!";
        } else {
            echo "No data submitted.";
        }
    }
}

// Fetch all faculty data into an array
$facultyData = [];
while ($facultyRow = mysqli_fetch_assoc($facultyResult)) {
    $facultyData[] = $facultyRow;
}

// Fetch all subjects data into an array
$subjectData = [];
while ($subjectRow = mysqli_fetch_assoc($subjectResult)) {
    $subjectData[] = $subjectRow;
}
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
              <h5 class="card-title">11 - STEM (First Semester)</h5>

              <!-- Default Table -->
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                                        onsubmit="return validateForm();">
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
                                                $count = 1;
                                                // Updated the loop to have 8 rows
                                                for ($i = 0; $i < 8; $i++) {
                                                    echo "<tr>";
                                                    echo "<th scope='row'>" . $count . "</th>";
                                                    echo "<td><select name='subject[]'>
                                                            <option value='11_archimedes' <?php if(\$section == '11_archimedes') echo 'selected=\"selected\"'; ?>11 - Archimedes</option>
                                                            <option value='11_bernoulli' <?php if(\$section == '11_bernoulli') echo 'selected=\"selected\"'; ?>11 - Bernoulli</option>
                                                            <option value='11_curie' <?php if(\$section == '11_curie') echo 'selected=\"selected\"'; ?>11 - Curie</option>
                                                            <option value='11_descartes' <?php if(\$section == '11_descartes') echo 'selected=\"selected\"'; ?>11 - Descartes</option>
                                                            <option value='11_banatao' <?php if(\$section == '11_banatao') echo 'selected=\"selected\"'; ?>11 - Banatao</option>
                                                            <option value='11_ramos' <?php if(\$section == '11_ramos') echo 'selected=\"selected\"'; ?>11 - Ramos</option>
                                                            <option value='11_litonjua' <?php if(\$section == '11_litonjua') echo 'selected=\"selected\"'; ?>11 - Lintonjua</option>
                                                            <option value='12_alcala' <?php if(\$section == '12_alcala') echo 'selected=\"selected\"'; ?>12 - Alcala</option>
                                                            <option value='12_fronda' <?php if(\$section == '12_fronda') echo 'selected=\"selected\"'; ?>12 - Fronda</option>
                                                            <option value='12_escuro' <?php if(\$section == '12_escuro') echo 'selected=\"selected\"'; ?>12 - Escuro</option>
                                                            <option value='12_del_mundo' <?php if(\$section == '12_del_mundo') echo 'selected=\"selected\"'; ?>12 - Del Mundo</option>
                                                            <option value='12_magsaysay' <?php if(\$section == '12_magsaysay') echo 'selected=\"selected\"'; ?>12 - Magsaysay</option>
                                                            <option value='12_gandionco' <?php if(\$section == '12_gandionco') echo 'selected=\"selected\"'; ?>12 - Gandionco</option>
                                                            <option value='12_sia' <?php if(\$section == '12_sia') echo 'selected=\"selected\"'; ?>12 - Sia</option>
                                                        </select></td>";
                                                    echo "<td><select name='teacher[]'>";
                                                    foreach ($facultyData as $facultyRow) {
                                                        $fullName = $facultyRow['first_name'] . ' ' . $facultyRow['last_name'];
                                                        echo "<option value='{$fullName}'>{$fullName}</option>";
                                                    }
                                                    echo "</select></td>";
                                                    echo "<td><input type='hidden' name='hidden_subject[]' value=''></td>";
                                                    echo "<td><input type='hidden' name='hidden_teacher[]' value=''></td>";
                                                    echo "</tr>";
                                                    $count++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success" id="updateButton">Update</button>
                                        </div>
                                    </form>


            <script>
              var facultyData = <?php echo json_encode($facultyData); ?>;
              var formSubmitting = false; // Flag to track form submission status

              // Function to initialize the table with the first row
              function initializeTable() {
                var table = document.getElementById("subjectTable");
                var rowCount = table.rows.length;

              // Add the first row if the table is empty
              if (rowCount === 0) {
                addSubjectRow();
              }
              }

              // JavaScript function to add a new row with empty values
              function addSubjectRow() {
                var table = document.getElementById("subjectTable");
                var rowCount = table.rows.length;

                var row = table.insertRow(rowCount);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);

                cell1.textContent = rowCount;

                cell2.innerHTML = "<input type='text' name='subject[]' value=''>";

                // Fetch faculty data for the dropdown
                var facultyDropdown = "<select name='teacher[]'>";
                for (var i = 0; i < facultyData.length; i++) {
                  var fullName = facultyData[i]['first_name'] + ' ' + facultyData[i]['last_name'];
                  facultyDropdown += "<option value='" + fullName + "'>" + fullName + "</option>";
                }
                facultyDropdown += "</select>";

                cell3.innerHTML = facultyDropdown;

                // Re-enable the Save button after adding the row
                document.getElementById("saveButton").disabled = false;
                }

                // Function to check if a row is empty
                function isEmptyRow(rowIndex) {
                var table = document.getElementById("subjectTable");
                var cells = table.rows[rowIndex].cells;
                for (var i = 0; i < cells.length; i++) {
                  var inputElement = cells[i].querySelector('input');
                  if (inputElement && inputElement.value.trim() !== '') {
                    return false;
                  }
                }
                  return true;
                }

                // Validation function to check if any required fields are empty
                function validateForm() {
                var subjects = document.getElementsByName('subject[]');
                var teachers = document.getElementsByName('teacher[]');

                for (var i = 0; i < subjects.length; i++) {
                  if (subjects[i].value.trim() === '' || teachers[i].value.trim() === '') {
                  alert('Please fill in all fields before saving.');
                  return false; // Prevent form submission
                  }
                }

                  return true; // Allow form submission
                }

                function deleteRow(btn) {
                  console.log("Delete button clicked!");
                  var row = btn.parentNode.parentNode;
                  var subject = row.querySelector("input[name='subject[]']").value; // Get the subject to delete

                  // Check if the subject has an associated database entry
                  if (subject.trim() !== '') {
                    // Send an AJAX request to delete the subject from the database
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                      if (xhr.readyState == 4 && xhr.status == 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                          // On success, remove the UI row
                          row.parentNode.removeChild(row);
                        } else {
                          // On failure, alert the user or handle the error appropriately
                          alert('Failed to delete the subject.');
                        }
                     }
                  };
                  xhr.open("POST", "delete_stem111.php", true); // Point to delete.php
                  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                  xhr.send("delete[]=" + encodeURIComponent(subject));
                  } else {
                    // If the subject is empty, remove the UI row without making a database request
                    row.parentNode.removeChild(row);
                  }
                  }

                // Call the initializeTable function when the page loads
                window.onload = initializeTable;
            </script>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>

  </div>
</main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script>
      var facultyData = <?php echo json_encode($facultyData); ?>;
    </script>

    <script>
        tinymce.init({
            selector: 'textarea',  // Specify the textarea or element ID where you want TinyMCE
            // Other TinyMCE configuration options...
        });
    </script>

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