<!DOCTYPE html>
<html lang="en">
<?php
if (isset($_GET['memberid'])) {
    $memberid = urldecode($_GET['memberid']);
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress Report</title>
    <link rel="icon" type="image/png" href="/pictures/logo.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(/pictures/panel_7.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #747474;
            margin-bottom: 20px;
        }

        h2 {
            margin-top: 40px;
            margin-bottom: 10px;
            color: #666;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            /* 0.8 sets the opacity to 80% */
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input,
        textarea {
            width: 90%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="number"] {
            width: 50px;
            border-radius: 3px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #3e8e41;
        }

        #progressData {
            margin-top: 20px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            /* 0.8 sets the opacity to 80% */
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0);
            border-radius: 3px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #progressData table {
            width: 100%;
            border-collapse: collapse;
        }

        #progressData th,
        #progressData td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        #progressData th {
            background-color: #f0f0f0;
        }
    </style>
</head>

<body>
    <h1>Progress Report</h1>
    <h2>Log Activity</h2>
    <form action="log_activity.php" method="post">
        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" value="<?php echo htmlspecialchars($memberid); ?>" name="user_id" readonly>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="type">Type of Activity:</label>
        <input type="text" id="type" name="type" required>

        <label for="duration">Duration (minutes):</label>
        <input type="number" id="duration" name="duration" required>

        <label for="weight">Weight (kg):</label>
        <input type="number" id="weight" name="weight" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>

        <button type="submit">Log Activity</button>
    </form>

    <h2>View Progress</h2>
    <form id="progressForm" action="view_progress.php" method="post">
        <label for="progress_user_id">User ID:</label>
        <input type="number" id="progress_user_id" value="<?php echo htmlspecialchars($memberid); ?>" name="user_id" readonly>

        <label for="start_date">Start Date:</label>
        <input type="date" id="start_date" name="start_date" required>

        <label for="end_date">End Date:</label>
        <input type="date" id="end_date" name="end_date" required>

        <button type="submit">View Progress</button>
    </form>

    <div id="progressData">
        <!-- Progress data will be displayed here -->
    </div>

    <script>
        document.getElementById('progressForm').onsubmit = function(event) {
            event.preventDefault();
            const formData = new FormData(event.target);

            fetch('view_progress.php', {
                    method: 'POST',
                    body: new URLSearchParams(formData)
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('progressData').innerHTML = data;
                });
        };

        // Set max date to today
        document.getElementById('date').max = new Date().toISOString().split('T')[0];
    </script>
</body>

</html>
