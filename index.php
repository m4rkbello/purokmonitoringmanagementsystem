<?php

include 'server.php';

// $errorHandling = "";
// $handle_error = "";

session_start();

// Validate if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve form data
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  // Validate the form data
  $errors = array();

  if (empty($email)) {
    $errors[] = "Email is required.";
  }

  if (empty($password)) {
    $errors[] = "Password is required.";
  }

  // If there are validation errors, display them; otherwise, validate the user credentials
  if (!empty($errors)) {
    foreach ($errors as $error) {
      echo $error . "<br>";
    }
  } else {
    // Connect to the database
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "purokmonitoringsystem";

    $conn = mysqli_connect($servername, $db_username, $db_password, $database);
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    // Sanitize the data before querying the database
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query the database for the user credentials
    $sql = "SELECT * FROM admin_tbl WHERE username = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    // Check if a matching user is found
    if (mysqli_num_rows($result) == 1) {
      // User credentials are valid
      $_SESSION['email'] = $email;
      echo "Login successful.";
      header("Location: dashboard.php");
      exit;
    } else {
        // Invalid user credentials
        // $errorMessage = '<script>window.alert("Please enter both email and password.");</script>';
        // // $_SESSION['error'] = "Invalid email or password.";
        // echo $errorMessage;
        // header("Location: index.php");
        // exit;
        echo '<script>window.alert("Please enter correct email and password!");</script>';
    }

    // Close the database connection
    mysqli_close($conn);
  }
}
?>


<!doctype html>
<html lang="en" data-bs-theme="auto">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Bello">
    <meta name="generator" content="Hugo 0.111.3">
    <title>Welcome to PMMS!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/">
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="../purokmonitoringsystem/css/style.css" rel="stylesheet">
<link href="../purokmonitoringsystem/css/main.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="sign-in.css" rel="stylesheet">
  </head>
  <body class="text-center img-fluid">
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
      <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
      </symbol>
      <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
      </symbol>
      <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
      </symbol>
    </svg>

<main class="form-signin w-100 m-auto img-fluid">
  <div class="formcontainerUi img-fluid">
  <form method="post" action="index.php">
    <img class="mb-4 img-fluid" src="../purokmonitoringsystem/images/pmmslogo.png" alt="pmmslogo" width="120" height="120">
    <h1 class="h3 mb-3 fw-normal img-fluid">PMMS</h1>
    <div class="form-floating img-fluid">
      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
      <!-- <label for="floatingInput">Email address</label> --> 
    </div>
    <div class="form-floating img-fluid">
      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
      <!-- <label for="floatingPassword">Password</label> -->
    </div>

    <div class="checkbox mb-3 img-fluid">
      <label>
        <input type="checkbox" value="remember-me"> Remember me
      </label>
    </div>
    <button class="custom-primary-button btn-lg w-100 img-fluid" type="submit" value="login">Sign in</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2023 by M4rk</p>
  </form>

  </div>
</main>






<script src="../assets/js/color-modes.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
  </body>
</html>

