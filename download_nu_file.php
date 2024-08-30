<?php
include('db_connection.php');

if (isset($_GET['firstName']) && isset($_GET['lastName']) && isset($_GET['memberid'])) {
    $firstName = $_GET['firstName'];
    $lastName = $_GET['lastName'];
    $memberid = $_GET['memberid'];
    // Prepare and execute query
    $stmt = $conn->prepare("SELECT name, type, size, content FROM nutritionist_recommendations WHERE first_name = ? AND last_name = ? AND MemberId = ?");
    $stmt->bind_param("ssi", $firstName, $lastName, $memberid);
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
        echo "<script>alert('No Deitary Recommendations Sent.');</script>";
        echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";

    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>