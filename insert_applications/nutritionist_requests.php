<?php
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['document'])) {
    $nutritionistFirstName = $_POST['Nutritionist\'s_first_name'];
    $nutritionistLastName = $_POST['Nutritionist\'s_last_name'];
    $nutritionistId = $_POST['Nutritionist\'s_id'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $weight = $_POST['Weight'];
    $contact = $_POST['contact'];
    $fileName = $_FILES['document']['name'];
    $fileType = $_FILES['document']['type'];
    $fileContent = file_get_contents($_FILES['document']['tmp_name']);
    $gender = $_POST['gender'];
    $amount = 8000.00; // Assuming the fee is 8000
    $status = "Due"; // Assuming the status is initially set to Pending

    // Retrieving MemberId from the members_tbl based on the contact information
    $memberStmt = $conn->prepare("SELECT id FROM members_tbl WHERE contact = ? AND fname = ? AND lname = ?");
    $memberStmt->bind_param("sss", $contact, $firstName, $lastName);
    $memberStmt->execute();
    $memberResult = $memberStmt->get_result();

    if ($memberResult->num_rows > 0) {
        $memberRow = $memberResult->fetch_assoc();
        $memberId = $memberRow['id'];

        // Check if the member has already applied to this nutritionist
        $checkStmt = $conn->prepare("SELECT * FROM nutritionistapplicants WHERE `MemberId` = ? AND `Nutritionist Id` = ?");
        $checkStmt->bind_param("ii", $memberId, $nutritionistId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo "<script>alert('You have already applied to this nutritionist.')</script>";
            echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        } else {
            // Preparing the SQL statement to insert into the nutritionistapplicants table
            $stmt = $conn->prepare("INSERT INTO nutritionistapplicants (`MemberId`, `Nutritionist's First Name`, `Nutritionist's Last Name`, `Nutritionist Id`, FirstName, LastName, Weight, Contact, Gender, amount, status, name, type, content) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ississdssdssis", $memberId, $nutritionistFirstName, $nutritionistLastName, $nutritionistId, $firstName, $lastName, $weight, $contact, $gender, $amount, $status, $fileName, $fileType, $fileContent);

            // Executing the statement
            $stmt->execute();
            echo "<script>alert('Request Sent')</script>";
            echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }

        $checkStmt->close();
    } else {
        echo "<script>alert('Member not found. Please make sure the contact information is correct.')</script>";
        echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }

    // Close connections
    $memberStmt->close();
    $stmt->close();
    $conn->close();
}
?>
