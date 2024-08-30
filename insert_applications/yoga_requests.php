<?php
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $instructorFirstName = $_POST["instructor's_first_name"];
    $instructorLastName = $_POST["instructor's_last_name"];
    $instructorId = $_POST["instructor's_id"];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $weight = $_POST['Weight'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $amount = 6000.00; // Assuming the fee is 6000
    $status = "Due"; // Assuming the status is initially set to Pending

    // Retrieving MemberId from the members_tbl based on the contact information
    $stmt = $conn->prepare("SELECT id FROM members_tbl WHERE contact = ? AND fname = ? AND lname = ?");
    $stmt->bind_param("sss", $contact, $firstName, $lastName);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $memberId = $row['id'];

        // Check if the member has already applied to this Yoga instructor
        $checkStmt = $conn->prepare("SELECT * FROM yogaapplicants WHERE `MemberId` = ? AND `Instructor Id` = ?");
        $checkStmt->bind_param("ii", $memberId, $instructorId);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();

        if ($checkResult->num_rows > 0) {
            echo "<script>alert('You have already applied to this instructor.')</script>";
            echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        } else {
            // SQL statement to insert into the yogaapplicants table
            $stmt = $conn->prepare("INSERT INTO yogaapplicants (MemberId, `Instructor's First Name`, `Instructor's Last Name`, `Instructor Id`, FirstName, LastName, Weight, Contact, Email ,Gender, amount, status) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ississssssds", $memberId, $instructorFirstName, $instructorLastName, $instructorId, $firstName, $lastName, $weight, $contact, $email, $gender, $amount, $status);

            if ($stmt->execute()) {
                echo "<script>alert('Request Sent')</script>";
            } else {
                echo "<script>alert('Error: Could not send request.')</script>";
            }

            echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }

        $checkStmt->close();
    } else {
        echo "<script>alert('Member not found. Please make sure the contact information is correct.')</script>";
        echo "<script>window.location.href='" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
