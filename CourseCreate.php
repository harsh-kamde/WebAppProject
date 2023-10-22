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
            <a href="Dashboard.php" class="nav-link active">Dashboard</a>
          </li>

          <li class="nav-item">
            <a href="logout.php" class="nav-link">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!-- Create course section -->
  <div class="container mt-3 p-5">
    <h2 class="h2">Create a New Course</h2>
    <form class="pb-2 p-1" method="post" action="action.php" enctype="multipart/form-data">

      <div class="form-group my-4">
        <label for="Coursetitle" class="my-2">Course Title:</label>
        <input type="text" class="form-control" id="CourseTitle" placeholder="Enter course title" name="title" required>
      </div>

      <div class="form-group my-3">
        <label for="CourseImage" class="my-2">Course Thumbnail:</label>
        <input type="file" class="form-control-file btn-primary ms-2" id="CourseImage" name="CourseImage" required>
      </div>

      <div class="form-group my-4">
        <label for="CourseCategory" class="my-2">Category:</label>
        <select class="form-control" id="CourseCategory" name="CourseCategory" required>
          <option value="--select Category--">--Select Category--</option>
          <option value="Development">Development</option>
          <option value="Finance & Accounting">Finance & Accounting</option>
          <option value="IT & Software">IT & Software</option>
          <option value="office Productivity">office Productivity</option>
          <option value="personal Development">Personal Development</option>
          <option value="design">Design</option>
          <option value="Marketing">Marketing</option>
        </select>
      </div>

      <div class="form-group my-4">
        <label for="price" class="my-2">Course Price:</label>
        <input type="number" class="form-control" id="CoursePrice" placeholder="Enter in terms of ₹" name="price"
          required>
      </div>
      <div class="form-group my-4">
        <label for="CourseDescription" class="my-2">Course Description:</label>
        <textarea class="form-control" id="CourseDescription" placeholder="Enter course Description" name="CourseDescription" required></textarea>
      </div>
      <div class="form-group my-4">
        <!-- After submission redirected to the CourseCreateNext.php -->
        <button class="btn btn-outline-secondary add-section-btn" type="submit">Save and Add Modules</button>
      </div>
  </div>

  </form>
  </div>

  </form>
  </div>



  <!-- Footer -->
<footer class=" bg-dark text-white p-2 position-relative text-center">
  <ul class="nav justify-content-center">
    <li class="nav-item"><a href="dashboard.php" class="nav-link px-2 text-muted">Dashboard</a></li>
    <li class="nav-item"><a href="InstructorProfile.php" class="nav-link px-2 text-muted">Profile</a></li>
    <li class="nav-item"><a href="logout.php" class="nav-link px-2 text-muted">Logout</a></li>
    </ul>
  <div class="container">
    <p class="lead">Copyright &copy; 2023 WebApp. All rights reserved. </p>
  </div>
</footer>

  <!-- scripts -->

  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>

</body>


</html>