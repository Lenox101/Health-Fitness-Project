<?php
include('db_connection.php');

if (isset($_GET['firstName']) && isset($_GET['lastName']) && isset($_GET['memberid'])) {
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $trainertype = $_GET['registration_type'];
    $memberid = $_GET['memberid'];
    // Prepare and execute query
    if ($trainertype == "select_option") {
        echo "<script>alert('Please Select Trainer');</script>";
        echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        $stmt = $conn->prepare("SELECT name, type, size, content FROM trainers_schedules WHERE first_name = ? AND last_name = ? AND category = ?  AND MemberId = ?");
        $stmt->bind_param("sssi", $firstName, $lastName, $trainertype, $memberid);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($fileName, $fileType, $fileSize, $fileContent);
            $stmt->fetch();

            // Serve the file for download
            header("Content-Type: " . $fileType);
            header("Content-Length: " . $fileSize);
            header("Content-Disposition: attachment; filename=" . $fileName);

            echo $fileContent;
        } else {
            echo "<script>alert('No schedules Sent.');</script>";
            echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }

        // Close connections
        $stmt->close();
        $conn->close();
    }
}
