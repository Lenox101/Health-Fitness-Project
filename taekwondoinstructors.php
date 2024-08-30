<?php
include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tae Kwondo</title>
	<link rel="icon" type="image/png" href="/pictures/logo.png">
	<style>
		/* Body styles */
		body {
			font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
			color: #333;
			display: flex;
			background-image: url(/pictures/taekwondo2.jpg);
			background-size: cover;
		}

		.container .instructors .box-container {
			display: flex;
			padding: 70px;
			flex-wrap: wrap;
			gap: 50px;
			justify-content: center;
		}

		.container .instructors .box-container .box {
			text-align: center;
			border-radius: 5px;
			position: relative;
			padding: 20px;
			background-color: rgba(255, 255, 255, 0.8);
			width: 210px;
		}

		.container .instructors .box-container .box .text {
			padding: 10px;
		}

		.btn {
			background-color: #4CAF50;
			/* Green */
			color: #ffffff;
			padding: 10px 20px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.btn:hover {
			background-color: #3e8e41;
			/* Dark Green */
		}

		.btn-primary {
			background-color: #337ab7;
			/* Blue */
			color: #ffffff;
		}

		.btn-primary:hover {
			background-color: #23527c;
			/* Dark Blue */
		}

		#cityDropdown {
			width: 230px;
			padding: 5px;
			margin-top: 5px;
			border-radius: 4px;
			color: #000;
		}

		#citySection {
			padding-left: 500px;
			color: aliceblue;

		}

		#formContainer {
			margin: 8% auto;
			min-height: 60%;
			width: 50%;
			box-shadow: 0 2px 16px rgba(0, 0, 0, 0.6);
			background: white;
			padding: 0px 0px 5px 15px;
			box-sizing: border-box;
			border-radius: 8px;
		}

		.formInput {
			display: block;
			margin: 0px 0px 15px 20px;
			padding: 17px;
			width: 80%;
			height: 5%;
			box-sizing: border-box;
			border: none;
			outline: none;
			border-bottom: 1px solid #aaa;
			font-size: 14px;
		}

		#whatsapp_link {
			width: 30%;
			padding: 10px;
			background-color: #4CAF50;
			border: none;
			border-radius: 3px;
			cursor: pointer;
			transition: background-color 0.8s;
		}

		#whatsapp_link:hover {
			background-color: #193a1b;
		}

		.back-button {
			background-color: #04AA6D;
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 10px 0;
			cursor: pointer;
			border-radius: 5px;
			position: absolute;
			top: 20px;
			left: 20px;
		}
	</style>
</head>

