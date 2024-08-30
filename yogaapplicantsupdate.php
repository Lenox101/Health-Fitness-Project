<?php
include 'db_connection.php';
if (isset($_POST['submit'])) {
    //Retrieve user id
    $yogaapplicantsid = $_POST['yogaapplicantsid'];
    // Retrieve user input
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $status = $_POST['status'];
    $weight = $_POST['weight'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];


    // Prepare SQL statement
    $sql = "UPDATE yogaapplicants SET FirstName = '$fname', LastName = '$lname', status = '$status', Weight = '$weight',Contact = '$contact', Gender = '$gender'
            WHERE Transaction_id='$yogaapplicantsid'";

    // Execute SQL statement
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo '<script>alert("Record Updated")</script>';
        echo "<script>window.location='adminpanel.php';</script>";
    } else {
        echo "<script>alert('Error updating record: " . $conn->error . "');</script>";
    }
}

// Close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/pictures/logo.png">
    <title>Edit</title>
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: #333;
            display: flex;
            background-image: url(/pictures/yoga2.jpg);
            background-size: cover;
        }

        #editForm {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid #dddddd;
            border-radius: 10px;
            box-shadow: inset;
        }

        #editForm label {
            display: block;
            margin-top: 10px;
        }

        #editForm input[type="text"],
        #editForm input[type="number"],
        #editForm input[type="tel"] {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }

        #editForm input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.8s;
        }
    </style>
</head>

<body>
    <div>
        <h2>Edit Form</h2>
    </div>

    <form id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <!----Get user ID----->
        <p>Transaction ID: </p>
        <input type="text" name="yogaapplicantsid" id="yogaapplicantsid" value="<?php echo htmlspecialchars(isset($_GET['yogaapplicantsid']) ? $_GET['yogaapplicantsid'] : ''); ?>" readonly><br>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" value="<?php echo htmlspecialchars(isset($_GET['fname']) ? $_GET['fname'] : ''); ?>" onkeypress="return restrictNumbers(event)" name="fname"><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" value="<?php echo htmlspecialchars(isset($_GET['lname']) ? $_GET['lname'] : ''); ?>" onkeypress="return restrictNumbers(event)" name="lname"><br>

        <label for="status"> Status</label>
        <input type="radio" name="status" value="Due" />Due
        <input type="radio" name="status" value="Paid">Paid

        <label for="weight">Weight in KG:</label>
		<input type="number" id="weight" name="weight" value="<?php echo htmlspecialchars(isset($_GET['weight']) ? $_GET['weight'] : ''); ?>"><br>

        <label for="contact">Contact:</label>
        <input type="number" id="contact" value="<?php echo htmlspecialchars(isset($_GET['contact']) ? $_GET['contact'] : ''); ?>" name="contact"><br>

        <label for="gender"> Gender</label>
        <input type="radio" name="gender" value="Male" />Male
        <input type="radio" name="gender" value="Female">Female


        <input type="submit" name="submit" value="Submit" id="submitButton">
    </form>
</body>
<script>
    function restrictNumbers(e) {
			var x = e.which || e.keycode;
			if (/\d/.test(String.fromCharCode(x))) {
				return false;
			} else {
				return true;
			}
		};
</script>
</html>