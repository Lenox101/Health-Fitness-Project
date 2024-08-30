<?php
include 'db_connection.php';
if (isset($_POST['submit'])) {
    //Retrieve user id
    $nutritionistid = $_POST['nutritionistid'];
    // Retrieve user input
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $city = $_POST['cityDropdown'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];


    // Prepare SQL statement
    $sql = "UPDATE nutritionists_tbl SET first_name = '$fname', last_name = '$lname', username = '$uname', city = '$city', contact = '$contact', gender = '$gender', status = '$status'
            WHERE id='$nutritionistid'";

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

        #cityDropdown {
			width: 100%;
			padding: 5px;
			margin-top: 3px;
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
        <p>Nutritionist ID: </p>
        <input type="text" name="nutritionistid" id="nutritionistid" value="<?php echo htmlspecialchars(isset($_GET['nutritionistid']) ? $_GET['nutritionistid'] : ''); ?>" readonly><br>

        <label for="firstName">First Name:</label>
        <input type="text" id="firstName" value="<?php echo htmlspecialchars(isset($_GET['fname']) ? $_GET['fname'] : ''); ?>" onkeypress="return restrictNumbers(event)" name="fname"><br>

        <label for="lastName">Last Name:</label>
        <input type="text" id="lastName" value="<?php echo htmlspecialchars(isset($_GET['lname']) ? $_GET['lname'] : ''); ?>" onkeypress="return restrictNumbers(event)" name="lname"><br>

        <label for="username">Username:</label>
        <input type="text" id="username" value="<?php echo htmlspecialchars(isset($_GET['uname']) ? $_GET['uname'] : ''); ?>" onkeypress="return restrictNumbers(event)" name="uname"><br>

        <label for="city">City:</label><br>
        <select id="cityDropdown" name="cityDropdown">
            <option value="">Select a city</option>
            <option value="Nairobi">Nairobi</option>
            <option value="Mombasa">Mombasa</option>
            <option value="Nakuru">Nakuru</option>
            <option value="Ruiru">Ruiru</option>
            <option value="Eldoret">Eldoret</option>
            <option value="Kisumu">Kisumu</option>
            <option value="Kikuyu">Kikuyu</option>
            <option value="Ngong">Ngong</option>
            <option value="Mavoko">Mavoko</option>
            <option value="Thika">Thika</option>
            <option value="Naivasha">Naivasha</option>
            <option value="Karuri">Karuri</option>
            <option value="Juja">Juja</option>
            <option value="Kitengela">Kitengela</option>
            <option value="Kiambu">Kiambu</option>
            <option value="Malindi">Malindi</option>
            <option value="Mandera">Mandera</option>
            <option value="Kisii">Kisii</option>
            <option value="Kakamega">Kakamega</option>
            <option value="Mtwapa">Mtwapa</option>
            <option value="Wajir">Wajir</option>
            <option value="Lodwar">Lodwar</option>
            <option value="Limuru">Limuru</option>
            <option value="Meru">Meru</option>
            <option value="Nyeri">Nyeri</option>
            <option value="Isiolo">Isiolo</option>
            <option value="Ukunda">Ukunda</option>
            <option value="Kiserian">Kiserian</option>
            <option value="Kilifi">Kilifi</option>
            <option value="Nanyuki">Nanyuki</option>
            <option value="Busia">Busia</option>
            <option value="Migori">Migori</option>
            <option value="Bungoma">Bungoma</option>
            <option value="Narok">Narok</option>
            <option value="Embu">Embu</option>
            <option value="Machakos">Machakos</option>
            <option value="El Wak">El Wak</option>
            <option value="Gilgil">Gilgil</option>
            <option value="Kimilili">Kimilili</option>
            <option value="Kericho">Kericho</option>
            <option value="Voi">Voi</option>
            <option value="Wanguru">Wanguru</option>
            <option value="Habaswein">Habaswein</option>
            <option value="Turi">Turi</option>
            <option value="Moyale">Moyale</option>
            <option value="Homa Bay">Homa Bay</option>
            <option value="Kenol">Kenol</option>
            <option value="Masalani">Masalani</option>
            <option value="Muranga">Muranga</option>
            <option value="Webuye">Webuye</option>
            <option value="Njoro">Njoro</option>
            <option value="Kapsabet">Kapsabet</option>
            <option value="Mumias">Mumias</option>
            <option value="Kerugoya-Kutus">Kerugoya-Kutus</option>
            <option value="Nyahururu">Nyahururu</option>
            <option value="Marsabit">Marsabit</option>
            <option value="Rhamu">Rhamu</option>
            <option value="Siaya">Siaya</option>
            <option value="Mariakani">Mariakani</option>
            <option value="Maralal">Maralal</option>
            <option value="Mairo-Inya">Mairo-Inya</option>
            <option value="Kitui">Kitui</option>
            <option value="Makutano">Makutano</option>
            <option value="Elburgon">Elburgon</option>
            <option value="Watamu">Watamu</option>
            <option value="Lamu">Lamu</option>
            <option value="Kajiado">Kajiado</option>
            <option value="Nyamira">Nyamira</option>
            <option value="Isebania">Isebania</option>
            <option value="Karatina">Karatina</option>
            <option value="Kakuma">Kakuma</option>
            <option value="Lafey">Lafey</option>
            <option value="Bondo">Bondo</option>
            <option value="Kabarnet">Kabarnet</option>
            <option value="Chuka">Chuka</option>
            <option value="Kehancha">Kehancha</option>
            <option value="Maua">Maua</option>
            <option value="Taveta">Taveta</option>
            <option value="Takaba">Takaba</option>
            <option value="Eldama Ravine">Eldama Ravine</option>
            <option value="Hola">Hola</option>
            <option value="Mai Mahiu">Mai Mahiu</option>
            <option value="Rongo">Rongo</option>
            <option value="Oyugis">Oyugis</option>
            <option value="Wote">Wote</option>
            <option value="Emali">Emali</option>
            <option value="Garbatula">Garbatula</option>
            <option value="Mbale">Mbale</option>
            <option value="Mwingi">Mwingi</option>
            <option value="Awendo">Awendo</option>
            <option value="Kiminini">Kiminini</option>
            <option value="Moi's Bridge">Moi's Bridge</option>
            <option value="Mazeras">Mazeras</option>
            <option value="Malaba">Malaba</option>
            <option value="Makindu">Makindu</option>
            <option value="Banissa">Banissa</option>
            <option value="Msambweni">Msambweni</option>
            <option value="Namanga">Namanga</option>
            <option value="Mbita">Mbita</option>
            <option value="Isinya">Isinya</option>
        </select>

        <label for="contact">Contact:</label>
        <input type="number" id="contact" name="contact" value="<?php echo htmlspecialchars(isset($_GET['contact']) ? $_GET['contact'] : ''); ?>" ><br>

        <label for="gender"> Gender</label>
        <input type="radio" name="gender" value="Male" />Male
        <input type="radio" name="gender" value="Female">Female

        <label for="status">Status</label>
        <input type="radio" name="status" value="Pending" />Pending
        <input type="radio" name="status" value="Approved">Approved

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
		}
</script>
</html>