<body>
	<button onclick="goBack()" class="back-button">&#8592; Back</button>
	<div class="container">
		<div class="instructors">
			<h1 style="padding-left:440px; color:aliceblue;">Tae Kwondo Instructors</h1>
			<form action="taekwondoinstructors.php" method="post">
				<div id="citySection">
					<h2>Select City:</h2>
					<select id="cityDropdown" name="cityDropdown">
						<option value="">Select City</option>
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
					<input style="margin-left: 580px; margin-top: 20px;" type="submit" value="search" id="search" class="btn btns">
				</div>
			</form>
			<div class="box-container" id="instructorBoxContainer">
				<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					$city = $_POST['cityDropdown'];

					$sql = "SELECT * FROM `trainers_tbl` WHERE city = '$city' AND status = 'Approved' AND trainer_type = 'taekwondo'";

					$select_instructor = mysqli_query($conn, $sql);
					if (mysqli_num_rows($select_instructor) > 0) {
						while ($fetch_info = mysqli_fetch_assoc($select_instructor)) {
							$image_path = $fetch_info['images'];
				?>
							<div class="box sourceDiv">
								<img src="<?php echo $image_path; ?>" width="110" style="border-radius: 3px;">
								<div class="text id">Id: <?php echo $fetch_info['id']; ?></div>
								<div class="text first-name">First Name: <?php echo $fetch_info['first_name']; ?></div>
								<div class="text last-name">Last Name: <?php echo $fetch_info['last_name']; ?></div>
								<div class="text" id="city">City: <?php echo $fetch_info['city']; ?></div>
								<div class="text" id="gender">Gender: <?php echo $fetch_info['gender']; ?></div>
								<div class="text" id="status">Status: <?php echo $fetch_info['status']; ?></div>
								<input type="submit" onclick="showFormContainer(); autoFill(this);" value="Apply" name="Apply" class="btn btns">

							</div>
				<?php
						};
					} else {
						echo "<script>alert('There are no Trainers in this Area')</script>";
						echo "<script>window.location='taekwondoinstructors.php';</script>";
					}
				}
				?>
			</div>
			<div id="formContainer" style="display: none;">
				<form action="/insert_applications/taekwondo_requests.php" method="post">
					<br>
					<h2>Payment Form</h2>
					<label for="Instructor's First Name">Instructor's First Name</label>
					<input type="text" name="instructor's_first_name" class="formInput" readonly>

					<label for="Instructor's Last Name">Instructor's Last Name</label>
					<input type="text" name="instructor's_last_name" class="formInput" readonly>

					<label for="Instructor's Id">Instructor's Id</label>
					<input type="text" name="instructor's_id" class="formInput" readonly>

					<input type="text" onkeypress="return restrictNumbers(event)" name="FirstName" class="formInput" placeholder="Enter Your First Name" required>
					<input type="text" onkeypress="return restrictNumbers(event)" name="LastName" class="formInput" placeholder="Enter Your Last Name" required>
					<input type="number" name="Weight" class="formInput" placeholder="Enter Your Weight in Kg" required>
					<input type="number" name="contact" class="formInput" placeholder="Phone Number" required>
					<input type="email" name="email" class="formInput" placeholder="Enter Your Email" required />
					<label for="gender"> Gender</label><br>
					<input type="radio" name="gender" value="Male" required />Male
					<input type="radio" name="gender" value="Female" required>Female <br><br>
					<label for="gender"> Payment Method:</label><br>
					<input type="radio" name="payment_method" value="M-pesa" />M-pesa
					<input type="radio" name="payment_method" value="Pay_Pal" />Pay Pal
					<br><br>
					<div id="payment" style="display:none;">
						<label for="Fee"> Fee: KSH 6000/-</label><br>
						<p id="Mpesa_Fee" style="display: none;">Send Fee to Mpesa Send Money "0791178996"</p>
						<p id="PayPal_Fee" style="display: none;">Send Fee to account number "0791178996"</p>
						<label for="whatsapp_link">Send Payment ScreenShot</label><br><br>
						<a id="whatsapp_link" style="text-decoration: none;color:aliceblue;" href="https://api.whatsapp.com/send?phone=+254791178996&text=Hello.%20Below%20is%20my%20Proof%20of%20Payment" target="_blank">Send Screenshort</a>
					</div>
					<br>
					<br>
					<div id="request" style="display: none;">
						<input type="submit" class="btn btn-primary" style="margin-left: 110px;" name="submitButton" value="Send Request"><br><br>
					</div>
				</form>
			</div>


		</div>
	</div>
	<script>
		// Get the radio buttons, the payment div, and the request div
		const radioButtons = document.querySelectorAll('input[name="payment_method"]');
		const Mpesa_Fee = document.getElementById('Mpesa_Fee');
		const PayPal_Fee = document.getElementById('PayPal_Fee');
		const paymentDiv = document.getElementById('payment');
		const requestDiv = document.getElementById('request');

		// Add a change event listener to the radio buttons
		radioButtons.forEach(radioButton => {
			radioButton.addEventListener('change', () => {
				if (radioButton.checked) {
					if (radioButton.value === 'M-pesa') {
						Mpesa_Fee.style.display = 'block';
						PayPal_Fee.style.display = 'none';
					} else if (radioButton.value === 'Pay_Pal') {
						PayPal_Fee.style.display = 'block';
						Mpesa_Fee.style.display = 'none';
					} else {
						Mpesa_Fee.style.display = 'none';
						PayPal_Fee.style.display = 'none';
					}
					// If either radio button is selected, show the payment div
					paymentDiv.style.display = 'block';
				}
			});
		});

		// Add a click event listener to the WhatsApp button
		document.getElementById('whatsapp_link').addEventListener('click', () => {
			// Add a delay before showing the request div
			setTimeout(() => {
				requestDiv.style.display = 'block';
			}, 3000); // 3000 milliseconds = 3 seconds
		});

		function showFormContainer() {
			document.getElementById('formContainer').style.display = 'block';
		}

		function restrictNumbers(e) {
			var x = e.which || e.keycode;
			if (/\d/.test(String.fromCharCode(x))) {
				return false;
			} else {
				return true;
			}
		}

		function autoFill(element) {
			var sourceDiv = element.parentElement; // Get the parent element (box) of the clicked button
			var firstName = sourceDiv.querySelector('.first-name').textContent.split(': ')[1];
			var lastName = sourceDiv.querySelector('.last-name').textContent.split(': ')[1];
			var id = sourceDiv.querySelector('.id').textContent.split(': ')[1];

			// Autofill textboxes in target div
			document.querySelector("input[name=\"instructor's_first_name\"]").value = firstName;
			document.querySelector("input[name=\"instructor's_last_name\"]").value = lastName;
			document.querySelector("input[name=\"instructor's_id\"]").value = id;
		}

		function goBack() {
			window.history.back();
		}
	</script>

</body>

</html>