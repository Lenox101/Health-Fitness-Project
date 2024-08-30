<?php
include('db_connection.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['trainerid'])) {
    $trainerid = $_POST['trainerid'];
    $status = $_POST['status'];

    $query = "UPDATE trainers_tbl SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $trainerid);

    if ($stmt->execute()) {
        // Redirect or notify success
        header("Location: adminpanel.php?message=Status+updated+successfully");
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nutritionistid'])) {
    $nutritionistid = $_POST['nutritionistid'];
    $status = $_POST['status'];

    $query = "UPDATE nutritionists_tbl SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $nutritionistid);

    if ($stmt->execute()) {
        // Redirect or notify success
        header("Location: adminpanel.php?message=Status+updated+successfully");
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['N_Atransaction_id'])) {
    $transactionid = $_POST['N_Atransaction_id'];
    $status = $_POST['status'];

    $query = "UPDATE nutritionistapplicants SET status = ? WHERE Transaction_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $transactionid);

    if ($stmt->execute()) {
        // Redirect or notify success
        header("Location: adminpanel.php?message=Status+updated+successfully");
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['PT_Atransaction_id'])) {
    $transactionid = $_POST['PT_Atransaction_id'];
    $status = $_POST['status'];

    $query = "UPDATE personaltrainerapplicants SET status = ? WHERE Transaction_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $transactionid);

    if ($stmt->execute()) {
        // Redirect or notify success
        header("Location: adminpanel.php?message=Status+updated+successfully");
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Y_Atransaction_id'])) {
    $transactionid = $_POST['Y_Atransaction_id'];
    $status = $_POST['status'];

    $query = "UPDATE yogaapplicants SET status = ? WHERE Transaction_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $transactionid);

    if ($stmt->execute()) {
        // Redirect or notify success
        header("Location: adminpanel.php?message=Status+updated+successfully");
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['A_Atransaction_id'])) {
    $transactionid = $_POST['A_Atransaction_id'];
    $status = $_POST['status'];

    $query = "UPDATE aerobicsapplicants SET status = ? WHERE Transaction_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $transactionid);

    if ($stmt->execute()) {
        // Redirect or notify success
        header("Location: adminpanel.php?message=Status+updated+successfully");
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['TKD_Atransaction_id'])) {
    $transactionid = $_POST['TKD_Atransaction_id'];
    $status = $_POST['status'];

    $query = "UPDATE taekwondoapplicants SET status = ? WHERE Transaction_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $transactionid);

    if ($stmt->execute()) {
        // Redirect or notify success
        header("Location: adminpanel.php?message=Status+updated+successfully");
    } else {
        // Handle error
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="120">
    <title>Admin Panel</title>
    <link rel="icon" type="image/png" href="/pictures/logo.png">
    <link rel="stylesheet" href="/mycss/css/mycss2.min.css">
    <style>
        body {
            display: flex;
            background-color: bisque;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .page-header {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }

        table th {
            background-color: #343a40;
            color: #fff;
            text-align: center;
        }

        table td {
            text-align: center;
        }

        .red-button,
        .blue-button {
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .red-button {
            background-color: #dc3545;
        }

        .blue-button {
            background-color: #007bff;
        }

        .red-button:hover,
        .blue-button:hover {
            opacity: 0.8;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        form select {
            border: none;
            background-color: transparent;
            color: #343a40;
            outline: none;
            box-shadow: none;
        }
    </style>
</head>

<body>
    <div class="sidebar bg-dark text-light p-3" style="width: 250px; height: 110vh;">
        <ul class="nav flex-column">
            <li class="nav-item mb-3">
                <div class="d-flex align-items-center">
                    <img src="/pictures/logo_2.png" alt="" class="me-2" style="width: 40px; height: 40px;">
                    <h4 class="mb-0">Admin Dashboard</h4>
                </div>
            </li>
            <li class="nav-item"><a href="#" class="nav-link text-light" onclick="showTable('registeredMembers')">Registered Members</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-light" onclick="showTable('registeredTrainers')">Registered Trainers</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-light" onclick="showTable('registeredNutritionists')">Registered Nutritionists</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-light" onclick="showTable('nutritionistApplicants')">Nutritionist Applicants Report</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-light" onclick="showTable('personalTrainerApplicants')">Personal Trainer Applicants Report</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-light" onclick="showTable('yogaApplicants')">Yoga Applicants Report</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-light" onclick="showTable('aerobicsApplicants')">Aerobics Applicants Report</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-light" onclick="showTable('taekwondoApplicants')">Tae Kwondo Applicants Report</a></li>
            <li class="nav-item"><a href="/members_demographic_report.php" class="nav-link text-light">Members' Reports</a></li>
        </ul>
    </div>

    <div class="content">
        <div class="page-header">
            <h2>Dashboard</h2>
        </div>

        <div id="registeredMembers" class="section">
            <h3>Registered Members</h3></br>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>City</th>
                        <th>Weight in KG</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Last Login</th>
                        <th>Operations</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM members_tbl";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $memberid = $row['id'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $uname = $row['uname'];
                        $city = $row['city'];
                        $weight = $row['weight'];
                        $gender = $row['gender'];
                        $contact = $row['contact'];
                        $last_login = $row['last_login'];
                        echo '<tr>
                                <th scope="row">' . $memberid . '</th>
                                <td>' . $fname . '</td>
                                <td>' . $lname . '</td>
                                <td>' . $uname . '</td>
                                <td>' . $city . '</td>
                                <td>' . $weight . '</td>
                                <td>' . $gender . '</td>
                                <td>' . $contact . '</td>
                                <td>' . $last_login . '</td>
                                <td style="display: flex; justify-content: space-between; gap: 10px;">
                                <a class="red-button" href="memberupdate.php?weight=' . $weight . '&contact=' . $contact . '&uname=' . $uname . '&lname=' . $lname . '&fname=' . $fname . '&memberid=' . $memberid . '" class="no-decoration">Update</a>
                                <a class="blue-button" href="delete.php? deletememberid=' . $memberid . '" class= "no-decoration">Delete</a>
                            </td>
                            </tr>';
                    }
                    ?>

            </table>
        </div>

        <div id="registeredTrainers" class="section">
            <h3>Registered Trainers</h3></br>
            <table>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Username</th>
                <th>City</th>
                <th>Contact</th>
                <th>Trainer Category</th>
                <th>Gender</th>
                <th>Status</th>
                <th>Email</th>
                <th>Operations</th>
                </tr>
                <?php
                $query = "SELECT * FROM trainers_tbl";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $trainerid = $row['id'];
                    $fname = $row['first_name'];
                    $lname = $row['last_name'];
                    $uname = $row['username'];
                    $city = $row['city'];
                    $contact = $row['contact'];
                    $trainer_type = $row['trainer_type'];
                    $gender = $row['gender'];
                    $status = $row['status'];
                    $email = $row['email'];
                    echo '<tr>
                                <th scope="row">' . $trainerid . '</th>
                                <td>' . $fname . '</td>
                                <td>' . $lname . '</td>
                                <td>' . $uname . '</td>
                                <td>' . $city . '</td>
                                <td>' . $contact . '</td>
                                <td>' . $trainer_type . '</td>
                                <td>' . $gender . '</td>
                                <td>
                                    <form action="adminpanel.php" method="POST">
                                        <input type="hidden" name="trainerid" value="' . $trainerid . '">
                                        <select name="status" class="" onchange="this.form.submit()">
                                            <option value="Pending"' . ($status == 'Pending' ? ' selected' : '') . '>Pending</option>
                                            <option value="Approved"' . ($status == 'Approved' ? ' selected' : '') . '>Approved</option>
                                        </select>
                                    </form>
                                </td>
                                <td>' . $email . '</td>
                                <td style="display: flex; justify-content: space-between; gap: 10px;">
                                <a class="red-button" href="trainerupdate.php?contact=' . $contact . '&uname=' . $uname . '&lname=' . $lname . '&fname=' . $fname . '&trainerid=' . $trainerid . '" class="no-decoration">Update</a>
                                <a class="blue-button" href="delete.php? deletetrainerid=' . $trainerid . '" class= "no-decoration">Delete</a>
                            </td>
                            </tr>';
                }
                ?>

            </table>
        </div>

        <div id="registeredNutritionists" class="section">
            <h3>Registered Nutritionists</h3></br>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>City</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Email</th>
                        <th>Operations</th>
                    </tr>

                    <?php
                    $query = "SELECT * FROM nutritionists_tbl";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $nutritionistid = $row['id'];
                        $fname = $row['first_name'];
                        $lname = $row['last_name'];
                        $uname = $row['username'];
                        $city = $row['city'];
                        $contact = $row['contact'];
                        $gender = $row['gender'];
                        $status = $row['status'];
                        $email  = $row['email'];
                        echo '<tr>
                                <th scope="row">' . $nutritionistid . '</th>
                                <td>' . $fname . '</td>
                                <td>' . $lname . '</td>
                                <td>' . $uname . '</td>
                                <td>' . $city . '</td>
                                <td>' . $contact . '</td>
                                <td>' . $gender . '</td>
                                <td>
                                    <form action="adminpanel.php" method="POST">
                                        <input type="hidden" name="nutritionistid" value="' . $nutritionistid . '">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="Pending" ' . ($status == 'Pending' ? 'selected' : '') . '>Pending</option>
                                            <option value="Approved" ' . ($status == 'Approved' ? 'selected' : '') . '>Approved</option>
                                        </select>
                                    </form>
                                </td>
                                <td>' . $email . '</td>
                                <td style="display: flex; justify-content: space-between; gap: 10px;">
                                <a class="red-button" href="nutritionistupdate.php?contact=' . $contact . '&uname=' . $uname . '&lname=' . $lname . '&fname=' . $fname . '&nutritionistid=' . $nutritionistid . '" class="no-decoration">Update</a>
                                <a class="blue-button" href="delete.php? deletenutritionistid=' . $nutritionistid . '" class= "no-decoration">Delete</a>
                            </td>
                            </tr>';
                    }
                    ?>

            </table>
        </div>

        <div id="nutritionistApplicants" class="section">
            <h3>Nutritionist Applicants Report</h3><br>
            <!-- Display table for nutritionist applicants -->
            <table>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Nutritionist's First Name</th>
                        <th>Nutritionist's Last Name</th>
                        <th>Nutritionist Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Weight in KG</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Medical Record</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM nutritionistapplicants";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $transaction_id = $row['Transaction_id'];
                        $nutritionists_first_name = $row['Nutritionist\'s First Name'];
                        $nutritionists_last_name = $row['Nutritionist\'s Last Name'];
                        $nutritionists_id = $row['Nutritionist Id'];
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $weight = $row['Weight'];
                        $contact = $row['Contact'];
                        $gender = $row['Gender'];
                        $Med = $row['name'];
                        $amount = $row['amount'];
                        $status = $row['status'];
                        echo '<tr>
                                <td>' . $transaction_id . '</td>
                                <td>' . $nutritionists_first_name . '</td>
                                <td>' . $nutritionists_last_name . '</td>
                                <td>' . $nutritionistid . '</td>
                                <td>' . $fname . '</td>
                                <td>' . $lname . '</td>
                                <td>' . $weight . '</td>
                                <td>' . $contact . '</td>
                                <td>' . $gender . '</td>
                                <td>' . $Med . '</td>
                                <td>' . $amount . '</td>
                                <td>
                                    <form action="adminpanel.php" method="POST">
                                        <input type="hidden" name="N_Atransaction_id" value="' . $transaction_id . '">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="Paid" ' . ($status == 'Paid' ? 'selected' : '') . '>Paid</option>
                                            <option value="Due" ' . ($status == 'Due' ? 'selected' : '') . '>Due</option>
                                        </select>
                                    </form>
                                </td>
                                
                                <td style="display: flex; justify-content: space-between; gap: 10px;">
                                <a class="red-button" href="nutritionistapplicantsupdate.php? weight=' . $weight . '&contact=' . $contact . '&lname=' . $lname . '&fname=' . $fname . '&nutritionistapplicantsid=' . $transaction_id . '" class="no-decoration">Update</a>
                                <a class="blue-button" href="delete.php? deletenutritionistapplicantsid=' . $transaction_id . '" class= "no-decoration">Delete</a>
                            </td>
                            </tr>';
                    }
                    ?>

            </table>
        </div>

        <div id="personalTrainerApplicants" class="section">
            <h3>Personal Trainer Applicants Report</h3><br>
            <table>
                <thead>
                    <tr>
                        <th>Transaction Id</th>
                        <th>Personal Trainer's First Name</th>
                        <th>Personal Trainer's Last Name</th>
                        <th>Personal Trainer's Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Weight in KG</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Health Record</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM personaltrainerapplicants";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $transaction_id = $row['Transaction_id'];
                        $instructors_first_name = $row['Instructor\'s First Name'];
                        $instructors_last_name = $row['Instructor\'s Last Name'];
                        $instructors_id = $row['Instructor Id'];
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $weight = $row['Weight'];
                        $contact = $row['Contact'];
                        $gender = $row['Gender'];
                        $file = $row['Name'];
                        $amount = $row['amount'];
                        $status = $row['status'];
                        echo '<tr>
                                <td>' . $transaction_id . '</td>
                                <td>' . $instructors_first_name . '</td>
                                <td>' . $instructors_last_name . '</td>
                                <td>' . $instructors_id . '</td>
                                <td>' . $fname . '</td>
                                <td>' . $lname . '</td>
                                <td>' . $weight . '</td>
                                <td>' . $contact . '</td>
                                <td>' . $gender . '</td>
                                <td>' . $file . '</td>
                                <td>' . $amount . '</td>
                                <td>
                                    <form action="adminpanel.php" method="POST">
                                        <input type="hidden" name="PT_Atransaction_id" value="' . $transaction_id . '">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="Paid" ' . ($status == 'Paid' ? 'selected' : '') . '>Paid</option>
                                            <option value="Due" ' . ($status == 'Due' ? 'selected' : '') . '>Due</option>
                                        </select>
                                    </form>
                                </td>
                                <td style="display: flex; justify-content: space-between; gap: 10px;">
                                <a class="red-button" href="personaltrainerapplicantsupdate.php?weight=' . $weight . '&contact=' . $contact . '&lname=' . $lname . '&fname=' . $fname . '&personaltrainerapplicantsid=' . $transaction_id . '" class="no-decoration">Update</a>
                                <a class="blue-button" href="delete.php? deletepersonaltrainerapplicants=' . $transaction_id . '" class= "no-decoration">Delete</a>
                            </td>
                            </tr>';
                    }
                    ?>

            </table>
        </div>

        <div id="yogaApplicants" class="section">
            <h3>Yoga Applicants Report</h3><br>
            <!-- Display table for yoga applicants -->
            <table>
                <thead>
                    <tr>
                        <th>Transaction Id</th>
                        <th>Yoga Trainer's First Name</th>
                        <th>Yoga Trainer's Last Name</th>
                        <th>Yoga Trainer's Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Weight in KG</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM yogaapplicants";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $transaction_id = $row['Transaction_id'];
                        $instructors_first_name = $row['Instructor\'s First Name'];
                        $instructors_last_name = $row['Instructor\'s Last Name'];
                        $instructors_id = $row['Instructor Id'];
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $weight = $row['Weight'];
                        $contact = $row['Contact'];
                        $gender = $row['Gender'];
                        $amount = $row['amount'];
                        $status = $row['status'];

                        echo '<tr>
                                <td>' . $transaction_id . '</td>
                                <td>' . $instructors_first_name . '</td>
                                <td>' . $instructors_last_name . '</td>
                                <td>' . $instructors_id . '</td>
                                <td>' . $fname . '</td>
                                <td>' . $lname . '</td>
                                <td>' . $weight . '</td>
                                <td>' . $contact . '</td>
                                <td>' . $gender . '</td>
                                <td>' . $amount . '</td>
                                <td>
                                    <form action="adminpanel.php" method="POST">
                                        <input type="hidden" name="Y_Atransaction_id" value="' . $transaction_id . '">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="Paid" ' . ($status == 'Paid' ? 'selected' : '') . '>Paid</option>
                                            <option value="Due" ' . ($status == 'Due' ? 'selected' : '') . '>Due</option>
                                        </select>
                                    </form>
                                </td>

                                <td style="display: flex; justify-content: space-between; gap: 10px;">
                                <a class="red-button" href="yogaapplicantsupdate.php? weight=' . $weight . '&contact=' . $contact . '&lname=' . $lname . '&fname=' . $fname . '&yogaapplicantsid=' . $transaction_id . '" class="no-decoration">Update</a>
                                <a class="blue-button" href="delete.php? deleteyogaapplicants=' . $transaction_id . '" class= "no-decoration">Delete</a>
                            </td>
                            </tr>';
                    }
                    ?>

            </table>
        </div>

        <div id="aerobicsApplicants" class="section">
            <h3>Aerobics Applicants Report</h3><br>
            <!-- Display table for aerobics applicants -->
            <table>
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Instructor's First Name</th>
                        <th>Instructor's Last Name</th>
                        <th>Instructor Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Weight in KG</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM aerobicsapplicants";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $transaction_id = $row['Transaction_id'];
                        $instructors_first_name = $row['Instructor\'s First Name'];
                        $instructors_last_name = $row['Instructor\'s Last Name'];
                        $instructors_id = $row['Instructor Id'];
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $weight = $row['Weight'];
                        $contact = $row['Contact'];
                        $gender = $row['Gender'];
                        $amount = $row['amount'];
                        $status = $row['status'];


                        echo '<tr>
                                <td>' . $transaction_id . '</td>
                                <td>' . $instructors_first_name . '</td>
                                <td>' . $instructors_last_name . '</td>
                                <td>' . $instructors_id . '</td>
                                <td>' . $fname . '</td>
                                <td>' . $lname . '</td>
                                <td>' . $weight . '</td>
                                <td>' . $contact . '</td>
                                <td>' . $gender . '</td>
                                <td>' . $amount . '</td>
                                <td>
                                    <form action="adminpanel.php" method="POST">
                                        <input type="hidden" name="A_Atransaction_id" value="' . $transaction_id . '">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="Paid" ' . ($status == 'Paid' ? 'selected' : '') . '>Paid</option>
                                            <option value="Due" ' . ($status == 'Due' ? 'selected' : '') . '>Due</option>
                                        </select>
                                    </form>
                                </td>

                                <td style="display: flex; justify-content: space-between; gap: 10px;">
                                <a class="red-button" href="aerobicsapplicantsupdate.php? weight=' . $weight . '&contact=' . $contact . '&lname=' . $lname . '&fname=' . $fname . '&aerobicsapplicantsid=' . $transaction_id . '" class="no-decoration">Update</a>
                                <a class="blue-button" href="delete.php? deleteaerobicsapplicantsid=' . $transaction_id . '" class= "no-decoration">Delete</a>
                            </td>
                            </tr>';
                    }
                    ?>

            </table>
        </div>

        <div id="taekwondoApplicants" class="section">
            <h3>Tae Kwondo Applicants Report</h3><br>
            <!-- Display table for taekwondo applicants -->
            <table>
                <thead>
                    <tr>
                        <th>Transaction Id</th>
                        <th>Instructor's First Name</th>
                        <th>Instructor's Last Name</th>
                        <th>Instructor's Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Weight in KG</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Operations</th>
                    </tr>
                    <?php
                    $query = "SELECT * FROM taekwondoapplicants";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $transaction_id = $row['Transaction_id'];
                        $instructors_first_name = $row['Instructor\'s First Name'];
                        $instructors_last_name = $row['Instructor\'s Last Name'];
                        $instructors_id = $row['Instructor Id'];
                        $fname = $row['FirstName'];
                        $lname = $row['LastName'];
                        $weight = $row['Weight'];
                        $contact = $row['Contact'];
                        $gender = $row['Gender'];
                        $amount = $row['amount'];
                        $status = $row['status'];
                        echo '<tr>
                                <td>' . $transaction_id . '</td>
                                <td>' . $instructors_first_name . '</td>
                                <td>' . $instructors_last_name . '</td>
                                <td>' . $instructors_id . '</td>
                                <td>' . $fname . '</td>
                                <td>' . $lname . '</td>
                                <td>' . $weight . '</td>
                                <td>' . $contact . '</td>
                                <td>' . $gender . '</td>
                                <td>' . $amount . '</td>
                                <td>
                                    <form action="adminpanel.php" method="POST">
                                        <input type="hidden" name="TKD_Atransaction_id" value="' . $transaction_id . '">
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="Paid" ' . ($status == 'Paid' ? 'selected' : '') . '>Paid</option>
                                            <option value="Due" ' . ($status == 'Due' ? 'selected' : '') . '>Due</option>
                                        </select>
                                    </form>
                                </td>

                                <td style="display: flex; justify-content: space-between; gap: 10px;">
                                <a class="red-button" href="taekwondoapplicantsupdate.php? weight=' . $weight . '&contact=' . $contact . '&lname=' . $lname . '&fname=' . $fname . '&taekwondoapplicantsid=' . $transaction_id . '" class="no-decoration">Update</a>
                                <a class="blue-button" href="delete.php? deletetaekwondoapplicants=' . $transaction_id . '" class= "no-decoration">Delete</a>
                            </td>
                            </tr>';
                    }
                    ?>

            </table>
        </div>

    </div>
    <script src="/mycss/javascript/js2.bundle.min.js"></script>
    <script src="/mycss/javascript/pp.min.js"></script>
    <script src="/mycss/javascript/jquery.slim.min.js"></script>
    <script>
        function showTable(sectionId) {
            // Hide all sections
            var sections = document.querySelectorAll('.section');
            sections.forEach(function(section) {
                section.style.display = 'none';
            });

            // Show the selected section
            var selectedSection = document.getElementById(sectionId);
            selectedSection.style.display = 'block';
        }
        // Hide all sections by default
        var sections = document.querySelectorAll('.section');
        sections.forEach(function(section) {
            section.style.display = 'none';
        });
    </script>
</body>

</html>