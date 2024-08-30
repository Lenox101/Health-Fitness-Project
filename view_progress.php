<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Fetch activity data
    $sql = "SELECT * FROM activities WHERE user_id = $user_id AND date BETWEEN '$start_date' AND '$end_date'";
    $result = $conn->query($sql);

    // Fetch total calories burned
    $total_calories_sql = "SELECT SUM(calories_burned) AS total_calories FROM activities WHERE user_id = $user_id AND date BETWEEN '$start_date' AND '$end_date'";
    $total_calories_result = $conn->query($total_calories_sql);
    $total_calories = $total_calories_result->fetch_assoc()['total_calories'];

    if ($result->num_rows > 0) {
        echo "<h2>Progress for User ID: $user_id from $start_date to $end_date</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Date</th>
                    <th>Type</th>
                    <th>Duration (minutes)</th>
                    <th>Your Weight During the Period</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["date"] . "</td>
                    <td>" . $row["type"] . "</td>
                    <td>" . $row["duration"] . "</td>
                    <td>" . $row["weight"] . "</td>
                </tr>";
        }
        echo "</table>";
        echo "<h3>Estimated Total Calories Burned(based on MET value estimation): $total_calories</h3>";
    } else {
        echo "No activities found for User ID: $user_id from $start_date to $end_date";
    }

    $conn->close();
}
?>
