<!DOCTYPE html>
<html lang="en">
<?php
$firstName = '';
$lastName = '';

if (isset($_GET['firstName']) && isset($_GET['lastName']) && isset($_GET['memberid'])) {
  $firstName = urldecode($_GET['firstName']);
  $lastName = urldecode($_GET['lastName']);
  $memberid = urldecode($_GET['memberid']);
}
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Landing Page</title>
  <link rel="icon" type="image/png" href="/pictures/logo.png">
  <link rel="stylesheet" href="/mycss/css/mycss2.min.css">
  <style>
    #home{
      background-image:url(/pictures/homepage.jpg);
      background-size: cover;
      color:aliceblue;
      height: 400px;
      text-align: center;
      padding-top: 150px;
    }
    #trainers{
      background-image:url(/pictures/apply_trainer.jpg);
      background-size: cover;
      height: 500px;
    }
    #contactus{
      background-image:url(/pictures/panel_1.jpg);
      background-size: cover;
    }
  </style>
</head>

<body>
  <!-- Header -->
  <header class="bg-dark text-light py-3">
    <div class="container d-flex align-items-center">
      <img src="/pictures/logo.png" alt="Logo" class="me-3" style="width: 80px;">
      <h1 class="h4 m-0">Welcome to Our Fitness Center</h1>
    </div>
    <nav class="container mt-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><a class="nav-link text-light" href="#home">Home</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#services">Services</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#aboutus">About Us</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#trainers">Trainers</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#nutritionists">Nutritionists</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#contactus">Contact Us</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#" data-bs-toggle="offcanvas" data-bs-target="#mySchedulesSidebar">My Schedules</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="#" data-bs-toggle="offcanvas" data-bs-target="#myDietSidebar">Dietary Plans</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="/progress.php?memberid=<?php echo urlencode($memberid); ?>">Progress Report</a></li>
        <li class="nav-item"><a class="nav-link text-light" href="/termsofservice.html">Terms of Service</a></li>
      </ul>
    </nav>
  </header>

  <!-- Offcanvas: Dietary Plans Sidebar -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="myDietSidebar" aria-labelledby="myDietSidebarLabel">
    <div class="offcanvas-header">
      <h5 id="myDietSidebarLabel">Dietary Plans</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <h2 class="mb-4">My Dietary Plans</h2>
      <form action="download_nu_file.php" method="get">
        <input type="hidden" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <input type="hidden" name="memberid" value="<?php echo htmlspecialchars($memberid); ?>">
        <input type="submit" class="btn btn-dark" value="Download Plan">
      </form>
    </div>
  </div>

  <!-- Offcanvas: My Schedules Sidebar -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="mySchedulesSidebar" aria-labelledby="mySchedulesSidebarLabel">
    <div class="offcanvas-header">
      <h5 id="mySchedulesSidebarLabel">My Schedules</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <form action="/download_t_files.php" method="get" class="mb-4">
        <h4>From Personal Trainer</h4>
        <input type="hidden" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <input type="hidden" name="memberid" value="<?php echo htmlspecialchars($memberid); ?>">
        <input type="hidden" name="registration_type" value="personal_trainer">
        <input type="submit" class="btn btn-dark" value="Download Schedule">
      </form>
      <form action="/download_t_files.php" method="get">
        <h4>From Regular Trainers</h4>
        <input type="hidden" name="firstName" value="<?php echo htmlspecialchars($firstName); ?>">
        <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($lastName); ?>">
        <input type="hidden" name="memberid" value="<?php echo htmlspecialchars($memberid); ?>">
        <div class="mb-3">
          <label for="registration_type" class="form-label">Category From:</label>
          <select id="registration_type" name="registration_type" class="form-select" required>
            <option value="select_option">Select option</option>
            <option value="yoga">Yoga Instructor</option>
            <option value="taekwondo">Taekwondo</option>
            <option value="aerobics">Aerobics Instructor</option>
          </select>
        </div>
        <input type="submit" class="btn btn-dark" value="Download Schedule">
      </form>
    </div>
  </div>


  <!-- Home Section -->
  <section id="home">
    <div class="container">
      <h1 class="display-3">Health and Fitness Center</h1>
    </div>
  </section>

  <!-- Services Section -->
  <section id="services" class="py-5">
    <div class="container">
      <h2 class="text-center mb-5">Our Services</h2>
      <div class="row">
        <div class="col-md-4">
          <p>Nutrition Guidance: Fuel your body for success with our expert nutrition guidance. Our registered dietitians develop personalized nutrition plans based on your dietary preferences, health goals, and lifestyle. From meal planning and nutritional counseling to grocery shopping tips and recipe ideas, we provide the support and resources you need to make healthy eating a sustainable part of your lifestyle.</p>
        </div>
        <div class="col-md-4">
          <p>Personalized Workout: Receive one-on-one guidance from our team of certified fitness trainers who create personalized workout plans tailored to your specific needs and goals. Whether you're aiming to build muscle, improve flexibility, or enhance overall fitness, our trainers will design a customized program that suits your fitness level and preferences.</p>
        </div>
        <div class="col-md-4">
          <p>Trainer Guidance: Benefit from expert advice and support from our team of experienced fitness trainers. Receive personalized coaching, technique correction, and workout tips to maximize your results and prevent injuries. Whether you're looking for guidance on proper form, exercise modifications, or advanced training techniques, our trainers are here to support you every step of the way.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- About Us Section -->
  <section id="aboutus" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-5">About Us</h2>
      <div class="row">
        <div class="col">
          <p>At ourHealth and Fitness Management System, our mission is to empower individuals on their journey to better health and fitness. Our platform is designed to provide users with comprehensive tools and resources to achieve their fitness goals, whether it's building strength, losing weight, improving endurance, or simply adopting a healthier lifestyle. With customizable workout plans, personalized nutrition guidance, and intuitive progress tracking features, we strive to make fitness accessible, enjoyable, and sustainable for everyone. Join our community today and embark on a transformative journey towards a happier, healthier you.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Trainers Section -->
  <section id="trainers" class="py-5">
    <div class="container">
      <h2 class="text-center mb-5" style="color: aliceblue;">Our Trainers</h2>
      <div class="row g-4">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body text-center">
              <h4 class="card-title">Aerobics</h4>
              <p class="card-text">Our team of certified aerobics instructors is dedicated to guiding and inspiring you through dynamic and energizing aerobic workouts.</p>
              <a href="aerobicsinstructors.php" class="btn btn-dark">View Instructors</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body text-center">
              <h4 class="card-title">Tae Kwondo</h4>
              <p class="card-text">Our team of experienced and certified Tae Kwon Do instructors is dedicated to providing high-quality martial arts instruction.</p>
              <a href="taekwondoinstructors.php" class="btn btn-dark">View Instructors</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body text-center">
              <h4 class="card-title">Yoga</h4>
              <p class="card-text">Our certified yoga instructors guide you through mindful practices that enhance flexibility, strength, and mental clarity.</p>
              <a href="/yogainstructors.php" class="btn btn-dark">View Instructors</a>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body text-center">
              <h4 class="card-title">Personal Trainers</h4>
              <p class="card-text">Our certified personal trainers provide one-on-one guidance to help you achieve your fitness goals with customized workout plans.</p>
              <a href="/personaltrainerinstructors.php" class="btn btn-dark">View Trainers</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Nutritionists Section -->
  <section id="nutritionists" class="bg-light py-5">
    <div class="container">
      <h2 class="text-center mb-5">Our Nutritionists</h2>
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card">
            <div class="card-body text-center">
              <p>Our team of experienced and certified nutritionists is dedicated to helping you achieve your health and fitness goals through personalized nutrition guidance.</p>
              <a href="/nutritionist_application_page.php" class="btn btn-dark">View Nutritionists</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Us Section -->
  <section id="contactus" class="py-5 text-light">
    <div class="container">
      <h2 class="text-center mb-5">Contact Us</h2>
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Your Name</label>
              <input type="text" id="name" class="form-control" placeholder="Enter your name">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Your Email</label>
              <input type="email" id="email" class="form-control" placeholder="Enter your email">
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Your Message</label>
              <textarea id="message" class="form-control" rows="4" placeholder="Enter your message"></textarea>
            </div>
            <button type="submit" class="btn btn-dark">Send Message</button>
          </form>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-dark text-light text-center py-4">
    <div class="container">
      <p class="m-0">&copy; 2024Health and Fitness Management System. All Rights Reserved.</p>
    </div>
  </footer>

</body>
<script src="/mycss/javascript/js2.bundle.min.js"></script>

</html>