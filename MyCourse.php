<?php
// session_start();
// $user_id = $_SESSION["user_id"];

//set this cookies as user loged in 
$cookie_name = "user_id";

require_once 'includess/db.php';

?>

<!DOCTYPE html>
<html>

<head>
	<title>My Courses</title>
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
						<a href="#" class="nav-link active">My Learning</a>
					</li>
					<li class="nav-item">
						<a href="UserProfile.php?user_id='<?php echo $_COOKIE[$cookie_name] ?>'" class="nav-link">Profile</a>
					</li>
					<li class="nav-item">
                        <a href="index.php" class="nav-link" >Home</a>
                    </li>
					<li class="nav-item">
						<a href="logout.php" class="nav-link"> Logout</a>
					</li>

				</ul>
			</div>
		</div>

	</nav>
	<!-- courses list 1 -->

	<section class="p-5 bg-light" id="Instructors">
		<h2 class="text-start text-dark pb-3 h1">My Learnings</h2>
		<div class="row g-4 justify-content-between">


			<?php



			// Connect to the database
			$conn = db_connect();

			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}


			//Get this id from the session here it's custom declared 
			$user_id = $_COOKIE[$cookie_name];


			// Query the database for courses
			$sql = "SELECT c.course_image, c.course_id, c.title, i.fname, i.lname, p.completed_modules, p.total_modules FROM courses c JOIN instructors i ON c.instructor_id = i.instructor_id JOIN purchase ps ON c.course_id = ps.course_id JOIN progress p ON c.course_id = p.course_id WHERE ps.user_id = '$user_id'";
			$result = mysqli_query($conn, $sql);

			// Display the courses in Bootstrap cards
			while ($row = mysqli_fetch_assoc($result)) {

				$progress_percentage = ($row["completed_modules"] / $row["total_modules"]) * 100;

				echo '<div class="col-md-6 col-lg-3">
						<div class="card bg-light">';
				echo '<a class = "nav-link" href="CourseViewPage.php?course_id=' . $row["course_id"] . '">';
				echo '<div class="card-body text-center">';
				echo '<img src="' . $row["course_image"] . '" class="card-img-top mb-3">';
				echo '<h5 class="card-title mb-3">' . $row["title"] . '</h5>';
				echo '<p class="card-text">Instructor: ' . $row["fname"] . " ". $row["lname"].'</p>';
				
				
				// This code show the progeress of the user from the progress table
				// Currently we don't tracking the progress of the users
				// echo '<div class="progress">';
				// echo '<div class="progress-bar" role="progressbar" style="width: ' . $progress_percentage . '%" aria-valuenow="' . $row["completed_modules"] . '" aria-valuemin="0" aria-valuemax="' . $row["total_modules"] . '">'.$progress_percentage. '%'.'</div>';
				// echo '</div>';
				// echo '<p class="card-text m-2">' . $row["completed_modules"] . '/' . $row["total_modules"] . ' Completed</p>';
				 echo '</div>
					</a>
				</div>
				</div>';
			}

			// Close the database connection
			db_close($conn);
			?>



		</div>
	</section>









	<!-- Footer -->
	<footer class=" bg-dark text-white p-2 position-relative text-center">
		<ul class="nav justify-content-center">
			<li class="nav-item"><a href="MyCourses.php" class="nav-link px-2 text-muted">My learning</a></li>
			<li class="nav-item"><a href="UserProfile.php" class="nav-link px-2 text-muted">Profile</a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link px-2 text-muted">Logout</a></li>
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