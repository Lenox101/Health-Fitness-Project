<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sign Up</title>
	<link rel="icon" type="image/png" href="/pictures/logo.png">
	<style>
		body {
			font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
			margin: 0;
			padding: 0;
			background-image: url('pictures/register_picture.jpg');
			background-size: cover;
			animation: changeBackground 10s infinite;
		}

		/*
		The @keyframes rule defines the animation named changeBackground.
		Inside @keyframes, each percentage represents a step in the animation.
		At each step, the background-image property changes to a different image.
		The animation changeBackground is applied to the body element with a duration of 10 seconds and set to repeat infinitely.
		*/
		@keyframes changeBackground {
			0% {
				background-image: url('pictures/homepage.jpg');
			}

			25% {
				background-image: url('pictures/apply_trainer.jpg');
			}

			50% {
				background-image: url('pictures/nutritionist_registration.jpg');
			}
		}

		nav {
			display: flex;
			margin-bottom: 2rem;
			background-color: rgba(255, 255, 255);
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
		}

		nav ul {
			display: flex;
			list-style: none;
			padding: 0;
		}

		nav li {
			margin: 0 1rem;
		}

		#registrationForm {
			width: 300px;
			margin: 100px auto;
			padding: 20px;
			background-color: rgba(255, 255, 255, 0.9);
			border: 1px solid #dddddd;
			box-shadow: inset;
		}

		#registrationForm label {
			display: block;
			margin-top: 10px;
		}

		#registrationForm input[type="text"],
		#registrationForm input[type="number"],
		#registrationForm input[type="password"],
		#registrationForm input[type="email"] {
			width: 100%;
			padding: 5px;
			margin-top: 5px;
			border: 1px solid #cccccc;
			border-radius: 4px;
		}

		#registrationForm input[type="submit"] {
			width: 100%;
			padding: 10px;
			margin-top: 20px;
			background-color: #4CAF50;
			color: white;
			border: none;
			cursor: pointer;
			transition: background-color 0.8s;
		}

		#email_btn {
			width: 50%;
			padding: 7px;
			background-color: #4CAF50;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			transition: background-color 0.8s;
		}

		#email_btn:hover {
			background-color: #193a1b;
		}

		#registration_type {
			width: 100%;
			padding: 5px;
			margin-top: 5px;
			border: 1px solid #cccccc;
			border-radius: 4px;
		}

		#cityDropdown {
			width: 100%;
			padding: 5px;
			margin-top: 5px;
			border: 1px solid #cccccc;
			border-radius: 4px;
		}

		#registrationForm input[type="submit"]:hover {
			background-color: #193a1b;
		}

		#submitButton {
			border-radius: 4px;
		}

		.toggle-password {
			position: absolute;
			top: 55px;
			right: 2px;
			transform: translateY(-50%);
			cursor: pointer;
			color: #666;
		}

		.toggle-password2 {
			position: absolute;
			top: 55px;
			right: 2px;
			transform: translateY(-50%);
			cursor: pointer;
			color: #666;
		}

		.password-wrapper {
			position: relative;
		}

		.validation-message {
			color: red;
			font-size: 0.9em;
		}

		.valid {
			color: green;
		}
	</style>
</head>

