<?php
session_start();
include('./connection.php');
// include('./restrictuser.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home page</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="userassets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="userassets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="userassets/css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="index.php">Gym Management</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#home">Home</a></li>
          <li><a class="nav-link scrollto" href="#services">Our Services</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <?php if (isset($_SESSION['user'])) { ?>
            <li><a class="nav-link scrollto" href="settings_user.php#profile">Profile</a></li>
            <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
          <?php } else if (isset($_SESSION['employee'])) { ?>
            <li><a class="nav-link scrollto" href="logout.php">Logout</a></li>
          <?php } else { ?>
            <li><a class="nav-link scrollto" href="login.php#login">Login</a></li>
          <?php } ?>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>
      <!-- .navbar -->

    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="home">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        <div class="carousel-inner" role="listbox">

          <!-- Slide 1 -->
          <div class="carousel-item active" style="background: url(userassets/img/slide/slide-1.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Don’t be scared to LIFT HEAVY!</h2>
                <p class="animate__animated animate__fadeInUp">Something that women who workout often need to hear, Jessie reminds us that lifting heavy is not just for the boys. Bodybuilding is about a lot more than just looks. Lift to gain confidence. Lift to feel strong. Life to feel amazing.</p>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="carousel-item" style="background: url(userassets/img/slide/slide-2.jpg);">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Winners do what they fear</h2>
                <p class="animate__animated animate__fadeInUp">In a similar vein to ‘nothing great happens in your comfort zone’, this quote is a gentle nudge to challenge ourselves to do things that scare us. Not to be taken too literally, it’s a reminder that bravery can often lead to success.</p>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="carousel-item" style="background: url(userassets/img/slide/slide-3.jpg);">
            <div class="carousel-background"><img src="userassets/img/slide/slide-3.jpg" alt=""></div>
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Wake up determined. Go to bed satisfied</h2>
                <p class="animate__animated animate__fadeInUp">Finishing off with a classic quote from all time bodybuilding legend, The Rock. This quote lets us know that strength, fitness, and building muscle requires daily commitment. It doesn’t happen over night, over a week, or even over a month. It’s a lifestyle that needs long term and continual work in order to see the benefits.</p>
              </div>
            </div>
          </div>

        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Our Services</h2>
          <p>Each workout will consist of mainly compound movements with a mix of various accessory exercises to minimize any potential muscle imbalances.
            So with that being said, let’s take a look at what the optimal full body workout might look like..</p>
        </div>
        <!-- card -->

        <div class="card-deck row">
          <?php
          $sql = "select * from package";
          $res = mysqli_query($conn, $sql);
          if (mysqli_num_rows($res) > 0) {

            while ($row = mysqli_fetch_array($res)) {

              $id = $row['id'];
              $trainer = $row['trainer'];
              $plan = $row['plan'];
              $duration = $row['duration'];
              $amount = $row['amount'];
              $status = $row['status'];
              $plan_image = $row['plan_image'];
              $description = $row['description'];



              $sqlpln = "select * from plan where plan_id='$plan'";
              $respln = mysqli_query($conn, $sqlpln);
              $rowpln = mysqli_fetch_array($respln);
              $planname = $rowpln['plan_name'];

              $sqltrainer = "select * from employee where emp_id='$trainer'";
              $restrainer = mysqli_query($conn, $sqltrainer);
              $rowtrainer = mysqli_fetch_array($restrainer);
              $trainername = $rowtrainer['emp_fname']


          ?>
              <div class="card col-md-4">
                <h4 class="card-title mt-3 text-center"><?php echo $planname; ?><span style="font-size: 10px;" class="badge top-0 <?php if ($status == 'available') echo "bg-success";
                                                                                                                                  else echo "bg-warning"; ?>"><?php echo $status; ?></span></h4>
                <div class="card-title text-center">Trainer Name: <?php echo $trainername; ?></div>

                <?php if (!empty($plan_image)) : ?>
                  <img src="uploads/<?php echo $plan_image ?>" class="card-img-top" height="350px">
                <?php else : ?>
                  <img src="uploads/Fitness.png" class="card-img-top" height="350px">
                <?php endif ?>

                <div class="card-body">
                  <p class="card-text"><?php echo $description; ?></p>
                </div>
                <div class="card-footer">
                  <a href="package_detail_for_user.php?pckid=<?php echo $id; ?>" class="btn btn-primary <?php if ($status == 'unavailable') echo "disabled" ?>" style="width: 100%;">View</a>
                </div>
              </div>
            <?php }
          } else { ?>
            <div>No record found</div>
          <?php } ?>
        </div>


      </div>
    </section><!-- End Services Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row no-gutters">
          <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>
          <div class="col-xl-7 ps-0 ps-lg-5 pe-lg-1 d-flex align-items-stretch">
            <div class="content d-flex flex-column justify-content-center">
              <h3>Arnold's Classic Shoulder and Arms Workout</h3>
              <p>
                No bodybuilder was as renowned as Arnold for his huge arms and massive delts. And no bodybuilder trained as hard. Here's his blueprint and workout for world-class upper-body development!
              </p>
              <div class="row">
                <div class="col-md-6 icon-box">
                  <i class="bx bx-receipt"></i>
                  <h4>Arm Workouts for Women: Build Shape, Size, and Strength!</h4>
                  <p>Girls need curls, too! If you want to really rock that tank top at the gym or go sleeveless during summer, then doing the best arm exercises for women is a must. Learn all about arm training and try three full workouts to sculpt your arms!</p>
                </div>
                <div class="col-md-6 icon-box">
                  <i class="bx bx-cube-alt"></i>
                  <h4>Why Do Muscles Fatigue?</h4>
                  <p>There are several factors that can produce fatigue, and although sleep, nutrition, and recovery time are all fantastic strategies to overcome it, supplementation plays a more critical role than you might think.</p>
                </div>
                <div class="col-md-6 icon-box">
                  <i class="bx bx-images"></i>
                  <h4>The Science of Muscle Recovery: The Role of Active Recovery</h4>
                  <p>It may not be as cool as hitting a PR, but active recovery sets the stage for bigger and better training sessions down the line. Here's your ultimate guide to active recovery.</p>
                </div>
                <div class="col-md-6 icon-box">
                  <i class="bx bx-shield"></i>
                  <h4>The Science of Muscle Recovery: How Long Should You Rest Between Workouts?</h4>
                  <p>It's not how hard you train, but what you can recover from that matters. Learn which factors affect your recovery and how to find the weekly schedule that works for you.</p>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section>
    <!-- End About Section -->



    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Contact Us</h2>
        </div>

        <div class="row contact-info">

          <div class="col-md-4">
            <div class="contact-address">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <address>Somewhere on earth</address>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-phone">
              <i class="bi bi-phone"></i>
              <h3>Phone Number</h3>
              <p><a href="tel:+940777123456">+940777123456</a></p>
            </div>
          </div>

          <div class="col-md-4">
            <div class="contact-email">
              <i class="bi bi-envelope"></i>
              <h3>Email</h3>
              <p><a href="mailto:info@example.com">info@example.com</a></p>
            </div>
          </div>

        </div>

        <div class="form">
          <form method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars">
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email">
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="my-3">
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your message has been sent. Thank you!</div>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>
        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>2021</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        Designed by Laily
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="userassets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Template Main JS File -->
  <script src="userassets/js/main.js"></script>
</body>

</html>