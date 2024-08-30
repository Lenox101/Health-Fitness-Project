<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure this path is correct

include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $trainer_id = mysqli_real_escape_string($conn, $_POST['trainer_id']);
  $trainer_type = mysqli_real_escape_string($conn, $_POST['trainer_type']);
  $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
  $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
  $event_time = mysqli_real_escape_string($conn, $_POST['event_time']);
  $event_link = mysqli_real_escape_string($conn, $_POST['event_link']);
  $trainer_email = mysqli_real_escape_string($conn, $_POST['email']);

  // Fetch trainer's first name and last name from the applicants table
  $table = $trainer_type . 'applicants';
  $trainer_sql = "SELECT * FROM `$table` WHERE `Instructor Id` = '$trainer_id' LIMIT 1";
  $trainer_result = mysqli_query($conn, $trainer_sql);
  $trainer_info = mysqli_fetch_assoc($trainer_result);

  if ($trainer_info) {
    $trainer_first_name = $trainer_info['Instructor\'s First Name'];
    $trainer_last_name = $trainer_info['Instructor\'s Last Name'];
  } else {
    echo "<script>
            alert('No applications found.');
            window.history.back();
          </script>";
    exit;
  }

  // Notify members
  $notify_sql = "SELECT * FROM `$table` WHERE `Instructor Id` = '$trainer_id' AND status='Paid'";
  $result = mysqli_query($conn, $notify_sql);

  if ($result && mysqli_num_rows($result) > 0) {
    while ($member = mysqli_fetch_assoc($result)) {
      $email = $member['Email'];
      $firstName = $member['FirstName'];

      $mail = new PHPMailer(true);

      try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Using SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'lenoxrandy@gmail.com'; // email
        $mail->Password = 'pstk kbdg kbjp kjkt'; // email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($trainer_email, $trainer_first_name);
        $mail->addAddress($email, $firstName);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "You're Invited to a Virtual Event";
        $mail->Body = "Hello $firstName,<br><br>You have been invited to the following event:<br><br>Event Name: $event_name<br>Date: $event_date<br>Event Time:$event_time<br> Link: <a href=\"$event_link\">Join Here</a><br><br>Best Regards,<br>$trainer_first_name $trainer_last_name";
        $mail->AltBody = "Hello $firstName,\n\nYou have been invited to the following event:\n\nEvent Name: $event_name\nDate: $event_date\nLink: $event_link\n\nBest Regards,\nYour Trainer,$trainer_first_name $trainer_last_name";

        $mail->send();
      } catch (Exception $e) {
        echo "<script>
                alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                window.history.back();
              </script>";
        exit;
      }
    }
    echo "<script>
            alert('Emails sent successfully.');
            window.history.back();
          </script>";
  } else {
    echo "<script>
            alert('No paid applicants found.');
            window.history.back();
          </script>";
  }
} else {
  echo "<script>
        alert('Error: " . mysqli_error($conn) . "');
        window.history.back();
      </script>";
}

mysqli_close($conn);
?>
