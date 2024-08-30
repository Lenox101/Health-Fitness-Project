<?php
include('db_connection.php');

// Query to calculate average weight by gender
$sql_gender = "SELECT gender, AVG(weight) AS avg_weight FROM members_tbl GROUP BY gender";
$result_gender = $conn->query($sql_gender);

// Queries to count the number of unique members who have applied to different services
$sql_nutritionist_applicants = "SELECT COUNT(DISTINCT MemberId) AS total_applicants FROM nutritionistapplicants WHERE status = 'Paid'";
$sql_yoga_applicants = "SELECT COUNT(DISTINCT MemberId) AS total_applicants FROM yogaapplicants WHERE status = 'Paid'";
$sql_taekwondo_applicants = "SELECT COUNT(DISTINCT MemberId) AS total_applicants FROM taekwondoapplicants WHERE status = 'Paid'";
$sql_personaltrainer_applicants = "SELECT COUNT(DISTINCT MemberId) AS total_applicants FROM personaltrainerapplicants WHERE status = 'Paid'";
$sql_aerobics_applicants = "SELECT COUNT(DISTINCT MemberId) AS total_applicants FROM aerobicsapplicants WHERE status = 'Paid'";

// Execute the queries and fetch the results
$result_nutritionist_applicants = $conn->query($sql_nutritionist_applicants);
$result_yoga_applicants = $conn->query($sql_yoga_applicants);
$result_taekwondo_applicants = $conn->query($sql_taekwondo_applicants);
$result_personaltrainer_applicants = $conn->query($sql_personaltrainer_applicants);
$result_aerobics_applicants = $conn->query($sql_aerobics_applicants);

// Initialize the counts
//The variables are initialized to 0 to ensure that even if no results are found, they have a default value.
$total_nutritionist_applicants = 0;
$total_yoga_applicants = 0;
$total_taekwondo_applicants = 0;
$total_personaltrainer_applicants = 0;
$total_aerobics_applicants = 0;

// Fetch the results into variables
if ($result_nutritionist_applicants->num_rows > 0) {
  $row = $result_nutritionist_applicants->fetch_assoc();
  $total_nutritionist_applicants = $row["total_applicants"]; //For each query result, this block checks if there are any rows returned (num_rows > 0).
  // If there are, it fetches the first row using fetch_assoc() and stores the total_applicants value in the corresponding variable.
}

if ($result_yoga_applicants->num_rows > 0) {
  $row = $result_yoga_applicants->fetch_assoc();
  $total_yoga_applicants = $row["total_applicants"];
}

if ($result_taekwondo_applicants->num_rows > 0) {
  $row = $result_taekwondo_applicants->fetch_assoc();
  $total_taekwondo_applicants = $row["total_applicants"];
}

if ($result_personaltrainer_applicants->num_rows > 0) {
  $row = $result_personaltrainer_applicants->fetch_assoc();
  $total_personaltrainer_applicants = $row["total_applicants"];
}

if ($result_aerobics_applicants->num_rows > 0) {
  $row = $result_aerobics_applicants->fetch_assoc();
  $total_aerobics_applicants = $row["total_applicants"];
}

// Fetch average weight by gender data
$gender_data = [];
if ($result_gender->num_rows > 0) {
  while ($row = $result_gender->fetch_assoc()) { //This code block processes the results from the gender query. 
    //It loops through each row in the result set and stores the data in the $gender_data array.
    $gender_data[] = $row;
  }                   
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Analysis of Average Weight</title>
  <link rel="icon" type="image/png" href="/pictures/logo.png">
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-image: url(/pictures/panel_7.jpg);
      background-size: cover;
    }
    h2, h3 {
      text-align: center;
      color: gainsboro;
      margin-bottom: 20px;
    }
    .chart-container {
      width: 40%;
      margin: auto;
      background-color: rgba(255, 255, 255, 0.8);
      padding: 20px;
      border-radius: 10px;
    }
  </style>
  <script src="/chart.js"></script>
</head>
<body>
  <h2>Analysis of Average Weight by Gender</h2>
  <div class="chart-container">
    <canvas id="barChart"></canvas>
  </div>
  <br>
  <h3>Service Application Report</h3>
  <div class="chart-container">
    <canvas id="pieChart"></canvas>
  </div>

  <script>
    // Data for bar chart (Average Weight by Gender)
    const genderData = <?php echo json_encode($gender_data); ?>;
    const genderLabels = genderData.map(item => item.gender);
    const avgWeightData = genderData.map(item => item.avg_weight);

    // Data for pie chart (Service Applicants)
    const serviceData = {
      labels: [
        'Nutritionist Applicants',
        'Yoga Applicants',
        'Tae Kwon Do Applicants',
        'Personal Trainer Applicants',
        'Aerobics Applicants'
      ],
      datasets: [{
        data: [
          <?php echo $total_nutritionist_applicants; ?>,
          <?php echo $total_yoga_applicants; ?>,
          <?php echo $total_taekwondo_applicants; ?>,
          <?php echo $total_personaltrainer_applicants; ?>,
          <?php echo $total_aerobics_applicants; ?>
        ],
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56',
          '#4BC0C0',
          '#9966FF'
        ]
      }]
    };

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
      type: 'bar',
      data: {
        labels: genderLabels,
        datasets: [{
          label: 'Average Weight',
          data: avgWeightData,
          backgroundColor: '#36A2EB',
          borderColor: '#36A2EB',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });

    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
      type: 'pie',
      data: serviceData,
      options: {
        responsive: true
      }
    });
  </script>
  <!-- This script section uses the Chart.js library to create two charts:
Bar Chart: Displays the average weight by gender. The data and labels are dynamically populated using the $gender_data array from PHP.
Pie Chart: Displays the distribution of applicants across different services. 
The data is dynamically populated using the variables that store the count of applicants for each service. -->
</body>
</html>