<body>
	<nav>
		<img src="/pictures/logo.png" alt="" style="width: 60px; height: auto;">
		<h1 style="padding-left:20px ;">Health and Fitness Management System</h1>
	</nav>
	<form id="registrationForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" enctype="multipart/form-data">
		<div class="form-grid">
			<div>
				<h2>Sign Up</h2>
				<label for="fname">First Name:</label><br>
				<input type="text" onkeypress="return restrictNumbers(event)" id="fname" name="fname" required><br>
			</div>
			<div>
				<label for="lname">Last Name:</label><br>
				<input type="text" onkeypress="return restrictNumbers(event)" id="lname" name="lname" required><br>
			</div>
			<div>
				<label for="uname">Username:</label><br>
				<input type="text" onkeypress="return restrictNumbers(event)" id="uname" name="uname" required><br>
			</div>
			<div>
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
			</div>
			<div>
				<label for="contact">Contact:</label><br>
				<input type="number" id="contact" name="contact" required><br>
			</div>
			<div class="form-group">
				<label for="registration_type">Registration Type:</label>
				<select id="registration_type" name="registration_type" required>
					<option value="select_option">Select option</option>
					<option value="nutritionist">Nutritionist</option>
					<option value="personal_trainer">Personal Trainer</option>
					<option value="yoga">Yoga Instructor</option>
					<option value="taekwondo">Taekwondo</option>
					<option value="aerobics">Aerobics Instructor</option>
					<option value="member">Member</option>
				</select>
			</div>
			<label for="gender"> Gender</label>
			<input type="radio" name="gender" value="Male" />Male
			<input type="radio" name="gender" value="Female">Female
		</div>
		<div id="imagesection" style="display: none;">
			<label for="image">Upload Your Image:</label><br>
			<input type="file" id="imageUpload" name="image" accept="image/*">
		</div>
		</div>
		<div id="weightSection" style="display: none;">
			<label style="padding-top: 10px;" for="weight">Weight in KG:</label><br>
			<input type="number" id="weight" name="weight"><br>
		</div>
		<div id="email">
			<label style="padding-top: 10px;" for="weight">Enter Your Email:</label><br>
			<input type="email" id="email" name="email" required><br>
		</div>
		<div class="form-group" id="cvUploadSection" style="display: none;">
			<label for="email">Send your CV [Mandatory]</label><br>
				<a id="email_btn" style="text-decoration: none; color: white;" href="https://mail.google.com/mail/?view=cm&fs=1&to=lenoxrandy@gmail.com&su=Application%20for%20Nutritionist/Trainer&body=Please%20find%20attached%20my%20CV%20and%20photo.%0D%0A%0D%0A%0D%0A--%0D%0ABest%20regards%2C%0D%0A[Your%20Name]" target="_blank">
					Send Email via Gmail
				</a>
		</div>
		<div class="password-wrapper">
			<label for="pwd">Password:</label><br>
			<input type="password" id="pwd" name="pwd" required oninput="validatePassword()">
			<span class="toggle-password" onclick="togglePassword('pwd', this)">Show</span>
			<span id="pwd-validation" class="validation-message"></span>
		</div>
		<div class="password-wrapper">
			<label for="cpwd">Confirm Password:</label><br>
			<input type="password" id="cpwd" name="cpwd" required>
			<span class="toggle-password2" onclick="togglePassword('cpwd', this)">Show</span>
		</div>
		<div>
			<input type="submit" value="Register" id="submitButton">
		</div>

	</form>
	<script>
		function validatePassword() {
			const password = document.getElementById('pwd').value;
			const validationMessage = document.getElementById('pwd-validation');
			const passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;

			if (password.length < 8) {
				validationMessage.textContent = 'Password must be at least 8 characters long.';
				validationMessage.classList.remove('valid');
			} else if (!/(?=.*\d)/.test(password)) {
				validationMessage.textContent = 'Password must contain at least one number.';
				validationMessage.classList.remove('valid');
			} else if (!/(?=.*[a-z])/.test(password)) {
				validationMessage.textContent = 'Password must contain at least one lowercase letter.';
				validationMessage.classList.remove('valid');
			} else if (!/(?=.*[A-Z])/.test(password)) {
				validationMessage.textContent = 'Password must contain at least one uppercase letter.';
				validationMessage.classList.remove('valid');
			} else if (!passwordPattern.test(password)) {
				validationMessage.textContent = 'Password does not meet the required criteria.';
				validationMessage.classList.remove('valid');
			} else {
				validationMessage.textContent = 'Password is valid.';
				validationMessage.classList.add('valid');
			}
		}

		function restrictNumbers(e) {
			var x = e.which || e.keycode;
			if (/\d/.test(String.fromCharCode(x))) {
				return false;
			} else {
				return true;
			}
		}

		document.getElementById('registration_type').addEventListener('change', function() {
			var selectedOption = this.value;
			var weightSection = document.getElementById('weightSection');
			var cvUploadSection = document.getElementById('cvUploadSection');
			var imagesection = document.getElementById('imagesection');

			if (selectedOption === 'member') {
				weightSection.style.display = 'block';
				cvUploadSection.style.display = 'none';
				imagesection.style.display = 'none';

			} else if (selectedOption === 'select_option') {
				cvUploadSection.style.display = 'none';
				weightSection.style.display = 'none';
				imagesection.style.display = 'none';
			} else {
				cvUploadSection.style.display = 'block';
				weightSection.style.display = 'none';
				imagesection.style.display = 'block';
			}
		});

		function togglePassword(fieldId, toggleElement) {
			const passwordField = document.getElementById(fieldId);

			if (passwordField.type === 'password') {
				passwordField.type = 'text';
				toggleElement.textContent = 'Hide';
			} else {
				passwordField.type = 'password';
				toggleElement.textContent = 'Show';
			}
		}
	</script>
