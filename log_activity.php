<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $duration = $_POST['duration'];
    $weight = $_POST['weight'];
    $age = $_POST['age'];

    // Calculate calories burned
    // The is formula based on MET value estimation
    // For simplicity, let's assume MET value for 'type' is 6.0 (moderate activity)
    // and the calculation is based on duration, weight, and age.
    $met_value = 6.0; // Example MET value for moderate activity. It is reasonable for activities that fall into the moderate to vigorous intensity range
    $calories_burned = calculateCaloriesBurned($met_value, $duration, $weight, $age);

    // Check if user_id exists in members_tbl
    $check_user_sql = "SELECT id FROM members_tbl WHERE id = $user_id";
    $result = $conn->query($check_user_sql);

    if ($result->num_rows > 0) {
        // User exists, insert activity
        $sql = "INSERT INTO activities (user_id, date, type, duration, calories_burned, weight)
                VALUES ($user_id, '$date', '$type', $duration, $calories_burned, $weight)";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Activity logged successfully');</script>";
            // Redirect back to previous page
            echo "<script>window.location.href = document.referrer;</script>";
        } else {
            echo "<script>alert('Error: " . $sql . "\\n" . $conn->error . "');</script>";
            // Redirect back to previous page
            echo "<script>window.location.href = document.referrer;</script>";
        }
    } else {
        // User does not exist
        echo "<script>alert('No user with such an id');</script>";
        // Redirect back to previous page
        echo "<script>window.location.href = document.referrer;</script>";
    }

    $conn->close();
}

function calculateCaloriesBurned($met_value, $duration, $weight, $age) {
    // Example: Decrease MET value slightly for older age groups
    if ($age > 50) {
        $met_value *= 0.95; // reduce by 5% for people over 50
    }

    // Calculate calories burned
    $calories_burned = $met_value * ($weight / 60.0) * ($duration / 60.0); // Convert duration from minutes to hours

    return round($calories_burned, 2); // Round to 2 decimal places
}

?>
