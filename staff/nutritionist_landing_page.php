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
            background-image: url(/pictures/nutrition_2.jpg);
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
            width: 240px;
        }

        .container .box-container .box .text {
            padding: 10px;
        }

        .btn {
            background-color: #04AA6D;
            border-radius: 3px;
            color: white;
            padding: 10px 16px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            transition-duration: 0.4s;
            cursor: pointer;
        }

        .btns {
            background-color: white;
            color: black;
            border: 2px solid #555555;
        }

        .btns:hover {
            background-color: #555555;
            color: white;
        }
    </style>
</head>

<body>
    <header class="applicant-list-header">
        <h2>My Applicants</h2>
    </header>
    <secction class="container">
        <div class="box-container">
            <?php
            // Check if nutritionist_id is set in the URL
            if (isset($_GET['nutritionist_id'])) {
                $id = $_GET['nutritionist_id'];

                // Prepare SQL statement with parameterized query
                $sql = "SELECT * FROM `nutritionistapplicants` WHERE `status`='Paid' AND `Nutritionist Id`=?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $id); // Assuming Nutritionist Id is an integer

                // Execute the query
                $stmt->execute();
                $select_instructor = $stmt->get_result();

                if ($select_instructor->num_rows > 0) {
                    while ($fetch_info = $select_instructor->fetch_assoc()) {
            ?>
                        <div class="box sourceDiv">
                            <form action="upload_nutritionist_recommendations.php" method="post" enctype="multipart/form-data">
                                <div class="text MemberId">Member Id: <?php echo htmlspecialchars($fetch_info['MemberId']); ?></div>
                                <div class="text FirstName">First Name: <?php echo htmlspecialchars($fetch_info['FirstName']); ?></div>
                                <div class="text LastName">Last Name: <?php echo htmlspecialchars($fetch_info['LastName']); ?></div>
                                <div class="text" id="Contact">Contact: <?php echo htmlspecialchars($fetch_info['Contact']); ?></div>
                                <div class="text" id="Weight">Weight: <?php echo htmlspecialchars($fetch_info['Weight']); ?></div>
                                <div class="text" id="gender">Gender: <?php echo htmlspecialchars($fetch_info['Gender']); ?></div>
                                <div class="text" id="status">Status: <?php echo htmlspecialchars($fetch_info['status']); ?></div><br>

                                <!-- Hidden fields to pass first name, last name, and transaction id -->
                                <input type="hidden" name="Transaction_id" value="<?php echo htmlspecialchars($fetch_info['Transaction_id']); ?>">
                                <input type="hidden" name="FirstName" value="<?php echo htmlspecialchars($fetch_info['FirstName']); ?>">
                                <input type="hidden" name="LastName" value="<?php echo htmlspecialchars($fetch_info['LastName']); ?>">
                                <input type="hidden" name="memberid" value="<?php echo htmlspecialchars($fetch_info['MemberId']); ?>">
                                <!-- File upload for schedule -->
                                <label for="file-input" style="color: #04AA6D;">Send Schedule</label><br>
                                <input type="file" name="document" accept="application/pdf, application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" required><br><br>
                                <input type="submit" value="Upload File" class="btn btns"><br><br>
                            </form>

                            <!-- Form for downloading medical record -->
                            <form action="download_medical_record.php" method="get">
                                <!-- Hidden fields to pass first name and last name -->
                                <input type="hidden" name="FirstName" value="<?php echo htmlspecialchars($fetch_info['FirstName']); ?>">
                                <input type="hidden" name="LastName" value="<?php echo htmlspecialchars($fetch_info['LastName']); ?>">

                                <!-- Button to download medical record -->
                                <label for="file-input" style="color: #04AA6D;">Medical Record</label><br><br>
                                <input type="submit" value="Download Medical Record" class="btn btns">
                            </form>
                        </div>
            <?php
                    }
                } else {
                    echo "<script>alert('You have no Applicants')</script>";
                }
            } else {
                echo "Error: Nutritionist ID not provided.";
            }
            ?>

        </div>
    </secction>
</body>
<script>
    document.getElementById('file-input').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            console.log('File selected:', file.name);
        }
    });
</script>

</html>