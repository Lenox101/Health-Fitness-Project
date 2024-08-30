<?php
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['document'])) {
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $memberid = $_POST['memberid'];
    $fileName = $_FILES['document']['name'];
    $fileType = $_FILES['document']['type'];
    $fileSize = $_FILES['document']['size'];
    $fileTmpName = $_FILES['document']['tmp_name'];

    // Validate the file path
    if (empty($fileTmpName)) {
        echo "<script>alert('Error: File path is empty.'); window.history.back();</script>";
        exit();
    } elseif (!file_exists($fileTmpName)) {
        echo "<script>alert('Error: File does not exist.'); window.history.back();</script>";
        exit();
    }

    // Read the file contents
    $fileContent = file_get_contents($fileTmpName);
    if ($fileContent === false) {
        echo "<script>alert('Error: Unable to read the file.'); window.history.back();</script>";
        exit();
    }

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Select query to check if the record exists
    $sql = "SELECT * FROM nutritionist_recommendations WHERE first_name='$firstName' AND last_name='$lastName' AND MemberId='$memberid'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) >= 1) {
        // Prepare the update statement
        $updateStmt = $conn->prepare("UPDATE nutritionist_recommendations SET name = ?, type = ?, size = ?, content = ? WHERE first_name = ? AND last_name = ?  AND MemberId = ?");
        $updateStmt->bind_param("ssisssi", $fileName, $fileType, $fileSize, $fileContent, $firstName, $lastName, $memberid);

        // Execute the statement
        if ($updateStmt->execute()) {
            echo "<script>alert('File uploaded successfully.');</script>";
            echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        } else {
            echo "<script>alert('Error: " . addslashes($updateStmt->error) . "'); window.history.back();</script>";
        }
        $updateStmt->close();

    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO nutritionist_recommendations (MemberId, name, type, size, content, first_name, last_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ississs", $memberid, $fileName, $fileType, $fileSize, $fileContent, $firstName, $lastName);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('File uploaded successfully.');</script>";
            echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        } else {
            echo "<script>alert('Error: " . addslashes($stmt->error) . "'); window.history.back();</script>";
        }
    }

    // Close connections
    $stmt->close();
    $conn->close();
}

?>
