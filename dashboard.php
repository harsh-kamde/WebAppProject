<?php
require_once 'includess/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

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
                    <a href="#" class="nav-link active">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="InstructorProfile.php" class="nav-link">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
    </div>

    </nav>

    
    <?php
// Database connection
$conn = db_connect();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$instructor_id = $_COOKIE['instructor_id'];

// Fetch Total Earnings
$total_earnings = 0;
$query_earnings = "SELECT SUM(price) AS total_earnings FROM courses WHERE instructor_id = '$instructor_id'";
$result_earnings = mysqli_query($conn, $query_earnings);
if ($result_earnings) {
    $row_earnings = mysqli_fetch_assoc($result_earnings);
    $total_earnings = $row_earnings['total_earnings'];
}

// Fetch Total Enrolled Students
$total_enrolled_students = 0;
$query_enrolled_students = "SELECT COUNT(DISTINCT user_id) AS total_enrolled_students FROM purchase WHERE course_id IN (SELECT course_id FROM courses WHERE instructor_id = '$instructor_id')";
$result_enrolled_students = mysqli_query($conn, $query_enrolled_students);
if ($result_enrolled_students) {
    $row_enrolled_students = mysqli_fetch_assoc($result_enrolled_students);
    $total_enrolled_students = $row_enrolled_students['total_enrolled_students'];
}

// Fetch Total Courses Created
$total_courses_created = 0;
$query_courses_created = "SELECT COUNT(course_id) AS total_courses_created FROM courses WHERE instructor_id = '$instructor_id'";
$result_courses_created = mysqli_query($conn, $query_courses_created);
if ($result_courses_created) {
    $row_courses_created = mysqli_fetch_assoc($result_courses_created);
    $total_courses_created = $row_courses_created['total_courses_created'];
}

// Close database connection
db_close($conn);
?>

<!-- Instructor Dashboard -->
<div class="container-fluid p-5">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
    <!-- Dashboard contents -->
    <div class="row g-2">
        <!-- Earnings -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-start-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Earnings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">₹ <?php echo $total_earnings; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Enrolled students -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Enrolled Students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_enrolled_students; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Courses created -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Courses Created</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_courses_created; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- My Courses -->
    <?php
// Fetch and display created courses from the database

$conn = db_connect();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch created courses for the instructor
$sql = "SELECT course_id, title, created_at, course_image FROM courses WHERE instructor_id = '$instructor_id'";
$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    ?>
     <section class="p-5 bg-light" id="MyCourses">
        <div class="col-md-12 d-flex">
            <h2 class="mb-4">Created Courses</h2>
            <a href="CourseCreate.php" class=" ms-auto mb-4 "><button type="button" class="btn btn-primary">Create new course</button></a>
            
        </div>
        
        <div class="row g-4">
       
    
    <?php
    // Fetch rows from the result set
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract data from the row
        $course_id = $row['course_id'];
        $title = $row['title'];
        $created_at = $row['created_at'];
        $course_image = $row['course_image'];

        // Output the data
        ?>
        <div class="col-md-6 col-lg-3">
            <div class="card" style="width: 16rem;">
                <img src="<?php echo $course_image; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title text-bold"><?php echo $title; ?></h5>
                    <p class="card-text font-weight-lighter">Created: <?php echo $created_at; ?></p>
                  
                </div>
            </div>
        </div>
        <?php
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Display an error message
    echo "Failed to fetch courses: " . mysqli_error($conn);
}



?>


</div>
</div>
</section>

     <!-- Footer -->
     <footer class=" bg-dark text-white p-2 position-relative text-center">
        <ul class="nav justify-content-center">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-muted">Dashboard</a></li>
            <li class="nav-item"><a href="InstructorProfile.php" class="nav-link px-2 text-muted">Profile</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link px-2 text-muted">Logout</a></li>
          </ul>
        <div class="container">
            <p class="lead">Copyright &copy; 2023 WebApp. All rights reserved. </p>
        </div>
    </footer>

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
</body>
</html>