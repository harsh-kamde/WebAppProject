<?php
// session_start();
// $user_id = $_SESSION["user_id"];

//set this cookies as user loged in 


$user_id = "user1";
require_once 'includess/db.php';

?>
<!DOCTYPE html>
<html>

<head>
	<title>Web Development Bootcamp: WebApp</title>
	<link rel="stylesheet" href="./stylesheets/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="icon" type="image/png" href="./img/favicon.png">
</head>

<body class="100vh">
	
	  <!-- Navbar -->
	  <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
        <div class="container">
            <a href="#" class="navbar-brand"><img src=".\img\logoo.svg" alt="logo" class="img-fluid">WebApp</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"><span
                    class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navmenu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="MyCourse.php?user_id='<?php echo $user_id ?>'" class="nav-link">My Courses</a>
                    </li>
                    <li class="nav-item">
                        <a href="UserProfile.php?user_id='<?php echo $user_id ?>'" class="nav-link">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php" class="nav-link" >Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link" >Logout</a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>


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
      $sql = "SELECT c.course_image, c.title, c.description, c.price, c.category,
       i.fname, i.lname, cc.module_name, cc.lesson_name, cc.lesson_resource, cc.Created_At FROM 
       courses c JOIN instructors i ON c.instructor_id = i.instructor_id JOIN course_contents cc ON c.course_id = 
       cc.course_id WHERE c.course_id = '$course_id'";
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
  echo '<div class="col-12 col-lg-6 pt-2">';
  echo  '<video controlsList="nodownload" id="videoPlayer" controls class="img-fluid border border-primary rounded w-100" >
            <source src="" type="video/mp4">
            Your browser does not support the video tag.
          </video>';
  echo '<h2 class="course-name mt-4">' . $row["title"] . '</h2>';
  echo '<h5 class="instructor-name">Instructor: ' . $row["fname"] . " " . $row["lname"] . '</h5>';
  echo '<div class="py-3">';
  echo '<ul class="list-group">';
  echo '<li class="list-group-item">Category: ' . $row["category"] . '</li>';
  echo '</ul>';
  
  echo '<p class="description pt-3">' . $row["description"] . '</p>';
  echo '</div> </div>';

  $accordion_no = 1;
  echo '<div class="col-12 col-lg-6">';
  echo '<div class="mb-5">';
  echo '<h3>Course Modules</h3>';
  echo' <div class="accordion  " id="accordionExample">';
  echo'   <div class="accordion-item">';
  foreach ($modules as $module_name => $module_lessons) {
    echo'   <h2 class="accordion-header" id="'.$accordion_no.'">';
    echo  '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse'.$accordion_no.'" 
    aria-expanded="false" aria-controls="collapse' . $accordion_no . '">';
    echo '<h5>' . $module_name . '</h5>';
    echo " </button> </h2>";
    echo' <div id="collapse'.$accordion_no.'" class="accordion-collapse collapse" data-bs-parent="#accordionExample">';
 // echo '<ul class="form-group">';
    echo '<div class="accordion-body">';
    //  echo '<li class="list-group-item">';
      echo '<ul class="form-group" id="videoList">';
      foreach ($module_lessons as $lesson) {
          echo '<a class=" list-group-item" href="' . $lesson["lesson_resource"] . '">';
          echo '<li class="list-group-item">' . $lesson["lesson_name"].'</li></a>';
      }
      echo '</ul>';
      echo '</div>';
      echo'</div>';
      $accordion_no++;
    }
    echo '</div>';
    echo '</div>';
    echo'</div>';
    
    //Certificate functionality is currently not working because we are not able to track student
    // progress
  echo '<div class="mt-1 py-2">
          <a class = "btn-primary" href="purchase.php?course_id= . $course_id">
            <button type="button" class="btn btn-outline-secondary disabled text-center w-100">Download Certificate</button>
         </a>
        </div>';
  
    echo '</div>';
    echo '</div>';

  } else {
    echo '<div class="alert alert-warning text-center" role="alert">
    Sorry! Course Data not Found.
  </div>';
    }
    
    // Close the database connection
    db_close($conn);
    ?>

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var videoList = $("#videoList a");
            var currentVideoIndex = 0;

            // Play the first video on page load
            playVideo(currentVideoIndex);

            // Add click event listener to video links
            videoList.click(function(e) {
                e.preventDefault();
                var videoIndex = videoList.index(this);
                playVideo(videoIndex);
            });

            // Add ended event listener to video player
            $("#videoPlayer").on("ended", function() {
                currentVideoIndex++;
                if (currentVideoIndex < videoList.length) {
                    // Play the next video
                    playVideo(currentVideoIndex);
                } else {
                    // All videos completed
                    alert("All videos completed.");
                }
            });

            function playVideo(index) {
                // Update active state of video links
                videoList.removeClass("link-primary");
                videoList.eq(index).addClass("link-primary");
                var videoUrl = videoList.eq(index).attr("href");
                $("#videoPlayer source").attr("src", videoUrl);
                $("#videoPlayer")[0].load();
                $("#videoPlayer")[0].play();
            }
        });
    </script>

	 <!-- Footer -->
    
	 <footer class=" footer bg-dark text-white p-2 position-relative text-center">
       
		<ul class="nav justify-content-center">
			<li class="nav-item"><a href="MyCourses.php" class="nav-link px-2 text-muted">My Courses</a></li>
			<li class="nav-item"><a href="UserProfile.php" class="nav-link px-2 text-muted">Profile</a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link px-2 text-muted">Logout</a></li>
		  </ul>
		<div class="container">
			<p class="lead">Copyright &copy; 2023 WebApp. All rights reserved. </p>
		</div>
    
	
    </div>
	<!-- Scripts -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
	integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
	crossorigin="anonymous"></script>

	</body>
	</html>
