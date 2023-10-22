<?php

require_once 'includess/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>

  <link rel="stylesheet" href="style.css">
   <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
   
</head>
<body class="d-flex flex-column min-vh-100">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
    <div class="container">
        <a href="#" class="navbar-brand"><img src=".\img\logoo.svg" alt="logo" class="img-fluid">WebApp</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="Courses.php" class="nav-link">Courses</a>
                </li>
                <li class="nav-item">
                    <a href="Registration.php" class="nav-link">Register</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active">Login</a>
                </li>


            </ul>
        </div>
    </div>

</nav>

<?php
  // Code to connect to database

  $conn = db_connect();

  // Check database connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Check for user credentials in users table
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['UserEmail'];
    $password = $_POST['UserPassword'];
    $user_id = null;
    $instructor_id = null;
    $error_message = null;

    // Query users table for email and password
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      // User credentials found, set user_id cookie
      $row = mysqli_fetch_assoc($result);
      $user_id = $row['user_id'];
      $cookie_name = "user_id";
      $cookie_value = $user_id;
      setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
      header("Location: index.php"); // Redirect to index.php
      exit();
    } else {
      // User credentials not found, check instructor credentials
      // Query instructors table for email and password
      $sql = "SELECT * FROM instructors WHERE email = '$email' AND password = '$password'";
      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) > 0) {
        // Instructor credentials found, set instructor_id cookie
        $row = mysqli_fetch_assoc($result);
        $instructor_id = $row['instructor_id'];
        $cookie_name = "instructor_id";
        $cookie_value = $instructor_id;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        header("Location: dashboard.php"); // Redirect to index.php
        exit();
      } else {
        // Invalid email or password
        $error_message = "Invalid email or password";
      }
    }
  }
?>






<!-- HTML code for login form -->
<div class="container py-5 w-50 mt-5 mb-5">


  <!-- Display error message if any -->
  <?php if (isset($error_message)) { ?>
  <div class="container rounded text-center text-white bg-danger p-2 mb-5"><?php echo $error_message; ?></div>
<?php } ?>

  <div class="container text-center pb-4 text-primary"><h2>Welcome Back!</h2></div>

  <form class="" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="mb-3">
      <label for="UserEmail" class="form-label">Email address:</label>
      <input type="email" class="form-control" id="UserEmail" name="UserEmail" required>
    </div>

    <div class="mb-3">
      <label for="UserPassword" class="form-label">Password: </label>
      <input type="password" class="form-control" id="UserPassword" name="UserPassword" required>
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="exampleCheck1">
      <label class="form-check-label" for="exampleCheck1">Remember Me</label>
    </div>
    <div class="py-4 text-center"> <button type="submit" class="w-100 btn btn-lg btn-outline-primary">Login</button></div>
   
  </form>
  <div class="text-center">
    <p>Don't have an account? <a href="Registration.php">Register</a></p>
  </div>
</div>



 <!-- Footer -->
 <footer class=" bg-dark text-white p-2 position-relative text-center mt-auto">
  <ul class="nav justify-content-center">
    <li class="nav-item"><a href="index.php"class="nav-link px-2 text-muted">Home</a></li>
    <li class="nav-item"><a href="Courses.php" class="nav-link px-2 text-muted">Courses</a></li>
    <li class="nav-item"><a href="Registration.php" class="nav-link px-2 text-muted">Register</a></li>
    </ul>
  <div class="container">
    <p class="lead">Copyright &copy; 2023 WebApp. All rights reserved. </p>
  </div>
</footer>
  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>