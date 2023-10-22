<?php 
 require_once './includess/db.php';
?>
<!DOCTYPE html>
<html>

<head>
	<title>Explore the world of Learning!</title>
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
                        <a href="Courses.php" class="nav-link active">Courses</a>
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
                         <a href="logout.php" class="nav-link">Logout</a>
                            </li>';
                        echo '<li class="nav-item">
                            <a href="mycourse.php" class="nav-link">My Courses</a>
                               </li>';
                        }
                    ?>


                </ul>
            </div>
        </div>

    </nav>


  <!-- retrieve and show data -->

  <div class="container my-5">

  <?php
        // Connect to the database
        $conn = db_connect();

        // Check connection
        if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
        }

        // Get the course ID from the query string
        $course_id = $_GET["course_id"];

        // Query the database for the course details
        $sql = "SELECT c.course_image, c.title, c.description, c.price, c.category, i.fname,
         i.lname, cc.module_name, cc.lesson_name, cc.lesson_resource, cc.Created_At FROM 
         courses c JOIN instructors i ON c.instructor_id = i.instructor_id JOIN course_contents cc ON c.course_id = cc.course_id WHERE c.course_id = '$course_id'";
        $result = mysqli_query($conn, $sql);

        // Check for errors and display the course details on the page
        if ($result === false) {
          die("Error: " . mysqli_error($conn));
        }
         elseif (mysqli_num_rows($result) > 0) {
      // Create an array to store the modules and their corresponding lessons
         $modules = array();

         while ($row = mysqli_fetch_assoc($result)) {
            $module_name = $row["module_name"];
            $lesson_name = $row["lesson_name"];
            $lesson_resource = $row["lesson_resource"];

        // If the module is not in the array, add it with an empty array of lessons
          if (!array_key_exists($module_name, $modules)) {
              $modules[$module_name] = array();
          }

        // Add the lesson to the array of lessons for the module
        $modules[$module_name][] = array(
            "lesson_name" => $lesson_name,
            "lesson_resource" => $lesson_resource
        );
    }

    // Display the course details on the page
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    echo '<div class="row">';
    echo '<div class="col-12 col-lg-6 mt-4">';
    echo '<img src="' . $row["course_image"] . '" class="img-fluid w-100 border border-primary rounded">';
   
     $accordion_no = 1;
    // create accordions to this 
       echo '<div class="my-5">';
       echo '<h3>Course Modules</h3>';
       echo' <div class="accordion " id="accordionExample">';
       echo'   <div class="accordion-item">';
       
      foreach ($modules as $module_name => $module_lessons) {
        echo'   <h2 class="accordion-header" id="'.$accordion_no.'">';
        echo  '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$accordion_no.'" 
        aria-expanded="false" aria-controls="collapse' . $accordion_no . '">';
        echo '<h6>' . $module_name . '</h6>'; 
        echo " </button> </h2>";
        echo' <div id="collapse'.$accordion_no.'" class="accordion-collapse collapse" data-bs-parent="#accordionExample">';
        echo '<div class="accordion-body">';
        echo '<ul class="form-group">';
        foreach ($module_lessons as $lesson) {
            echo '<li class="list-group-item">' . $lesson["lesson_name"].'</li>'; // module section
        }
        echo '</ul>';
        echo'</div>';
        echo'</div>';
        
        $accordion_no++;

      }
      
      echo'</div>';
      echo'</div>';

      echo '</div>';

    echo '</div>';
    echo '<div class="col-12 col-lg-6">';
    echo '<h2 class="course-name mt-4">' . $row["title"] . '</h2>';
    echo '<h5 class="instructor-name">Instructor: ' . $row["fname"] . " " . $row["lname"] . '</h5>';
    echo '<p class="description">' . $row["description"] . '</p>';
    echo '<h5>Course Details</h5>';
    echo '<ul class="list-group">';
    echo '<li class="list-group-item">Price: ₹' . $row["price"] . '</li>';
    echo '<li class="list-group-item">Category: ' . $row["category"] . '</li>';
    echo '</ul>';
    echo '<div class="mt-1 py-2">
    <a class = "nav-link" href="UserLoginCheck.php?course_id=' . $course_id . '">
         <button type="button" class="btn btn-primary text-center p-2 w-100">Buy Course</button>
    </a>
</div>';
    
      echo '</div>';
      echo '</div>';

    } else {
      echo "Course not found";
      }
      
      // Close the database connection
      db_close($conn);
      ?>

</div>




	 <!-- Footer -->
	 <footer class=" bg-dark text-white p-2 position-relative text-center">
		<ul class="nav justify-content-center">
			<li class="nav-item"><a href="index.php" class="nav-link px-2 text-muted">Home</a></li>
			<li class="nav-item"><a href="Courses.php" class="nav-link px-2 text-muted">Courses</a></li>
			<li class="nav-item"><a href="LoginPage.php" class="nav-link px-2 text-muted">Login</a></li>
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
