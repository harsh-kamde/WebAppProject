<?php
require_once 'includess/db.php';

$user_id = $_GET["user_id"];

// Database connection";
$conn = db_connect();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch form data
$userFirstName = $_POST['UserFirstName'];
$userLastName = $_POST['UserLastName'];
$userEmail = $_POST['UserEmail'];
$userPhone = $_POST['UserPhone'];

// Upload profile image
$targetDir = "uploads/images/profiles/";
$fileName = basename($_FILES["ProfileImage"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
$uploadOk = 1;

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["ProfileImage"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($targetFilePath)) {
    echo "File already exists.";
    $uploadOk = 0;
}

// Check file size
if ($_FILES["ProfileImage"]["size"] > 5000000) {
    echo "File is too large.";
    $uploadOk = 0;
}

// Allow only certain file formats
if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
    echo "Only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // If everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["ProfileImage"]["tmp_name"], $targetFilePath)) {
        echo "<h3>The file " . htmlspecialchars($fileName) . " has been uploaded.</h3></br></br>";

        // Insert profile information into the database
        $sql = "UPDATE users SET fname = ?, lname = ?, email = ?, mobile = ?, profile_image = ? WHERE user_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $userFirstName, $userLastName, $userEmail, $userPhone, $targetFilePath, $user_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<h3>Profile information saved successfully.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
        header("Location: Mycourse.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

db_close($conn);
?>