</body>

</html>

<?php
include("db_connection.php");
// Initialize $cv_content variable
$cv_content = '';
try {
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$firstname = filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS);
		$lastname = filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS);
		$username = filter_input(INPUT_POST, "uname", FILTER_SANITIZE_SPECIAL_CHARS);
		$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
		$city = $_POST['cityDropdown'];
		$gender = $_POST['gender'];
		$weight = filter_input(INPUT_POST, "weight", FILTER_SANITIZE_SPECIAL_CHARS);
		$registration_type = $_POST['registration_type'];
		$contact = filter_input(INPUT_POST, "contact", FILTER_SANITIZE_SPECIAL_CHARS);
		$password = filter_input(INPUT_POST, "pwd", FILTER_SANITIZE_SPECIAL_CHARS);
		$confirmpassword = filter_input(INPUT_POST, "cpwd", FILTER_SANITIZE_SPECIAL_CHARS);
		$image = $_FILES['image']['name'];

		// Check if username is unique in members_tbl
		$check_query = "SELECT COUNT(*) AS count FROM members_tbl WHERE uname = ?";
		$stmt_check = $conn->prepare($check_query);
		$stmt_check->bind_param("s", $username);
		$stmt_check->execute();
		$result = $stmt_check->get_result();
		$row = $result->fetch_assoc();
		if ($row['count'] > 0) {
			throw new Exception("Username must be unique");
		}

		// Check if username is unique in nutritionists_tbl
		$check_query = "SELECT COUNT(*) AS count FROM nutritionists_tbl WHERE username = ?";
		$stmt_check = $conn->prepare($check_query);
		$stmt_check->bind_param("s", $username);
		$stmt_check->execute();
		$result = $stmt_check->get_result();
		$row = $result->fetch_assoc();
		if ($row['count'] > 0) {
			throw new Exception("Username must be unique");
		}

		// Check if username is unique in trainers_tbl
		$check_query = "SELECT COUNT(*) AS count FROM trainers_tbl WHERE username = ?";
		$stmt_check = $conn->prepare($check_query);
		$stmt_check->bind_param("s", $username);
		$stmt_check->execute();
		$result = $stmt_check->get_result();
		$row = $result->fetch_assoc();
		if ($row['count'] > 0) {
			throw new Exception("Username must be unique");
		}

		if ($password != $confirmpassword) {
			throw new Exception("Passwords Must Match");
		} else if (strlen($password) < 8 || !preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $password)) {
			throw new Exception("Password must contain at least one number, one uppercase and one lowercase letter, and be at least 8 characters long.");
		} else {
			$hashpass = password_hash($password, PASSWORD_DEFAULT);

			switch ($registration_type) {
				case 'member':
					$sql = "INSERT INTO members_tbl (fname, lname, uname, city, email, weight, gender, contact, pwd)
								VALUES ('$firstname','$lastname','$username','$city','$email','$weight','$gender','$contact','$hashpass');";
					mysqli_query($conn, $sql);
					echo "<script>alert('You are now Registered')</script>";
					echo "<script>window.location='login.php';</script>";

					break;

				case 'nutritionist':

					$sql = "INSERT INTO nutritionists_tbl (first_name, last_name, username, city, contact,gender,pwd,email, image)
								VALUES ('$firstname','$lastname','$username','$city','$contact','$gender','$hashpass','$email', '$image');";
					mysqli_query($conn, $sql);
					move_uploaded_file($_FILES['image']['tmp_name'], "$image");
					echo "<script>alert('You are now Registered')</script>";
					echo "<script>window.location='login.php';</script>";
					break;

				case 'personal_trainer':
				case 'yoga':
				case 'taekwondo':
				case 'aerobics':

					$sql = "INSERT INTO trainers_tbl (first_name, last_name, username, city, contact, trainer_type, gender, pwd, email, images)
									VALUES ('$firstname', '$lastname', '$username', '$city','$contact', '$registration_type','$gender', '$hashpass','$email', '$image');";
					if (mysqli_query($conn, $sql)) {

						move_uploaded_file($_FILES['image']['tmp_name'], "$image");
						echo "<script>alert('You are now Registered')</script>";
						echo "<script>window.location='login.php';</script>";
					}

					break;


				default:
					throw new Exception("Invalid registration type");
					break;
			}
		}
	}
} catch (Exception $e) {
	echo "<script>
            alert('" . $e->getMessage() . "');
            window.history.back();
          </script>";
}

mysqli_close($conn);
?>