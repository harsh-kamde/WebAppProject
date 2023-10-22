<?php

require_once 'includess/db.php';

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Registration Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  </head>
  <body>
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
                        <a href="Registration.php" class="nav-link active">Register</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link">Login</a>
                    </li>


                </ul>
            </div>
        </div>

    </nav>

    <?php
// Include database connection
$conn = db_connect();
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["userSubmit"])) {
    $firstName = $_POST["FirstName"];
    $lastName = $_POST["LastName"];
    $email = $_POST["UserEmail"];
    $profileImage = $_FILES["ProfileImage"]["name"];
    $phone = $_POST["UserPhone"];
    $password = $_POST["UserPassword"];

    // Upload profile image
    $target_dir = "uploads/images/profiles/";
    $target_file = $target_dir . basename($_FILES["ProfileImage"]["name"]);
    move_uploaded_file($_FILES["ProfileImage"]["tmp_name"], $target_file);

    // Insert user details into database
    $query = "INSERT INTO users (user_id, fname, lname, email,  password, mobile, profile_image) 
    VALUES (CONCAT('user', (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'webapp' AND
     TABLE_NAME = 'users')),'$firstName', '$lastName', '$email', '$password', '$phone', '$target_file')";
    mysqli_query($conn, $query);

    // Redirect to MyCourses.php
    header("Location: login.php");
    exit();
  } elseif (isset($_POST["instructorSubmit"])) {
    $firstName = $_POST["instructorFirstName"];
    $lastName = $_POST["instructorLastName"];
    $email = $_POST["instructorEmail"];
    $profileImage = $_FILES["ProfileImage"]["name"];
    $phone = $_POST["instructorPhone"];
    $accountNumber = $_POST["instructorAccountNumber"];
    $ifscCode = $_POST["instructorIFSC"];
    $password = $_POST["instructorPassword"];

    // Upload profile image
    $target_dir = "uploads/images/instructors/";
    $target_file = $target_dir . basename($_FILES["ProfileImage"]["name"]);
    move_uploaded_file($_FILES["ProfileImage"]["tmp_name"], $target_file);

    // Insert instructor details into database
    $query = "INSERT INTO instructors (instructor_id, fname, lname, email,password, mobile, account_no, IFSC_Code, profile_image) 
    VALUES (CONCAT('instruct', (SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'webapp' 
    AND TABLE_NAME = 'instructors')),
    '$firstName', '$lastName', '$email', '$password',  '$phone', '$accountNumber', '$ifscCode',  '$target_file')";
    mysqli_query($conn, $query);

    // Redirect to MyCourses.php
    header("Location: login.php");
    exit();
  }
}

db_close($conn); // Close database connection
?>


    <div class="container py-5 mt-5">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" href="#User">User</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#instructor">Instructor</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane fade show active" id="User">
                  <h4 class="card-title mb-4 text-center">User Registration</h4>
                  <!-- User registration form goes here -->
                  <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="FirstName" class="form-label">First Name: </label>
                      <input type="text" name="FirstName" class="form-control" id="FirstName" name="FirstName" required>
                    </div>
                    <div class="mb-3">
                      <label for="LastName" class="form-label">Last Name: </label>
                      <input type="text" name="LastName" class="form-control" id="LastName" name="LastName" required>
                    </div>
                    <div class="mb-3">
                      <label for="UserEmail" class="form-label">Email address:</label>
                      <input type="email" class="form-control" id="UserEmail" name="UserEmail" required>
                    </div>
                    <div class="mb-3">
                      <label for="CourseImage" >Profile: </label>
                         <input type="file" class="form-control-file ms-2" name="ProfileImage" id="ProfileImage" name="ProfileImage">
                    </div>
                    <div class="mb-3">
                      <label for="UserPhone" class="form-label">Phone:</label>
                      <input type="tel" class="instructorPhone" class="form-control" name="UserPhone" id="UserPhone"required>
                    </div>
                    <div class="mb-3">
                      <label for="UserPassword" class="form-label">Password: </label>
                      <input type="password" class="form-control" name="UserPassword" id="UserPassword"required>
                    </div>
                    <button type="submit" name="userSubmit" class="btn btn-outline-primary">Register As an User</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="instructor">
                  <h4 class="card-title mb-4 text-center">Instructor Registration</h4>
                  <!-- Instructor registration form goes here -->
                  <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                      <label for="instructorFirstName" class="form-label">First Name:</label>
                      <input type="text" name="instructorFirstName" class="form-control" id="instructorFirstName"required>
                    </div>
                    <div class="mb-3">
                      <label for="instructorLastName" class="form-label">Last Name:</label>
                      <input type="text" name="instructorLastName" class="form-control" id="instructorLastName"required>
                    </div>
                    <div class="mb-3">
                      <label for="instructorEmail" class="form-label">Email address:</label>
                      <input type="email" name="instructorEmail" class="form-control" id="instructorEmail"required>
                    </div>
                    <div class="mb-3">
                      <label for="CourseImage" >Profile: </label>
                         <input type="file" class="form-control-file ms-2" id="ProfileImage" name="ProfileImage">
                    </div>
                    <div class="mb-3">
                      <label for="instructorPhone" class="form-label">Phone:</label>
                      <input type="tel" name="instructorPhone" class="form-control" id="instructorPhone"required>
                    </div>
                    <div class="mb-3">
                      <label for="instructorAccountNumber" class="form-label">Account Number:</label>
                      <input type="text" name="instructorAccountNumber" class="form-control" id="instructorAccountNumber"required>
                    </div>
                    <div class="mb-3">
                      <label for="instructorIFSC" name="instructorIFSC" class="form-label">IFSC Code:</label>
                      <input type="text" name="instructorIFSC" class="form-control" id="instructorAccountNumber"required>
                    </div>

                    <div class="mb-3">
                      <label for="instructorPassword" class="form-label">Password:</label>
                      <input type="password" name="instructorPassword" class="form-control" id="instructorPassword"required>
                    </div>

                    <button type="submit" name="instructorSubmit" class="btn btn-outline-primary">Register As an Instructor</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-footer text-center">
              <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
	 <footer class=" bg-dark text-white p-2 position-relative text-center">
		<ul class="nav justify-content-center">
			<li class="nav-item"><a href="index.php"class="nav-link px-2 text-muted">Home</a></li>
			<li class="nav-item"><a href="Courses.php" class="nav-link px-2 text-muted">Courses</a></li>
			<li class="nav-item"><a href="LoginPage.php" class="nav-link px-2 text-muted">Login</a></li>
			<li class="nav-item"><a href="Registration.php" class="nav-link px-2 text-muted">Register</a></li>
		  </ul>
		<div class="container">
			<p class="lead">Copyright &copy; 2023 WebApp. All rights reserved. </p>
		</div>
	</footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
