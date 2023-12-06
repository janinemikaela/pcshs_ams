<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>QR Scanner</title>
  <style>
    #preview {
      width: 100%;
      height: auto;
    }
  </style>
</head>

<body>
  <h1>QR Scanner</h1>
  <video id="preview"></video>

  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script>
    // Create a new instance of Instascan
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

    // Add a listener for the "scan" event
    scanner.addListener('scan', function (content) {
      // Display a confirmation dialog with the scanned information
      const isConfirmed = window.confirm('Scanned Information:\n\n' + content + '\n\nDo you want to confirm?');

      if (isConfirmed) {
        alert('Confirmed!'); // You can replace this with your logic after confirmation
      } else {
        alert('Canceled!');
      }
    });

    // Start scanning
    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
  </script>
</body>

</html>
