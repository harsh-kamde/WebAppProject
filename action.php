<!--b This code for the execution of insertion of data from CourseCreate.pnp -->
<?php
session_start();
$_SESSION['Instructor_Id']="harsh975";
require_once 'includess/db.php';
if (isset($_POST) && isset($_FILES["CourseImage"])) {
   /* getting image data 
            '
            '
            '
   */
    $img_Name = $_FILES['CourseImage']['name'];
    $img_size = $_FILES['CourseImage']['size'];
    $tmp_name = $_FILES['CourseImage']['tmp_name'];
    $error = $_FILES['CourseImage']['error'];
    if ($error === 0) {
        $img_ex=pathinfo($img_Name,PATHINFO_EXTENSION);
        $img_ex_lc=strtolower($img_ex);
        $allowed_ext = array("jpg","jpeg","png");
        if(in_array($img_ex_lc,$allowed_ext))
        {
            // Upload profile image
            $target_dir = "uploads/images/courseThumbnail/";
            $target_file = $target_dir . basename($_FILES["CourseImage"]["name"]);     
            move_uploaded_file($_FILES["CourseImage"]["tmp_name"], $target_file);   
        }
        else{
            $em="YOU CANT UPLOAD FILE OF THIS TYPE";
           // header("location: CourseCreate.php?error=$em");
        }

    }
    else{
        $em="unknown error occured!";
       // header("location: CourseCreate.php?error=$em");
    }
    /* getting form data
            '
            '
            '
     */
    $title=trim($_POST['title']);
    $CourseCategory=trim($_POST['CourseCategory']);
    $price=trim($_POST['price']);
    $CourseDescription=trim($_POST['CourseDescription']);
    $conn=db_connect();
    $sql="INSERT INTO courses(course_id,title,price,course_image,category,description,instructor_id)VALUES(CONCAT('course',(SELECT AUTO_INCREMENT FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = 'webapp' AND TABLE_NAME = 'courses')),'$title','$price','$target_file','$CourseCategory','$CourseDescription','".$_SESSION['Instructor_Id']."')"; 
    $res=mysqli_query($conn,$sql);
    $course_detail=mysqli_query($conn,"SELECT Course_Id FROM courses WHERE Instructor_Id = '".$_SESSION['Instructor_Id']."'");
    $course_Id=mysqli_fetch_assoc($course_detail);
    $_SESSION['Course_Id']=$course_Id['Course_Id'];

   header('location: CourseCreateNext.php');
}