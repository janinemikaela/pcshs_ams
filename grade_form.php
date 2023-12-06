<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Student Register</title>
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

<body style="background-color:#800000">

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-12 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h1 class="card-title text-center pb-0 fs-4">Grades</h1>
                  </div>

                 <form method="post" action="process_grades.php">
                    <!-- Include fields for student ID, name, and grades for each subject -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="studentID">Student ID</label>
                            <input type="text" class="form-control" id="studentID" name="studentID" readonly>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="studentName">Student Name</label>
                            <input type="text" class="form-control" id="studentName" name="studentName" readonly>
                        </div>
                    </div>
                    <!-- Add fields for each subject (English, Math, Science) -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="englishGrade">English Grade</label>
                            <input type="number" class="form-control" id="englishGrade" name="englishGrade" min="0" max="100" placeholder="Enter grade" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="mathGrade">Math Grade</label>
                            <input type="number" class="form-control" id="mathGrade" name="mathGrade" min="0" max="100" placeholder="Enter grade" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="scienceGrade">Science Grade</label>
                            <input type="number" class="form-control" id="scienceGrade" name="scienceGrade" min="0" max="100" placeholder="Enter grade" required><br/>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Grades</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // JavaScript function to show the grading modal
    function showGrades(studentId) {
        // Fetch student details using AJAX and set the values in the modal
        // For simplicity, I'll assume you have a JavaScript function (fetchStudentDetails) to fetch student details

        // Call the function to fetch student details
        fetchStudentDetails(studentId);

        // Show the modal
        $('#gradingModal').modal('show');
    }

    // JavaScript function to fetch student details using AJAX
    function fetchStudentDetails(studentId) {
        // Implement AJAX logic to fetch student details based on the studentId
        // For simplicity, you can set dummy values here
        $('#studentID').val(studentId);
        $('#studentName').val('John Doe'); // Replace with the actual name
    }
</script>

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

  <div id="successModal" class="modal">
  <div class="modal-content">
    <span class="close" onclick="document.getElementById('successModal').style.display='none'">&times;</span>
    <p>Account successfully created!</p>
  </div>
</div>

</body>

</html> 