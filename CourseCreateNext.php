<?php
ob_start();
session_start();
$_SESSION['module'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Course Creation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href=".\stylesheets\style.css">
  
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
                  <a href="Dashboard.php" class="nav-link">Dashboard</a>
              </li>

              <li class="nav-item">
                  <a href="logout.php" class="nav-link">Logout</a>
              </li>
          </ul>
      </div>
  </div>
  </nav>



<div class="container mt-3 p-5">
  <h2 class="p-1">Add Course Modules</h2>
  <form class="p-1 pb-2" method="post" action="courseAction.php" enctype="multipart/form-data">
    
    <div class="form-group my-4">
      <label for="curriculum">Module Name: </label>
      <div id="curriculum">
        <div class="curriculum-section my-1">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Module Name" name="ModuleName" <?php if($_SESSION['module'] != null){?>value ="<?php echo $_SESSION['module'];}?>" required>
 
          </div>
          <div class="lesson-list">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Lesson Name" name="LessonName" required>
              <input type="file" class="form-control-file btn-primary ms-2" name="courseVideo" accept="video/*" required>
              <div class="input-group-append">
                <input class="btn btn-outline-secondary delete-lesson-btn" type="submit" name="AddLesson" value="Add Lesson">
              </div>
            </div>
          </div>
        </div>
        <button onclick="alert(!Inserted');" class="btn btn-outline-secondary add-section-btn" type="submit" name="AddModule" value="Add Module">Add Module</button>
      </div>
    </div>
    
  </form>
</div>


<!-- Footer -->
<footer class=" bg-dark text-white p-2 position-relative text-center">
  <ul class="nav justify-content-center">
    <li class="nav-item"><a href="Dashboard.php" class="nav-link px-2 text-muted">Dashboard</a></li>
    <li class="nav-item"><a href="InstructorProfile.php" class="nav-link px-2 text-muted">Profile</a></li>
    <li class="nav-item"><a href="logout.php" class="nav-link px-2 text-muted">Logout</a></li>
    </ul>
  <div class="container">
    <p class="lead">Copyright &copy; 2023 WebApp. All rights reserved. </p>
  </div>
</footer>

</body>
</html>
