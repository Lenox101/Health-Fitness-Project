<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <link rel="icon" type="image/png" href="/pictures/logo.png">
  <style>
    body {
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url(/pictures/panel_3.jpg);
      background-size: cover;
      color: #ccc;
    }
    .container {
      text-align: center;
    }
    input[type="email"] {
      width: 300px;
      height: 40px;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 0 10px;
      box-sizing: border-box;
      margin-bottom: 10px;
    }
    button {
      width: 320px;
      height: 40px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .footer {
      margin-top: 20px;
    }
    #registration_type {
      width: 60%;
      padding: 5px;
      margin-top: 5px;
      border: 1px solid #cccccc;
      border-radius: 4px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Forgot Password</h1>
    <h4 class="information-text">Enter your registered email to reset your password.</h4>
    <form action="forgot_password.php" method="post"><br>
      <select id="registration_type" name="registration_type" required>
        <option value="select_option">Select Your category</option>
        <option value="member">Member</option>
        <option value="trainer">Trainer</option>
        <option value="nutritionist">Nutritionist</option>
      </select>
      <br><br>
      <input type="email" name="user_email" id="user_email" required>
      <p><label for="username">Email</label></p>
      <button type="submit">Reset Password</button>
    </form>
  </div>
</body>
</html>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Composer's autoloader
include 'db_connection.php'; // Including the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user_email = $_POST['user_email'];
  $registration_type = $_POST['registration_type'];

  // Initialize the SQL query based on registration type
  $sql = "";

  if ($registration_type == 'member') {
    $sql = "SELECT * FROM members_tbl WHERE email = '$user_email' LIMIT 1";
  } elseif ($registration_type == 'trainer') {
    $sql = "SELECT * FROM trainers_tbl WHERE email = '$user_email' LIMIT 1";
  } elseif ($registration_type == 'nutritionist') {
    $sql = "SELECT * FROM nutritionist_tbl WHERE email = '$user_email' LIMIT 1";
  } else {
    echo "<script>alert('Please select a valid category.');</script>";
    exit();
  }

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Create a password reset token
    $reset_token = bin2hex(random_bytes(16));

    // Save the reset token and expiration time to the database
    $expiry_time = date('Y-m-d H:i:s', strtotime('+10 minutes'));
    $update_sql = "";

    if ($registration_type == 'member') {
      $update_sql = "UPDATE members_tbl SET reset_token='$reset_token', token_expiry='$expiry_time' WHERE email='$user_email'";
    } elseif ($registration_type == 'trainer') {
      $update_sql = "UPDATE trainers_tbl SET reset_token='$reset_token', token_expiry='$expiry_time' WHERE email='$user_email'";
    } elseif ($registration_type == 'nutritionist') {
      $update_sql = "UPDATE nutritionist_tbl SET reset_token='$reset_token', token_expiry='$expiry_time' WHERE email='$user_email'";
    }

    if ($conn->query($update_sql) === TRUE) {
      // Send email with PHPMailer
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
        $mail->setFrom('lenoxrandy@gmail.com', 'Admin');
        $mail->addAddress($user_email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "Click on the following link to reset your password: 
                          <a href='http://localhost:3000/forgotpass/reset_password.php?registration_type=$registration_type&token=$reset_token'>Reset Password</a>";

        $mail->send();
        echo "<script>alert('Password reset link has been sent to your email.');</script>";
      } catch (Exception $e) {
        echo "<script>alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');</script>";
      }
    } else {
      echo "<script>alert('Error updating database: " . $conn->error . "');</script>";
    }
  } else {
    echo "<script>alert('No user with such an email.');</script>";
  }

  $conn->close();
}
?>
