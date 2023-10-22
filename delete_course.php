<?php
// Include the database connection file

require_once 'includess/db.php';

// Check if course_id is set
if (isset($_GET['course_id'])) {
    // Get the course_id from the URL
    $course_id = $_GET['course_id'];

    // Prepare the DELETE statement
    $stmt = mysqli_prepare($conn, "DELETE FROM courses WHERE id = ?");

    // Bind the course_id parameter
    mysqli_stmt_bind_param($stmt, "i", $course_id);

    // Execute the DELETE statement
    mysqli_stmt_execute($stmt);

    // Check if a row was affected
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Redirect back to instructor dashboard with success message
        header("Location: instructor_dashboard.php?status=success&message=Course deleted successfully");
        exit;
    } else {
        // Redirect back to instructor dashboard with error message
        header("Location: instructor_dashboard.php?status=error&message=Failed to delete course");
        exit;
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Redirect back to instructor dashboard with error message
    header("Location: instructor_dashboard.php?status=error&message=Course not found");
    exit;
}
?>