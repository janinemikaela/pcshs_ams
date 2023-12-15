  
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin - Log In</title>
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
    .card {
        background-image: url('your-background-image.jpg');
        background-size: cover;
        opacity: 0.9 ;
        min-height: 100vh; /* Infinite height */
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        width: 100%; /* Make the card as wide as the viewport */
    }
    .btn-group {
        text-align: center;
    }
    .btn-group .btn {
        display: inline-block;
        margin: 0 10px; /* Add spacing between buttons */
    }
</style>

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="card mb-3">

                <div class="card-body">
                
                  <div class="pt-4 pb-2">
                    <img src="assets/img/pcshs_logo.jfif" alt="">
                    <h5 class="card-title text-center pb-0 fs-4">PCSHS Admin</h5>
                  </div>

                  <form class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label><b>User ID</label></b>
                      <input type="text" name="employee_id" class="form-control" placeholder="XXX-XXXXXXX-XXXX" id="employee_id" pattern="^\d{3}-faculty-\d{4}$" required title="Please enter a valid Employee ID in the format: 001-faculty-2023" autocomplete="off" maxlength="16">
                      <div class="invalid-feedback">Please enter a valid User ID!</div>
                    </div>

                    <div class="col-12">
                      <label><b>Password</label></b>
                      <div class="input-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*_?&])[A-Za-z\d@$!%*_?&]{10}$" title="Password must be exactly 10 characters long, contain one uppercase, one lowercase, a special character, and a number" required>
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword"><i class="bi bi-eye"></i></button>
                      </div>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <center>
                    <div class="col-6">
                      <button class="btn btn-primary w-100" type="submit">Sign in</button>
                    </div>
                    </center>

                    <div class="col-12">
                      <a href="forgot_pass.php"><u>Reset Password</a></u>
                    </div>

                    <script>
                      const togglePassword = document.getElementById('togglePassword');
                      const password = document.getElementById('password');

                      togglePassword.addEventListener('click', function () {
                        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                        password.setAttribute('type', type);
                        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
                        });

                      const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
                      const confirmPassword = document.getElementById('con_password');

                      toggleConfirmPassword.addEventListener('click', function () {
                        const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
                        confirmPassword.setAttribute('type', type);
                        this.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
                        });
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

</body>

</html>