<?php
// session_start();
// $user_id = $_SESSION["user_id"];
require_once 'includess/db.php';

?>
<!DOCTYPE html>
<html>

<head>
	<title>Courses</title>
	<link rel="stylesheet" href="./stylesheets/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

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
                        <a href="#" class="nav-link active">Courses</a>
                    </li>
                    <?php
                        if (!isset($_COOKIE['user_id'])) {
                        // User is not logged in, display login and register links
                         echo '<li class="nav-item">
                                <a href="Registration.php" class="nav-link">Register</a>
                                    </li>';
                        echo '<li class="nav-item">
                             <a href="login.php" class="nav-link">Login</a>
                                </li>';


                            }
                         else {
                         // User is logged in, display logout link
                         echo '<li class="nav-item">
                         <a href="mycourse.php" class="nav-link">My Courses</a>
                            </li>';
                         echo '<li class="nav-item">
                         <a href="logout.php" class="nav-link">Logout</a>
                            </li>';
                        }
                    ?>


                </ul>
            </div>
        </div>

    </nav>
	

	<section class="p-5 bg-light" id="Instructors">
		<h2 class="text-start text-dark pb-3 h1">Our Courses</h2>
		<div class="row g-4 justify-content-between">

    <?php
// Database connection
$conn = db_connect();

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Fetch all courses
$courses_query = "SELECT c.course_id, c.course_image, c.title, c.price, i.fname, i.lname FROM courses c JOIN instructors i ON c.instructor_id = i.instructor_id";
$courses_result = mysqli_query($conn, $courses_query);

// Check if any courses exist
if (mysqli_num_rows($courses_result) > 0) {
    // Display courses in Bootstrap cards
    echo '<div class="row p-2  py-5">';
    while ($course_row = mysqli_fetch_assoc($courses_result)) {
        echo '<div class="col-md-12 col-lg-3 col-sm-12 mb-3 p-3">';
        echo '<div class="card">';
        echo '<a href="CourseDescription.php?course_id=' . $course_row['course_id'] . '"><img src="' . $course_row['course_image'] . '" class="card-img-top"></a>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $course_row['title'] . '</h5>';
        echo '<p class="card-text">Instructor: ' . $course_row['fname'] . " ". $course_row['lname'] . '</p>';
        echo '<p class="card-text ">Price: ₹' . $course_row['price'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    // Display message if no courses exist
    echo '<p>No courses available.</p>';
}

// Close the database connection
mysqli_close($conn);
?>

</div>
	</section>

	 <!-- Footer -->
	 <footer class=" bg-dark text-white p-2 position-relative text-center">
		<ul class="nav justify-content-center">
			<li class="nav-item"><a href="index.php"class="nav-link px-2 text-muted">Home</a></li>
			<li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Courses</a></li>
			<li class="nav-item"><a href="LoginPage.php "class="nav-link px-2 text-muted">Login</a></li>
			<li class="nav-item"><a href="Registration.php" class="nav-link px-2 text-muted">Register</a></li>
		  </ul>
		<div class="container">
			<p class="lead">Copyright &copy; 2023 WebApp. All rights reserved. </p>
		</div>
	</footer>

	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
	crossorigin="anonymous"></script>

	</body>
	</html>
