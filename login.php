<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="icon" type="image/png" href="/pictures/logo.png">
    <style>
        body {
            background-image: url(/pictures/homepage.jpg);
            background-size: cover;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .container {
            width: 300px;
            background-color: rgba(255, 255, 255, 0.7);
            padding: 20px;
            margin: 50px auto;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.9);
            position: relative;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .container label {
            display: block;
            margin-bottom: 5px;
        }

        .container input[type="text"],
        .container input[type="password"],
        .container input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .container button[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color:black;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.5s;
        }

        .container button[type="submit"]:hover {
            background-color:gray;
        }

        .link-div {
            text-align: center;
            padding: 20px;
        }

        .link-text {
            color: #007bff;
            /* Blue color for the link */
            text-decoration: none;
            /* Remove underline */
            font-size: 16px;
            font-weight: bold;
        }

        .link-text:hover {
            text-decoration: underline;
            /* Underline when hovered */
            cursor: pointer;
            /* Show hand cursor on hover */
        }

        #registration_type {
            width: 100%;
            padding: 5px;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }

        #regtypebox {
            padding-bottom: 20px;
        }

        #error_message {
            color: red;
            display: none;
        }

        .toggle-password {
            position: absolute;
            top: 225px;
            right: 28px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
            <label for="username">Username:</label>
            <input type="text" id="username" onkeypress="return restrictNumbers(event)" name="username" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <span class="toggle-password" onclick="togglePassword()">Show</span>
            <div id="regtypebox">
                <label for="registration_type">Category</label>
                <select id="registration_type" name="registration_type" required>
                    <option value="select_option">Select option</option>
                    <option value="nutritionist">Nutritionist</option>
                    <option value="personal_trainer">Personal Trainer</option>
                    <option value="yoga">Yoga Instructor</option>
                    <option value="taekwondo">Taekwondo</option>
                    <option value="aerobics">Aerobics Instructor</option>
                    <option value="member">Member</option>
                    <option value="admin">Administrator</option>
                </select>
            </div>
            <button type="submit">Login</button>
            <div class="link-div">
                <a href="/forgotpass/forgot_password.php" class="link-text">Forgot Password</a></br><br>
                <a href="registration_page.php" class="link-text">Don't have an account? Sign Up</a>
            </div>
        </form>
    </div>
</body>

<script>
    document.getElementById('registration_type').addEventListener('change', function() {
        var idbox = document.getElementById('idbox');
        var id_input = document.getElementById('id_input');
        var error_message = document.getElementById('error_message');

        if (this.value === 'member' || this.value === 'select_option') {
            idbox.style.display = 'none';
            error_message.style.display = 'none'; // Hide error message if box is hidden
        } else {
            idbox.style.display = 'block';
            if (id_input.value.trim() === "") {
                error_message.style.display = 'inline';
            } else {
                error_message.style.display = 'none';
            }
        }
    });

    function restrictNumbers(e) {
        var x = e.which || e.keycode;
        if (/\d/.test(String.fromCharCode(x))) {
            return false;
        } else {
            return true;
        }
    };

    function togglePassword() {
        const passwordField = document.getElementById('password');
        const togglePassword = document.querySelector('.toggle-password');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            togglePassword.textContent = 'Hide';
        } else {
            passwordField.type = 'password';
            togglePassword.textContent = 'Show';
        }
    }

    //preventing users from navigation to both previous and next pages
    history.pushState(null, null, location.href);
    window.onpopstate = function() {
        history.go(1);
    };

    window.history.forward();

    function noBack() {
        window.history.forward();
    }

    function noForward() {
        window.history.back();
    }

    window.onload = function() {
        noBack();
        noForward();
    };
    window.onpageshow = function(evt) {
        if (evt.persisted) {
            noBack();
            noForward();
        }
    }
    window.onunload = function() {
        void(0);
    }
</script>

