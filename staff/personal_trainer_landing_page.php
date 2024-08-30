<?php
include '../db_connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure this path is correct

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_meet_link'])) {
    $member_email = mysqli_real_escape_string($conn, $_POST['member_email']);
    $member_first_name = mysqli_real_escape_string($conn, $_POST['member_first_name']);
    $event_link = mysqli_real_escape_string($conn, $_POST['event_link']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $event_time = mysqli_real_escape_string($conn, $_POST['event_time']);
    $trainer_id = mysqli_real_escape_string($conn, $_POST['trainer_id']);
    $trainer_type = mysqli_real_escape_string($conn, $_POST['trainer_type']);
    $trainer_email = mysqli_real_escape_string($conn, $_POST['email']);

    $trainer_sql = "SELECT * FROM `personaltrainerapplicants` WHERE `Instructor Id` = '$trainer_id' LIMIT 1";
    $trainer_result = mysqli_query($conn, $trainer_sql);
    $trainer_info = mysqli_fetch_assoc($trainer_result);
    $trainer_first_name = $trainer_info['Instructor\'s First Name'];
    $trainer_last_name = $trainer_info['Instructor\'s Last Name'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'lenoxrandy@gmail.com';
        $mail->Password = 'pstk kbdg kbjp kjkt'; // email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($trainer_email, $trainer_first_name);
        $mail->addAddress($member_email, $member_first_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = "You're Invited to a Google Meet Session";
        $mail->Body = "Hello $member_first_name,<br><br>You have been invited to a Google Meet session:<br><br>
                       Date: $event_date<br>
                       Time: $event_time<br>
                       Link: <a href=\"$event_link\">Join Here</a><br><br>
                       Best Regards,<br>Your Personal Trainer, $trainer_first_name $trainer_last_name";
        $mail->AltBody = "Hello $member_first_name,\n\nYou have been invited to a Google Meet session:\n\n
                          Date: $event_date\n
                          Time: $event_time\n
                          Link: $event_link\n\n
                          Best Regards,\nYour Personal Trainer, $trainer_first_name $trainer_last_name";

        $mail->send();
        echo "<script>
                alert('Google Meet link sent successfully.');
                window.history.back();
              </script>";
    } catch (Exception $e) {
        echo "<script>
                alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                window.history.back();
              </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="icon" type="image/png" href="/pictures/logo.png">
    <style>
        body {
            background-image: url(/pictures/panel_6.jpg);
            background-size: cover;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            margin: 0;
            padding: 0;
        }

        .applicant-list-header {
            padding-left: 550px;
            background: rgba(255, 255, 255, 0.6);
            margin-top: 0;
        }

        .applicant-list-header h2 {
            margin-top: 0;
            padding: 9px;
        }

        .container .box-container {
            display: flex;
            padding: 70px;
            flex-wrap: wrap;
            gap: 50px;
            justify-content: center;
        }

        .container .box-container .box {
            text-align: center;
            border-radius: 5px;
            position: relative;
            padding: 20px;
            background-color: white;
            width: 210px;
        }

        .container .box-container .box .text {
            padding: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="url"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
    <script>
        function setMinDateTime() {
            const dateInput = document.querySelector('input[name="event_date"]');
            const timeInput = document.querySelector('input[name="event_time"]');
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            const minDate = `${year}-${month}-${day}`;
            const minTime = `${hours}:${minutes}`;

            dateInput.value = minDate; // Seting the current date as the default value
            timeInput.value = minTime; // Seting the current time as the default value

            dateInput.min = minDate; // Seting the minimum date to the current date
            timeInput.min = minTime; // Seting the minimum time to the current time
        }

        window.addEventListener('DOMContentLoaded', (event) => {
            setMinDateTime();
        });
    </script>
</head>

<body>
    <header class="applicant-list-header">
        <h2>My Applicants</h2>
    </header>
    <section class="container">
        <div class="box-container">
            <?php
            $trainer_type = isset($_GET['trainer_type']) ? $_GET['trainer_type'] : '';
            $trainer_id = isset($_GET['trainer_id']) ? $_GET['trainer_id'] : '';
            $t_email = isset($_GET['email']) ? $_GET['email'] : '';

            if ($trainer_type) {
                $trainer_type = mysqli_real_escape_string($conn, $trainer_type); // Sanitizing the input to prevent SQL injection
                $trainer_id = mysqli_real_escape_string($conn, $trainer_id); // Sanitizing the input to prevent SQL injection

                $tables = [
                    'personal_trainer' => 'personaltrainerapplicants',
                ];

                if (array_key_exists($trainer_type, $tables)) {
                    $table = $tables[$trainer_type];

                    // Building the SQL query
                    $sql = "SELECT * FROM `$table`";
                    if ($trainer_id) {
                        $sql .= " WHERE `Instructor Id` = '$trainer_id' AND status='Paid'";
                    }

                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($fetch_info = mysqli_fetch_assoc($result)) {
            ?>
                            <div class="box sourceDiv">
                                <form action="upload_files.php" method="post" enctype="multipart/form-data">
                                    <div class="text Transaction_id">Member Id: <?php echo htmlspecialchars($fetch_info['MemberId']); ?></div>
                                    <div class="text FirstName">First Name: <?php echo htmlspecialchars($fetch_info['FirstName']); ?></div>
                                    <div class="text LastName">Last Name: <?php echo htmlspecialchars($fetch_info['LastName']); ?></div>
                                    <div class="text" id="Contact">Contact: <?php echo htmlspecialchars($fetch_info['Contact']); ?></div>
                                    <div class="text" id="Weight">Weight: <?php echo htmlspecialchars($fetch_info['Weight']); ?></div>
                                    <div class="text" id="gender">Gender: <?php echo htmlspecialchars($fetch_info['Gender']); ?></div>
                                    <div class="text" id="status">Status: <?php echo htmlspecialchars($fetch_info['status']); ?></div>

                                    <!-- Hidden fields to pass first name and last name -->
                                    <input type="hidden" name="FirstName" value="<?php echo htmlspecialchars($fetch_info['FirstName']); ?>">
                                    <input type="hidden" name="LastName" value="<?php echo htmlspecialchars($fetch_info['LastName']); ?>">
                                    <input type="hidden" name="memberId" value="<?php echo htmlspecialchars($fetch_info['MemberId']); ?>">

                                    <label for="file-input" style="color: #04AA6D;">Send Schedule</label><br>
                                    <input type="file" name="document" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"><br><br>
                                    <input type="submit" value="Upload PDF"><br><br>
                                </form>
                                <form action="" method="post">
                                    <!-- Hidden fields to pass first name, last name, and email -->
                                    <input type="hidden" name="member_email" value="<?php echo htmlspecialchars($fetch_info['Email']); ?>">
                                    <input type="hidden" name="member_first_name" value="<?php echo htmlspecialchars($fetch_info['FirstName']); ?>">
                                    <input type="hidden" name="trainer_id" value="<?php echo htmlspecialchars($trainer_id); ?>">
                                    <input type="hidden" name="trainer_type" value="<?php echo htmlspecialchars($trainer_type); ?>">
                                    <label for="event_link" style="color: #04AA6D;">Meet Link</label><br>
                                    <input type="text" name="event_link" placeholder="Enter Meet link" required><br><br>
                                    <label for="event_date" style="color: #04AA6D;">Date</label><br>
                                    <input type="date" name="event_date" required><br><br>
                                    <label for="event_time" style="color: #04AA6D;">Time</label><br>
                                    <input type="time" name="event_time" required><br><br>
                                    <input type="hidden" id="email" value="<?php echo htmlspecialchars($t_email); ?>" name="email" required>
                                    <input type="submit" name="send_meet_link" value="Send Google Meet Link">
                                </form>
                                <form action="download_pt_medical_record.php" method="get">
                                    <!-- Hidden fields to pass first name and last name -->
                                    <input type="hidden" name="FirstName" value="<?php echo htmlspecialchars($fetch_info['FirstName']); ?>">
                                    <input type="hidden" name="LastName" value="<?php echo htmlspecialchars($fetch_info['LastName']); ?>"><br>
                                    <label for="file-input" style="color: #04AA6D;">Medical Record</label><br><br>
                                    <input type="submit" value="Download Medical Record">
                                </form>
                            </div>

            <?php
                        }
                    } else {
                        echo "<p>You have no Applicants</p>";
                    }
                } else {
                    echo "<p>Invalid trainer type specified.</p>";
                }
            } else {
                echo "<h1>No trainer type specified.</h1>";
            }
            ?>

        </div>
    </section>
</body>

</html>