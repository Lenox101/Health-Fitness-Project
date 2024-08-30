<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_FILES['document']) || $_FILES['document']['error'] == UPLOAD_ERR_NO_FILE) {
        echo "<script>alert('No file was uploaded. Please choose a file to upload.');</script>";
        echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        $firstName = $_POST['FirstName'];
        $lastName = $_POST['LastName'];
        $memberId = $_POST['memberId'];
        $fileName = $_FILES['document']['name'];
        $fileType = $_FILES['document']['type'];
        $fileSize = $_FILES['document']['size'];
        $category = "personal_trainer";
        $fileContent = file_get_contents($_FILES['document']['tmp_name']);
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Select query to check if the record exists
        $sql = "SELECT * FROM trainers_schedules WHERE first_name='$firstName' AND last_name='$lastName' AND MemberId='$memberId' AND category='$category'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) >= 1) {
            // Prepare the update statement
            $updateStmt = $conn->prepare("UPDATE trainers_schedules SET name = ?, type = ?, size = ?, content = ? WHERE first_name = ? AND last_name = ? AND  MemberId = ? AND category = ?" );
            $updateStmt->bind_param("ssisssis", $fileName, $fileType, $fileSize, $fileContent, $firstName, $lastName, $memberId, $category);

            // Execute the statement
            if ($updateStmt->execute()) {
                echo "<script>alert('File uploaded successfully.');</script>";
                echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
            } else {
                echo "<script>alert('Error: " . addslashes($updateStmt->error) . "');</script>";
            }
            $updateStmt->close();

        } else {
            // Insert new record
            $stmt = $conn->prepare("INSERT INTO trainers_schedules (MemberId, name, type, size, content, first_name, last_name, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ississss",$memberId, $fileName, $fileType, $fileSize, $fileContent, $firstName, $lastName, $category);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<script>alert('File uploaded successfully.');</script>";
                echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
            } else {
                echo "<script>alert('Error: " . addslashes($stmt->error) . "');</script>";
            }
        }

        // Close connections
        $stmt->close();
        $conn->close();
    }
}
?>
