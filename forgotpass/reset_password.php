<!DOCTYPE html>
<html>

<head>
  <title>Reset Password</title>
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

    input[type="password"] {
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
  </style>
</head>

<body>
  <div class="container">
    <h1>Reset Password</h1>
    <h4 class="information-text">Enter your new password.</h4>
    <form action="reset_password.php" method="post">
      <input type="password" name="new_password" id="new_password" required>
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token']); ?>">
      <input type="hidden" name="registration_type" value="<?php echo htmlspecialchars($_GET['registration_type']); ?>">
      <p><label for="new_password">New Password</label></p>
      <button type="submit">Update Password</button>
    </form>
  </div>
</body>

</html>

<?php
require 'vendor/autoload.php';
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['token']) && isset($_POST['registration_type'])) {
    $token = $conn->real_escape_string($_POST['token']);
    $registration_type = $conn->real_escape_string($_POST['registration_type']);
    $new_password = $_POST['new_password'];
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Determining the table based on registration type
    $table = '';
    if ($registration_type == 'member') {
      $table = 'members_tbl';
    } elseif ($registration_type == 'nutritionist') {
      $table = 'nutritionist_tbl';
    } elseif ($registration_type == 'trainer') {
      $table = 'trainers_tbl';
    } else {
      echo "<script>alert('Invalid registration type.');</script>";
      exit();
    }

    // Verifying the token
    $sql = "SELECT * FROM $table WHERE reset_token = '$token' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $user_id = $row['id'];

      // Updating the password in the database
      $update_sql = "UPDATE $table SET pwd = '$hashed_password', reset_token = NULL WHERE id = '$user_id'";
      if ($conn->query($update_sql) === TRUE) {
        // Show alert and then redirect
        echo "<script>
       alert('Password has been updated successfully.');
       window.location.href = '../login.php?status=success';
     </script>";
      } else {
        echo "<script>alert('Error updating password: " . $conn->error . "');</script>";
      }
    } else {
      echo "<script>
      alert('Invalid token.');
      window.location.href = '../forgot_password.php?status=invalid_token';</script>";
    }
  } else {
    echo "<script>
    alert('Token or registration type not provided.');
    window.location.href = '../forgot_password.php?status=missing_info';</script>";

  }

  $conn->close();
}
?>