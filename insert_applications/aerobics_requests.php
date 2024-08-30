<?php
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $instructorFirstName = $_POST['instructor\'s_first_name'];
    $instructorLastName = $_POST['instructor\'s_last_name'];
    $instructorId = $_POST['instructor\'s_id'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $weight = $_POST['Weight'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $amount = 6000.00; // Assuming the fee is 6000
    $status = "Due"; // Assuming the status is initially set to Pending

    // Retrieving MemberId from the members_tbl based on the contact information
    $memberStmt = $conn->prepare("SELECT id FROM members_tbl WHERE contact = ? AND fname = ? AND lname = ?");
    $memberStmt->bind_param("sss", $contact, $firstName, $lastName);
    $memberStmt->execute();
    $memberResult = $memberStmt->get_result();

    if ($memberResult->num_rows > 0) {
        $memberRow = $memberResult->fetch_assoc();
        $memberId = $memberRow['id'];

        // Check if the member has already applied to this instructor
        $checkStmt = $conn->prepare("SELECT * FROM aerobicsapplicants WHERE `MemberId` = ? AND `Instructor Id` = ?");
        $checkStmt->bind_param("ii", $memberId, $instructorId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo "<script>alert('You have already applied to this trainer.')</script>";
            echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        } else {
            // Preparing the SQL statement to insert into the aerobicsapplicants table
            $stmt = $conn->prepare("INSERT INTO aerobicsapplicants (`MemberId`, `Instructor's First Name`, `Instructor's Last Name`, `Instructor Id`, `FirstName`, `LastName`, `Weight`, `Contact`, `Email`, `Gender`, `amount`, `status`) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ississsdssds", $memberId, $instructorFirstName, $instructorLastName, $instructorId, $firstName, $lastName, $weight, $contact, $email, $gender, $amount, $status);
            $stmt->execute();

            echo "<script>alert('Request Sent')</script>";
            echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }

        $checkStmt->close();
    } else {
        echo "<script>alert('Member not found. Please make sure the contact information is correct.')</script>";
        echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }

    // Close the database connection
    $memberStmt->close();
    $stmt->close();
    $conn->close();
}
?>
