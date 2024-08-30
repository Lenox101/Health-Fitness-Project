<?php
include '../db_connection.php';

if(isset($_GET['FirstName']) && isset($_GET['LastName'])) {
    $firstName = $_GET['FirstName'];
    $lastName = $_GET['LastName'];

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT name, content FROM nutritionistapplicants WHERE FirstName = ? AND LastName = ?");
    $stmt->bind_param("ss", $firstName, $lastName);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($fileName, $fileContent);
        $stmt->fetch();

        // Serve the file for download
        header("Content-Disposition: attachment; filename=\"" . $fileName . "\"");

        echo $fileContent;
    } else {
        echo "<script>alert('No schedules Sent.');</script>";
        echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
