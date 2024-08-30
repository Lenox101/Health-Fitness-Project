<?php
include '../db_connection.php';
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
            background-image: url(/pictures/panel_4.jpg);
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

        #events {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #events div {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        input[type="url"] {
            width: 90%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #3e8e41;
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
    <secction class="container">
        <div class="box-container">
            <?php
            // Using $conn is the database connection
            $trainer_type = isset($_GET['trainer_type']) ? $_GET['trainer_type'] : '';
            $trainer_id = isset($_GET['trainer_id']) ? $_GET['trainer_id'] : '';
            $email = isset($_GET['email']) ? $_GET['email'] : '';

            if ($trainer_type) {
                $trainer_type = mysqli_real_escape_string($conn, $trainer_type); // Sanitizing the input to prevent SQL injection
                $trainer_id = mysqli_real_escape_string($conn, $trainer_id); // Sanitizing the input to prevent SQL injection

                $tables = [
                    'yoga' => 'yogaapplicants',
                    'taekwondo' => 'taekwondoapplicants',
                    'aerobics' => 'aerobicsapplicants'
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
                            <form class="box sourceDiv" action="upload_rt_files.php" method="post" enctype="multipart/form-data">
                                <div class="text Transaction_id">Member Id: <?php echo htmlspecialchars($fetch_info['MemberId']); ?></div>
                                <div class="text FirstName">First Name: <?php echo htmlspecialchars($fetch_info['FirstName']); ?></div>
                                <div class="text LastName">Last Name: <?php echo htmlspecialchars($fetch_info['LastName']); ?></div>
                                <div class="text" id="Contact">Contact: <?php echo htmlspecialchars($fetch_info['Contact']); ?></div>
                                <div class="text" id="Weight">Weight: <?php echo htmlspecialchars($fetch_info['Weight']); ?></div>
                                <div class="text" id="gender">Gender: <?php echo htmlspecialchars($fetch_info['Gender']); ?></div>
                                <div class="text" id="status">Status: <?php echo htmlspecialchars($fetch_info['status']); ?></div>

                                <!-- Hidden fields to pass first name, last name, trainer type, memberid -->
                                <input type="hidden" name="FirstName" value="<?php echo htmlspecialchars($fetch_info['FirstName']); ?>">
                                <input type="hidden" name="LastName" value="<?php echo htmlspecialchars($fetch_info['LastName']); ?>">
                                <input type="hidden" name="TrainerType" value="<?php echo htmlspecialchars($trainer_type); ?>">
                                <input type="hidden" name="memberId" value="<?php echo htmlspecialchars($fetch_info['MemberId']); ?>">

                                <label for="file-input" style="color: #04AA6D;">Send Schedule</label><br>
                                <input type="file" name="document" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"><br><br>
                                <input type="submit" value="Upload PDF">
                            </form>
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
        <section class="container">
            <form id="events" action="schedule_event.php" method="post">
                <input type="hidden" name="trainer_id" value="<?php echo htmlspecialchars($trainer_id); ?>">
                <input type="hidden" name="trainer_type" value="<?php echo htmlspecialchars($trainer_type); ?>">
                <div>
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="event_name" name="event_name" required>
                </div>
                <div>
                    <label for="event_date" style="color: #04AA6D;">Date</label><br>
                    <input type="date" name="event_date" required><br><br>
                    <label for="event_time" style="color: #04AA6D;">Time</label><br>
                    <input type="time" name="event_time" required><br><br>
                </div>
                <div>
                    <label for="event_link">Meet Link:</label>
                    <input type="url" id="event_link" name="event_link" required>
                </div>
                <div>
                    <input type="hidden" id="email" value="<?php echo htmlspecialchars($email); ?>" name="email" required>
                </div>
                <input type="submit" value="Schedule Event" class="btn btns">
            </form>
        </section>
</body>

</html>