<?php
require_once 'includess/db.php';
require_once 'action.php';
if (isset($_POST)) {
    $video_Name = $_FILES['courseVideo']['name'];
    $video_size = $_FILES['courseVideo']['size'];
    $tmp_name = $_FILES['courseVideo']['tmp_name'];
    $error = $_FILES['courseVideo']['error'];
    if ($error === 0) {
        $target_dir = "uploads/videos/";
        $target_file = $target_dir . basename($_FILES["courseVideo"]["name"]);     
        move_uploaded_file($_FILES["courseVideo"]["tmp_name"], $target_file);  
        $moduleName = trim($_POST['ModuleName']);
        $lessonName = trim($_POST['LessonName']);
        $conn = db_connect();
        $sql = "INSERT INTO course_contents(course_id,module_Name,lesson_name,lesson_resource   )VALUES('" . $_SESSION['Course_Id'] . "','$moduleName','$lessonName','$target_file')";
        if (mysqli_query($conn, $sql)) {
            db_close($conn);
            $_SESSION['module'] = $moduleName;
            header('location: CourseCreateNext.php');
        }
    }
    if (isset($_POST['AddModule'])) {
        $_SESSION['module'] = null;
        header('location: CourseCreateNext.php');
    }

}