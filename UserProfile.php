<?php
// session_start();
// $user_id = $_SESSION["user_id"];
//statically allocated 
$cookie_name = "user_id";

require_once 'includess/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>User Profile</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/css/bootstrap.min.css">
 
  <style>
    .card {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      border-radius: 10px;
      border: none;
    }

    .card-title {
      font-size: 32px;
      font-weight: 600;
      margin-bottom: 5px;
    }

    .card-subtitle {
      font-size: 18px;
      font-weight: 500;
      margin-bottom: 15px;
    }

    hr {
      margin: 15px 0;
      border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    p {
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 10px;
      display: flex;
      align-items: center;
    }

    p strong {
      margin-right: 10px;
    }

    img.rounded-circle {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      object-position: center;
      margin: 0 auto;
      display: block;
      border: 5px solid #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }


  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <a href="#" class="navbar-brand"><img src=".\img\logoo.svg" alt="logo" class="img-fluid">WebApp</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                
                <li class="nav-item">
                    <a href="MyCourse.php" class="nav-link">My Learning</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link active">Profile</a>
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

<?php
// Assuming you have already connected to your database using mysqli procedural approach and have a valid $conn object

// Fetch user data from database based on user_id from URL
$user_id = $_GET["user_id"]; // Assuming user_id is passed as a query parameter in the URL

$conn = db_connect();
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM users WHERE user_id = ". $user_id;
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Extract user data
$fname = $user['fname'];
$lname = $user['lname'];
$email = $user['email'];
$profile_image = $user['profile_image'];
$mobile = $user['mobile'];
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="<?php echo $profile_image; ?>" class="rounded-circle" alt="Profile Photo">
                    </div>
                    <h5 class="card-title text-center mt-3"><?php echo $fname . " " . $lname; ?></h5>
                    <h6 class="card-subtitle mb-2 text-muted text-center">User</h6>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <p><span class="font-weight-bold">First Name:&nbsp;</span><?php echo $fname; ?></p>
                            <p><span class="font-weight-bold">Last Name:&nbsp;</span><?php echo $lname; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p><span class="font-weight-bold">Email:&nbsp;</span><?php echo $email; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <p><span class="font-weight-bold">Phone:&nbsp;</span><?php echo $mobile; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="EditUserProfile.php?user_id=<?php echo $_GET["user_id"] ?>"><button type="button" class="btn btn-primary">Edit Profile</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</html>