</html>
<?php
include('db_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Retrieve username and password from the form
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $registration_category = $_POST['registration_type'];


        switch ($registration_category) {
            case 'member':
                $stmt = $conn->prepare("SELECT * FROM members_tbl WHERE uname = ?");
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Fetch the row containing the member's data
                    $row = $result->fetch_assoc();
                    $member_id = $row['id']; // Retrieve member id
                    // Verify the password
                    if (password_verify($password, $row['pwd'])) {
                        $firstName = $row['fname'];
                        $lastName = $row['lname'];

                        $timestamp_query = "UPDATE members_tbl SET last_login = NOW() WHERE uname = ?";
                        $stmt_update = $conn->prepare($timestamp_query);
                        $stmt_update->bind_param("s", $username);
                        $stmt_update->execute();

                        //Display member id
                        echo "<script>alert('Your Id is $member_id');</script>";
                        // Redirect the user to landing_page.php if username exists in members_tbl
                        echo "<script>window.location='landing_page.php?memberid=$member_id&firstName=$firstName&lastName=$lastName';</script>";
                        exit();
                    } else {
                        // If the password is incorrect, display an error message
                        echo "<script>alert('Invalid Username or Password. Please try again or sign up.')</script>";
                        echo "<script>window.location='login.php';</script>";
                    }
                } else {
                    // If username doesn't exist in members_tbl, display an error message
                    echo "<script>alert('Invalid Username or Password. Please try again or sign up.')</script>";
                    echo "<script>window.location='login.php';</script>";
                }
                $stmt->close();
                break;

            case 'nutritionist':
                $query = "SELECT * FROM nutritionists_tbl WHERE username = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $nutritionist_id = $row['id'];
                    // Verify the hashed password
                    if (password_verify($password, $row['pwd'])) {
                        // Redirect to nutritionist landing page
                        echo "<script>window.location='/staff/nutritionist_landing_page.php?nutritionist_id=$nutritionist_id';</script>";
                        exit();
                    } else {
                        // Incorrect password
                        echo "<script>alert('Invalid Username or Password. Please try again or sign up.')</script>";
                        echo "<script>window.location='login.php';</script>";
                    }
                } else {
                    // Username not found
                    echo "<script>alert('Invalid Username or Password. Please try again or sign up.')</script>";
                    echo "<script>window.location='login.php';</script>";
                }
                $stmt->close();
                break;
            case 'admin':
                $query = "SELECT * FROM admin WHERE username = ? AND password = ?"; // Query to retrieve admin information
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result->num_rows > 0) {
                    // Redirect to admin landing page
                    echo "<script>window.location='adminpanel.php';</script>";
                } else {
                    echo "<script>alert('Invalid Username or Password. Please try again or sign up.')</script>";
                    echo "<script>window.location='login.php';</script>";
                }
                break;
            case 'personal_trainer':
                $query = "SELECT * FROM trainers_tbl WHERE username = ? AND trainer_type = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $username, $registration_category);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $trainer_id = $row['id']; // Retrieve trainer id
                    //Retrieve email
                    $email = $row['email'];
                    // Verify the hashed password
                    if (password_verify($password, $row['pwd'])) {
                        // Redirect to respective trainer landing page
                        echo "<script>window.location='/staff/personal_trainer_landing_page.php?email=$email&trainer_type=$registration_category&trainer_id=$trainer_id';</script>";
                        exit();
                    } else {
                        // Incorrect password
                        echo "<script>alert('Invalid Username or Password. Please try again or sign up.')</script>";
                        echo "<script>window.location='login.php';</script>";
                    }
                } else {
                    // Username not found
                    echo "<script>alert('Invalid Username or Password. Please try again or sign up.')</script>";
                    echo "<script>window.location='login.php';</script>";
                }
                $stmt->close();
                break;

            case 'yoga':
            case 'taekwondo':
            case 'aerobics':
                $query = "SELECT * FROM trainers_tbl WHERE username = ? AND trainer_type = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $username, $registration_category);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $trainer_id = $row['id']; // Retrieve trainer id
                    //Retrieve email
                    $email = $row['email'];
                    // Verify the hashed password
                    if (password_verify($password, $row['pwd'])) {
                        // Redirect to respective trainer landing page
                        echo "<script>window.location='/staff/trainer_landing_page.php?email=$email&trainer_type=$registration_category&trainer_id=$trainer_id';</script>";
                        exit();
                    } else {
                        // Incorrect password
                        echo "<script>alert('Invalid Username or Password. Please try again or sign up.')</script>";
                        echo "<script>window.location='login.php';</script>";
                    }
                } else {
                    // Username not found
                    echo "<script>alert('Invalid Username or Password. Please try again or sign up.')</script>";
                    echo "<script>window.location='login.php';</script>";
                }
                $stmt->close();
                break;

            default:
                echo "<script>alert('Invalid registration category.')</script>";
                echo "<script>window.location='login.php';</script>";
                break;
        }
    } else {
        // If either username or password is missing, display an error message
        echo "<p>Please provide both username and password.</p>";
    }
}
?>