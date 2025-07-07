<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="description" content="Medcity - Medical Healthcare HTML5 Template">
  <link href="assets/images/favicon/favicon.png" rel="icon">
  <title>Care Compass Hospital</title>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
  <link rel="stylesheet" href="assets/css/libraries.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    html {
      scroll-behavior: smooth;
    }

    .suggestions {
      border: 1px solid #ddd;
      max-width: 300px;
      margin-top: 5px;
      background-color: #fff;
      position: absolute;
      z-index: 1000;
    }

    .suggestion-item {
      padding: 10px;
      cursor: pointer;
    }

    .suggestion-item:hover {
      background-color: #f1f1f1;
    }
  </style>
</head>

<body>
  <div class="wrapper">
    <div class="preloader">
      <div class="loading"><span></span><span></span><span></span><span></span></div>
    </div><!-- /.preloader -->

        <!-- Header -->
        <header class="header header-layout1">
          <div class="header-topbar">
            <div class="container-fluid">
              <div class="row align-items-center">
                <div class="col-12">
                  <div class="d-flex align-items-center justify-content-between">
                    <ul class="contact__list d-flex flex-wrap align-items-center list-unstyled mb-0">
                      <li>
                        <button class="miniPopup-emergency-trigger" type="button">24/7 Emergency</button>
                        <div id="miniPopup-emergency" class="miniPopup miniPopup-emergency text-center">
                          <div class="emergency__icon">
                            <i class="icon-call3"></i>
                          </div>
                          <a href="tel:+94715680282" class="phone__number">
                            <i class="icon-phone"></i> <span>+94 71 5680282</span>
                          </a>
                          <p>Please feel free to contact our friendly reception staff with any general or medical enquiry.
                          </p>
                          <a href="appointment.php" class="btn btn__secondary btn__link btn__block">
                            <span>Make Appointment</span> <i class="icon-arrow-right"></i>
                          </a>
                        </div><!-- /.miniPopup-emergency -->
                      </li>
                      <li>
                        <i class="icon-phone"></i><a href="contact-us.html">Emergency Line: +94 71 5680282</a>
                      </li>
                      <li>
                        <i class="icon-location"></i><a href="contact-us.html">Location: Baseline Road, Gampaha</a>
                      </li>
                      <li>
                        <i class="icon-clock"></i><a href="contact-us.html">Mon - Sun: 7:00 am - 12:00 pm</a>
                      </li>
                    </ul><!-- /.contact__list -->
                    <div class="d-flex">
                      <ul class="social-icons list-unstyled mb-0 mr-30">
                        <li><a href="https://www.facebook.com/profile.php?id=61571771665198"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://youtu.be/1R8j3p_9z60?si=blhGbpW6DmtBr-pD" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a></li>
                    </ul><!-- /.social-icons -->                    
                      <form class="header-topbar__search">
                          <input type="text" class="form-control" id="searchInput" placeholder="Search..." oninput="searchItems()" autocomplete="off">
                          <button class="header-topbar__search-btn" type="button"><i class="fa fa-search"></i></button>
                          <div id="suggestions" class="suggestions" style="display: none;"></div>
                      </form>
                    </div>
                  </div>
                </div><!-- /.col-12 -->
              </div><!-- /.row -->
            </div><!-- /.container -->
          </div><!-- /.header-top -->
          <nav class="navbar navbar-expand-lg sticky-navbar">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.php">
                <img src="assets/images/logo/logo.png" class="logo-light" alt="logo">
                <img src="assets/images/logo/logo.png" class="logo-dark" alt="logo">
              </a>
              <button class="navbar-toggler" type="button">
                <span class="menu-lines"><span></span></span>
              </button>
              <div class="collapse navbar-collapse" id="mainNavigation">
                <ul class="navbar-nav ml-auto">
                  <li class="nav__item">
                    <a href="index.php" class="nav__item-link active">Home</a>
                  </li><!-- /.nav-item -->
                  <li class="nav__item">
                    <a href="about-us.php" class="nav__item-link">About Us</a>
                  </li><!-- /.nav-item -->
                  <li class="nav__item">
                    <a href="doctors-grid.php" class="nav__item-link">Doctors</a>
                  </li><!-- /.nav-item -->
                  <li class="nav__item">
                    <a href="shop.php" class="nav__item-link">Packages</a>
                  </li><!-- /.nav-item -->
                  <li class="nav__item">
                    <a href="pay.php" class="nav__item-link">Pay Online</a>
                  </li><!-- /.nav-item -->
                  <li class="nav__item">
                    <a href="contact-us.php" class="nav__item-link">Contact Us</a>
                  </li><!-- /.nav-item -->
                  <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Patient'): ?>
    <li class="nav__item">
        <a href="patientdashboard.php" class="nav__item-link">Go to My Account</a>
    </li>
<?php else: ?>
    <li class="nav__item">
        <a href="login.html" class="nav__item-link">Login</a>
    </li>
<?php endif; ?>

                </ul>
              </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
          </nav><!-- /.navabr -->
        </header><!-- /.Header -->

    <!-- ============================
        Slider
    ============================== -->
    <section class="slider">
      <div class="slick-carousel m-slides-0"
        data-slick='{"slidesToShow": 1, "arrows": true, "dots": false, "speed": 700,"fade": true,"cssEase": "linear"}'>
        <div class="slide-item align-v-h">
          <div class="bg-img"><img src="assets/images/back.jpg" alt="slide img"></div>
          <div class="container">
            <div class="row align-items-center">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                <div class="slide__content">
                  <h2 class="slide__title">Welcome to Care Compass Hospitals</h2>
                  <p class="slide__desc">The health and well-being of our patients and their health care team will
                    always be our priority, so we follow the best practices for cleanliness.</p>
                  <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                    <!-- feature item #1 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-heart"></i>
                      </div>
                      <h2 class="feature__title">Examination</h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #2 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-medicine"></i>
                      </div>
                      <h2 class="feature__title">Prescription </h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #3 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-heart2"></i>
                      </div>
                      <h2 class="feature__title">Cardiogram</h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #4 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-blood-test"></i>
                      </div>
                      <h2 class="feature__title">Blood Pressure</h2>
                    </li><!-- /.feature-item-->
                  </ul><!-- /.features-list -->
                </div><!-- /.slide-content -->
              </div><!-- /.col-xl-7 -->
            </div><!-- /.row -->
          </div><!-- /.container -->
        </div><!-- /.slide-item -->
        <div class="slide-item align-v-h">
          <div class="bg-img"><img src="assets/images/hero.jpg" alt="slide img"></div>
          <div class="container">
            <div class="row align-items-center">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7">
                <div class="slide__content">
                  <h2 class="slide__title">Our Mission</h2>
                  <p class="slide__desc">Delivering compassionate, world-class medical services with a patient-centered approach.</p>
                  <ul class="features-list list-unstyled mb-0 d-flex flex-wrap">
                    <!-- feature item #1 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-heart"></i>
                      </div>
                      <h2 class="feature__title">Examination</h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #2 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-medicine"></i>
                      </div>
                      <h2 class="feature__title">Prescription </h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #3 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-heart2"></i>
                      </div>
                      <h2 class="feature__title">Cardiogram</h2>
                    </li><!-- /.feature-item-->
                    <!-- feature item #4 -->
                    <li class="feature-item">
                      <div class="feature__icon">
                        <i class="icon-blood-test"></i>
                      </div>
                      <h2 class="feature__title">Blood Pressure</h2>
                    </li><!-- /.feature-item-->
                  </ul><!-- /.features-list -->
                </div><!-- /.slide-content -->
              </div><!-- /.col-xl-7 -->
            </div><!-- /.row -->
          </div><!-- /.container -->
        </div><!-- /.slide-item -->
      </div><!-- /.carousel -->
    </section><!-- /.slider -->

    <!-- ============================
        contact info
    ============================== -->
    <section class="contact-info py-0">
      <div class="container">
        <div class="row row-no-gutter boxes-wrapper">
          <div class="col-sm-12 col-md-4">
            <div class="contact-box d-flex">
              <div class="contact__icon">
                <i class="icon-call3"></i>
              </div><!-- /.contact__icon -->
              <div class="contact__content">
                <h2 class="contact__title">Emergency Cases</h2>
                <p class="contact__desc">Please feel free to contact our friendly reception staff with any general or
                  medical enquiry.</p>
                <a href="tel:+94 71 5680282" class="phone__number">
                  <i class="icon-phone"></i> <span>+94 71 5680282</span>
                </a>
              </div><!-- /.contact__content -->
            </div><!-- /.contact-box -->
          </div><!-- /.col-md-4 -->
          <div class="col-sm-12 col-md-4">
            <div class="contact-box d-flex">
              <div class="contact__icon">
                <i class="icon-health-report"></i>
              </div><!-- /.contact__icon -->
              <div class="contact__content">
                <h2 class="contact__title">Doctors Timetable</h2>
                <p class="contact__desc">Qualified doctors available six days a week, view our timetable to make an
                  appointment.</p>
                <a href="doctors-timetable.php" class="btn btn__white btn__outlined btn__rounded">
                  <span>View Timetable</span><i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.contact__content -->
            </div><!-- /.contact-box -->
          </div><!-- /.col-md-4 -->
          <div class="col-sm-12 col-md-4">
            <div class="contact-box d-flex">
              <div class="contact__icon">
                <i class="icon-heart2"></i>
              </div><!-- /.contact__icon -->
              <div class="contact__content">
                <h2 class="contact__title">Opening Hours</h2>
                <ul class="time__list list-unstyled mb-0">
                  <li><span>Mon - Fri</span><span>7.00 - 12:00 pm</span></li>
                  <li><span>Saturday</span><span>9.00 - 10:00 pm</span></li>
                  <li><span>Sunday</span><span>10.00 - 12:00 pm</span></li>
                </ul>
              </div><!-- /.contact__content -->
            </div><!-- /.contact-box -->
          </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.contact-info -->

    <!-- ========================
      About Layout 2
    =========================== -->
    <section class="about-layout2 pb-0">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-7 offset-lg-1">
            <div class="heading-layout2">
              <h3 class="heading__title mb-60">Improving The Quality Of Your <br> Life Through Better Health.</h3>
            </div><!-- /heading -->
          </div><!-- /.col-12 -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-5">
            <div class="text-with-icon">
              <div class="text__icon">
                <i class="icon-doctor"></i>
              </div>
              <div class="text__content">
                <p class="heading__desc font-weight-bold color-secondary mb-30">Our goal is to deliver quality of care
                  in a courteous, respectful, and
                  compassionate manner. We hope you will allow us to care for you and strive to be the first and best
                  choice for healthcare.
                </p>
                <a href="appointment.php" class="btn btn__secondary btn__rounded mb-70">
                  <span>Book an appointment</span> <i class="icon-arrow-right"></i>
                </a>
              </div>
            </div>
            <div class="video-banner-layout2 bg-overlay">
              <img src="assets/images/hospital.png" alt="about" class="w-100">
              <a class="video__btn video__btn-white popup-video" href="assets/videos/video.mp4">
                <div class="video__player">
                    <i class="fa fa-play"></i>
                </div>
                <span class="video__btn-title color-white">Watch Our Video!</span>
            </a>            
            </div><!-- /.video-banner -->
          </div><!-- /.col-lg-6 -->
          <div class="col-sm-12 col-md-12 col-lg-7">
            <div class="about__text bg-white">
              <p class="heading__desc mb-30">Our goal is to deliver quality of care in a courteous, respectful, and
                compassionate
                manner. We hope you will allow us to care for you and to be the first and best choice for healthcare.
              </p>
              <p class="heading__desc mb-30">We will work with you to develop individualised care plans, including
                management of
                chronic diseases. We are committed to being the region’s premier healthcare network providing patient
                centered care that inspires clinical and service excellence.</p>
              <ul class="list-items list-unstyled">
                <li>We conduct a range of tests to help us work out why you're not feeling well and determine the
                  right
                  treatment for you.</li>
                <li>Our expert doctors, nurses and allied health professionals manage patients with a broad range of
                  medical issues.
                </li>
                <li>We offer a wide range of care and support to our patients, from diagnosis to treatment and
                  rehabilitation.
                </li>
              </ul>
            </div>
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.About Layout 2 -->

    <!-- ========================
        Services Layout 1
    =========================== -->
    <section class="services-layout1 services-carousel">
      <div class="bg-img"><img src="assets/images/backgrounds/2.jpg" alt="background"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="heading text-center mb-60">
              <h2 class="heading__subtitle">The Best Medical And General Practice Care!</h2>
              <h3 class="heading__title">Providing Medical Care For The Sickest In Our Community.</h3>
            </div><!-- /.heading -->
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="slick-carousel"
              data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": true, "arrows": false, "dots": true, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 1}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
              <!-- service item #1 -->
              <div class="service-item">
                <div class="service__icon">
                  <i class="icon-head"></i>
                  <i class="icon-head"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                  <h4 class="service__title">Neurology Clinic</h4>
                  <p class="service__desc">Some neurologists receive subspecialty training focusing on a particular area
                    of
                    the fields, these training programs are called fellowships, and are one to two years.
                  </p>
                  <ul class="list-items list-items-layout1 list-unstyled">
                    <li>Neurocritical Care</li>
                    <li>Neuro Oncology</li>
                    <li>Geriatric Neurology</li>
                  </ul>
                  <a href="services.php" class="btn btn__secondary btn__outlined btn__rounded">
                    <span>Read More</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.service__content -->
              </div><!-- /.service-item -->
              <!-- service item #2 -->
              <div class="service-item">
                <div class="service__icon">
                  <i class="icon-heart"></i>
                  <i class="icon-heart"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                  <h4 class="service__title">Cardiology Clinic</h4>
                  <p class="service__desc">All cardiologists study the disorders of the heart, but the study of adult
                    and
                    child heart disorders are trained to take care of small children and adult heart disease.
                  </p>
                  <ul class="list-items list-items-layout1 list-unstyled">
                    <li>Neurocritical Care</li>
                    <li>Neuro Oncology</li>
                    <li>Geriatric Neurology</li>
                  </ul>
                  <a href="services.php" class="btn btn__secondary btn__outlined btn__rounded">
                    <span>Read More</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.service__content -->
              </div><!-- /.service-item -->
              <!-- service item #3 -->
              <div class="service-item">
                <div class="service__icon">
                  <i class="icon-microscope"></i>
                  <i class="icon-microscope"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                  <h4 class="service__title">Pathology Clinic</h4>
                  <p class="service__desc">Pathology is the study of disease, it is the bridge between science and
                    medicine.
                    Also it underpins every aspect of patient care, from diagnostic testing and treatment.
                  </p>
                  <ul class="list-items list-items-layout1 list-unstyled">
                    <li>Surgical Pathology</li>
                    <li>Histopathology</li>
                    <li>Cytopathology </li>
                  </ul>
                  <a href="services.php" class="btn btn__secondary btn__outlined btn__rounded">
                    <span>Read More</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.service__content -->
              </div><!-- /.service-item -->
              <!-- service item #4 -->
              <div class="service-item">
                <div class="service__icon">
                  <i class="icon-dropper"></i>
                  <i class="icon-dropper"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                  <h4 class="service__title">Laboratory Analysis</h4>
                  <p class="service__desc">Analyzing the radon or radon progeny concentrations with passive devices, or
                    the
                    act of calibrating radon or radon progeny measurement devices.
                  </p>
                  <ul class="list-items list-items-layout1 list-unstyled">
                    <li>Newborn Care</li>
                    <li>Umbilical Cord Appearance </li>
                    <li>Repositioning Techniques</li>
                  </ul>
                  <a href="services.php" class="btn btn__secondary btn__outlined btn__rounded">
                    <span>Read More</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.service__content -->
              </div><!-- /.service-item -->
              <!-- service item #5 -->
              <div class="service-item">
                <div class="service__icon">
                  <i class="icon-heart3"></i>
                  <i class="icon-heart3"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                  <h4 class="service__title">Pediatric Clinic</h4>
                  <p class="service__desc">Pediatric providers see patients from birth into early adulthood to make sure
                    children achieve stay healthy. Our care includes preventive health checkups.
                  </p>
                  <ul class="list-items list-items-layout1 list-unstyled">
                    <li>Clinical laboratory</li>
                    <li>Research Analyst</li>
                    <li>Quality Assurance</li>
                  </ul>
                  <a href="services.php" class="btn btn__secondary btn__outlined btn__rounded">
                    <span>Read More</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.service__content -->
              </div><!-- /.service-item -->
              <!-- service item #6 -->
              <div class="service-item">
                <div class="service__icon">
                  <i class="icon-heart2"></i>
                  <i class="icon-heart2"></i>
                </div><!-- /.service__icon -->
                <div class="service__content">
                  <h4 class="service__title">Cardiac Clinic</h4>
                  <p class="service__desc">For people requiring additional follow up, the Cardiac Clinic provides rapid
                    access to professionals specialized in diagnosing and treating heart disease.
                  </p>
                  <ul class="list-items list-items-layout1 list-unstyled">
                    <li>Macular degeneration</li>
                    <li>Diabetic retinopathy</li>
                    <li>Excessive tearing</li>
                  </ul>
                  <a href="services.php" class="btn btn__secondary btn__outlined btn__rounded">
                    <span>Read More</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.service__content -->
              </div><!-- /.service-item -->
            </div>
          </div><!-- /.col-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.Services Layout 1 -->

    <!-- ======================
    Features Layout 2
    ========================= -->
    <section class="features-layout2 pt-130 bg-overlay bg-overlay-primary">
      <div class="bg-img"><img src="assets/images/backgrounds/2.jpg" alt="background"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-8 offset-lg-1">
            <div class="heading__layout2 mb-50">
              <h3 class="heading__title color-white">Care Compass Has Touched The Lives Of Patients & Providing Care for The
                Sickest In Our Community.</h3>
            </div>
          </div><!-- /col-lg-5 -->
        </div><!-- /.row -->
        <div class="row mb-100">
          <div class="col-sm-3 col-md-3 col-lg-1 offset-lg-5">
            <div class="heading__icon">
              <i class="icon-insurance"></i>
            </div>
          </div><!-- /.col-lg-5 -->
          <div class="col-sm-9 col-md-9 col-lg-6">
            <p class="heading__desc font-weight-bold color-white mb-30">Care Compass has been present in Sri Lanka since 2025,
              offering innovative
              solutions, specializing in medical services for treatment of medical infrastructure. With over 100
              professionals actively participates in numerous initiatives aimed at creating sustainable change for
              patients!
            </p>
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
          <!-- Feature item #1 -->
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
              <div class="feature__img">
                <img src="assets/images/services/1.png" alt="service" loading="lazy">
              </div><!-- /.feature__img -->
              <div class="feature__content">
                <div class="feature__icon">
                  <i class="icon-heart"></i>
                </div>
                <h4 class="feature__title">Medical Advices & Check Ups</h4>
              </div><!-- /.feature__content -->
              
            </div><!-- /.feature-item -->
          </div><!-- /.col-lg-3 -->
          <!-- Feature item #2 -->
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
              <div class="feature__img">
                <img src="assets/images/services/2.png" alt="service" loading="lazy">
              </div><!-- /.feature__img -->
              <div class="feature__content">
                <div class="feature__icon">
                  <i class="icon-doctor"></i>
                </div>
                <h4 class="feature__title">Trusted Medical Treatment </h4>
              </div><!-- /.feature__content -->
              
            </div><!-- /.feature-item -->
          </div><!-- /.col-lg-3 -->
          <!-- Feature item #3 -->
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
              <div class="feature__img">
                <img src="assets/images/services/3.png" alt="service" loading="lazy">
              </div><!-- /.feature__img -->
              <div class="feature__content">
                <div class="feature__icon">
                  <i class="icon-ambulance"></i>
                </div>
                <h4 class="feature__title">Emergency Help Available 24/7</h4>
              </div><!-- /.feature__content -->
              
            </div><!-- /.feature-item -->
          </div><!-- /.col-lg-3 -->
          <!-- Feature item #4 -->
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
              <div class="feature__img">
                <img src="assets/images/services/4.png" alt="service" loading="lazy">
              </div><!-- /.feature__img -->
              <div class="feature__content">
                <div class="feature__icon">
                  <i class="icon-drugs"></i>
                </div>
                <h4 class="feature__title">Medical Research Professionals </h4>
              </div><!-- /.feature__content -->
              
            </div><!-- /.feature-item -->
          </div><!-- /.col-lg-3 -->
          <!-- Feature item #5 -->
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
              <div class="feature__img">
                <img src="assets/images/services/5.png" alt="service" loading="lazy">
              </div><!-- /.feature__img -->
              <div class="feature__content">
                <div class="feature__icon">
                  <i class="icon-first-aid-kit"></i>
                </div>
                <h4 class="feature__title">Only Qualified Doctors</h4>
              </div><!-- /.feature__content -->
              
            </div><!-- /.feature-item -->
          </div><!-- /.col-lg-3 -->
          <!-- Feature item #6 -->
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
              <div class="feature__img">
                <img src="assets/images/services/6.png" alt="service" loading="lazy">
              </div><!-- /.feature__img -->
              <div class="feature__content">
                <div class="feature__icon">
                  <i class="icon-hospital"></i>
                </div>
                <h4 class="feature__title">Cutting Edge <br>Facility</h4>
              </div><!-- /.feature__content -->
              
            </div><!-- /.feature-item -->
          </div><!-- /.col-lg-3 -->
          <!-- Feature item #7 -->
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
              <div class="feature__img">
                <img src="assets/images/services/7.png" alt="service" loading="lazy">
              </div><!-- /.feature__img -->
              <div class="feature__content">
                <div class="feature__icon">
                  <i class="icon-expenses"></i>
                </div>
                <h4 class="feature__title">Affordable Prices For All Patients</h4>
              </div><!-- /.feature__content -->
              
            </div><!-- /.feature-item -->
          </div><!-- /.col-lg-3 -->
          <!-- Feature item #8 -->
          <div class="col-sm-6 col-md-6 col-lg-3">
            <div class="feature-item">
              <div class="feature__img">
                <img src="assets/images/services/8.png" alt="service" loading="lazy">
              </div><!-- /.feature__img -->
              <div class="feature__content">
                <div class="feature__icon">
                  <i class="icon-bandage"></i>
                </div>
                <h4 class="feature__title">Quality Care For Every Patient</h4>
              </div><!-- /.feature__content -->
              
            </div><!-- /.feature-item -->
          </div><!-- /.col-lg-3 -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-md-12 col-lg-6 offset-lg-3 text-center">
            <p class="font-weight-bold color-gray mb-0">We hope you will allow us to care for you and strive to be the
              first and best choice for healthcare.
              <a href="contact-us.php" class="color-secondary">
                <span>Contact Us For More Information</span> <i class="icon-arrow-right"></i>
              </a>
            </p>
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.Features Layout 2 -->

    <!-- ======================
      Team
    ========================= -->
    <section class="team-layout2 pb-80">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">
            <div class="heading text-center mb-40">
              <h3 class="heading__title">Meet Our Doctors</h3>
              <p class="heading__desc">Our administration and support staff all have exceptional people skills and
                trained to assist you with all medical enquiries.
              </p>
            </div><!-- /.heading -->
          </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="slick-carousel"
              data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "autoplay": true, "arrows": false, "dots": false, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 1}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
              <!-- Member #1 -->
              <div class="member">
                <div class="member__img">
                  <img src="assets/images/team/1.png" alt="member img">
                </div><!-- /.member-img -->
                <div class="member__info">
                  <h5 class="member__name"><a href="doctors-single-doctor1.html">Mike Dooley</a></h5>
                  <p class="member__job">Cardiology Specialist</p>
                  <p class="member__desc">Muldoone obtained his undergraduate degree in Biomedical Engineering at Tulane
                    University prior to attending St George's University School of Medicine</p>
                </div><!-- /.member-info -->
              </div><!-- /.member -->
              <!-- Member #2 -->
              <div class="member">
                <div class="member__img">
                  <img src="assets/images/team/2.png" alt="member img">
                </div><!-- /.member-img -->
                <div class="member__info">
                  <h5 class="member__name"><a href="doctors-single-doctor1.html">Dermatologists</a></h5>
                  <p class="member__job">Cardiology Specialist</p>
                  <p class="member__desc">Brian specializes in treating skin, hair, nail, and mucous membrane. He also
                    address cosmetic issues, helping to revitalize the appearance of the skin</p>
                </div><!-- /.member-info -->
              </div><!-- /.member -->
              <!-- Member #3 -->
              <div class="member">
                <div class="member__img">
                  <img src="assets/images/team/3.png" alt="member img">
                </div><!-- /.member-img -->
                <div class="member__info">
                  <h5 class="member__name"><a href="doctors-single-doctor1.html">Maria Andaloro</a></h5>
                  <p class="member__job">Pediatrician</p>
                  <p class="member__desc">Andaloro graduated from medical school and completed 3 years residency program
                    in pediatrics. She passed rigorous exams by the American Board of Pediatrics.</p>
                
                </div><!-- /.member-info -->
              </div><!-- /.member -->
              <!-- Member #4 -->
              <div class="member">
                <div class="member__img">
                  <img src="assets/images/team/4.png" alt="member img">
                </div><!-- /.member-img -->
                <div class="member__info">
                  <h5 class="member__name"><a href="doctors-single-doctor1.html">Dupree Black</a></h5>
                  <p class="member__job">Urologist</p>
                  <p class="member__desc">Black diagnose and treat diseases of the urinary tract in both men and women.
                    He
                    also diagnose and treat anything involving the reproductive tract in men.</p>
                  
                </div><!-- /.member-info -->
              </div><!-- /.member -->
              <!-- Member #5 -->
              <div class="member">
                <div class="member__img">
                  <img src="assets/images/team/5.png" alt="member img">
                </div><!-- /.member-img -->
                <div class="member__info">
                  <h5 class="member__name"><a href="doctors-single-doctor1.html">Markus skar</a></h5>
                  <p class="member__job">Laboratory</p>
                  <p class="member__desc">Skar play a very important role in your health care. People working in the
                    clinical laboratory are responsible for conducting tests that provide crucial information.</p>
                  
                </div><!-- /.member-info -->
              </div><!-- /.member -->
              <!-- Member #6 -->
              <div class="member">
                <div class="member__img">
                  <img src="assets/images/team/6.png" alt="member img">
                </div><!-- /.member-img -->
                <div class="member__info">
                  <h5 class="member__name"><a href="doctors-single-doctor1.html">Kiano Barker</a></h5>
                  <p class="member__job">Pathologist </p>
                  <p class="member__desc">Barker help care for patients every day by providing their doctors with the
                    information needed to ensure appropriate care. He also valuable resources for other physicians.</p>
                  
                </div><!-- /.member-info -->
              </div><!-- /.member -->
            </div><!-- /.carousel -->
          </div><!-- /.col-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.Team -->

    <!-- ======================
     Work Process 
    ========================= -->
    <section class="work-process work-process-carousel pt-130 pb-0 bg-overlay bg-overlay-secondary">
      <div class="bg-img"><img src="assets/images/banners/1.jpg" alt="background"></div>
      <div class="container">
        <div class="row heading-layout2">
          <div class="col-12">
            <h2 class="heading__subtitle color-primary">Caring For The Health Of You And Your Family.</h2>
          </div><!-- /.col-12 -->
          <div class="col-sm-12 col-md-12 col-lg-6 col-xl-5">
            <h3 class="heading__title color-white">We Provide All Aspects Of Medical Practice For Your Whole Family!
            </h3>
          </div><!-- /.col-xl-5 -->
          <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 offset-xl-1">
            <p class="heading__desc font-weight-bold color-gray mb-40">We will work with you to develop individualised
              care
              plans, including
              management of chronic diseases. If we cannot assist, we can provide referrals or advice about the type of
              practitioner you require. We treat all enquiries sensitively and in the strictest confidence.
            </p>
            <ul class="list-items list-items-layout2 list-items-light list-horizontal list-unstyled">
              <li>Fractures and dislocations</li>
              <li>Health Assessments</li>
              <li>Desensitisation injections</li>
              <li>High Quality Care</li>
              <li>Desensitisation injections</li>
            </ul>
          </div><!-- /.col-xl-6 -->
        </div><!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="carousel-container mt-90">
              <div class="slick-carousel"
                data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "infinite":false, "arrows": false, "dots": false, "responsive": [{"breakpoint": 1200, "settings": {"slidesToShow": 3}}, {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
                <!-- process item #1 -->
                <div class="process-item">
                  <span class="process__number">01</span>
                  <div class="process__icon">
                    <i class="icon-health-report"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Fill In Our Medical Application</h4>
                  <p class="process__desc">Care Compass offers low-cost health coverage for adults with limited income, you
                    can
                    enroll.</p>
                  <a href="doctors-timetable.php" class="btn btn__secondary btn__link">
                    <span>Doctors’ Timetable</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
                <!-- process-item #2 -->
                <div class="process-item">
                  <span class="process__number">02</span>
                  <div class="process__icon">
                    <i class="icon-dna"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Review Your Family Medical History</h4>
                  <p class="process__desc">Regular health exams can help find all the problems, also can find it early
                    chances.</p>
                  <a href="shop.php" class="btn btn__secondary btn__link">
                    <span>Start A Check Up</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
                <!-- process-item #3 -->
                <div class="process-item">
                  <span class="process__number">03</span>
                  <div class="process__icon">
                    <i class="icon-medicine"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Choose Between Our Care Programs</h4>
                  <p class="process__desc">We have protocols to protect our patients while continuing to provide
                    necessary
                    care.</p>
                  <a href="services.php" class="btn btn__secondary btn__link">
                    <span>Explore Programs</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
                <!-- process-item #4 -->
                <div class="process-item">
                  <span class="process__number">04</span>
                  <div class="process__icon">
                    <i class="icon-stethoscope"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Introduce You To Highly Qualified Doctors</h4>
                  <p class="process__desc">Our administration and support staff have exceptional skills and trained to
                    assist you. </p>
                  <a href="doctors-grid.php" class="btn btn__secondary btn__link">
                    <span>Meet Our Doctors</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
                <!-- process-item #5 -->
                <div class="process-item">
                  <span class="process__number">05</span>
                  <div class="process__icon">
                    <i class="icon-head"></i>
                  </div><!-- /.process__icon -->
                  <h4 class="process__title">Your custom Next process</h4>
                  <p class="process__desc">Our administration and support staff have exceptional skills to assist you.
                  </p>
                  <a href="doctors-grid.php" class="btn btn__secondary btn__link">
                    <span>Meet Our Doctors</span>
                    <i class="icon-arrow-right"></i>
                  </a>
                </div><!-- /.process-item -->
              </div><!-- /.carousel -->
            </div>
          </div><!-- /.col-12 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
      <div class="cta bg-light-blue">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-sm-12 col-md-2 col-lg-2">
              <img src="assets/images/icons/alert2.png" class="cta__img" alt="alert">
            </div><!-- /.col-lg-2 -->
            <div class="col-sm-12 col-md-7 col-lg-7">
              <h4 class="cta__title">True Healthcare For Your Family!</h4>
              <p class="cta__desc">Serve the community by improving the quality of life through better health. We have
                put protocols to protect our patients and staff while continuing to provide medically necessary care.
              </p>
            </div><!-- /.col-lg-7 -->
            <div class="col-sm-12 col-md-12 col-lg-3">
              <a href="shop.php" class="btn btn__primary btn__secondary-style2 btn__rounded">
                <span>Healthcare Programs</span>
                <i class="icon-arrow-right"></i>
              </a>
            </div><!-- /.col-lg-3 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.cta -->
    </section><!-- /.Work Process -->

    <!-- ========================= 
      Testimonials layout 2
      =========================  -->
      <section class="testimonials-layout2 pt-130 pb-40">
    <div class="container">
        <div class="testimonials-wrapper">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-5">
                    <div class="heading-layout2">
                        <h3 class="heading__title">Inspiring Stories!</h3>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-7">
                    <div class="slider-with-navs">
                        <?php
                        include 'db_connection.php';

                        $sql = "SELECT * FROM feedback";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="testimonial-item">';
                                echo '<h3 class="testimonial__title">"' . htmlspecialchars($row['content']) . '"</h3>';
                                echo '</div>';
                            }
                        } else {
                            echo '<p>No testimonials found.</p>';
                        }
                        ?>
                    </div>
                    <div class="slider-nav mb-60">
                        <?php
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="testimonial__meta">';
                                echo '<div>';
                                echo '<h4 class="testimonial__meta-title">' . htmlspecialchars($row['author']) . '</h4>';
                                echo '<p class="testimonial__meta-desc">' . htmlspecialchars($row['created_at']) . '</p>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

      

    <!-- ========================
       gallery
      =========================== -->
    <section class="gallery pt-0 pb-90">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="slick-carousel"
              data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "autoplay": true, "arrows": true, "dots": false, "responsive": [ {"breakpoint": 992, "settings": {"slidesToShow": 2}}, {"breakpoint": 767, "settings": {"slidesToShow": 2}}, {"breakpoint": 480, "settings": {"slidesToShow": 1}}]}'>
              <a class="popup-gallery-item" href="assets/images/gallery/1.jpg">
                <img src="assets/images/gallery/1.png" alt="gallery img">
              </a>
              <a class="popup-gallery-item" href="assets/images/gallery/2.jpg">
                <img src="assets/images/gallery/2.png" alt="gallery img">
              </a>
              <a class="popup-gallery-item" href="assets/images/gallery/3.jpg">
                <img src="assets/images/gallery/3.png" alt="gallery img">
              </a>
              <a class="popup-gallery-item" href="assets/images/gallery/4.jpg">
                <img src="assets/images/gallery/4.png" alt="gallery img">
              </a>
              <a class="popup-gallery-item" href="assets/images/gallery/1.jpg">
                <img src="assets/images/gallery/1.png" alt="gallery img">
              </a>
              <a class="popup-gallery-item" href="assets/images/gallery/2.jpg">
                <img src="assets/images/gallery/2.png" alt="gallery img">
              </a>
              <a class="popup-gallery-item" href="assets/images/gallery/3.jpg">
                <img src="assets/images/gallery/3.png" alt="gallery img">
              </a>
              <a class="popup-gallery-item" href="assets/images/gallery/4.jpg">
                <img src="assets/images/gallery/4.png" alt="gallery img">
              </a>
            </div><!-- /.gallery-images-wrapper -->
          </div><!-- /.col-xl-5 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.gallery 2 -->

    <!-- ==========================
        contact layout 3
    =========================== -->
    <section class="contact-layout3 bg-overlay bg-overlay-primary-gradient pb-60">
      <div class="bg-img"><img src="assets/images/banners/3.jpg" alt="banner"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-7">
          <div class="contact-panel mb-50">
    <form class="contact-panel__form" method="GET" action="search_results.php" id="appointmentForm">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="contact-panel__title">Search for a Doctor</h4>
                <p class="contact-panel__desc mb-30">
                    Please feel welcome to contact our friendly reception staff with any general or medical inquiry. Use the form below to search for doctors by location or specialty.
                </p>
            </div>
            <!-- Location Selection -->
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <i class="icon-location form-group-icon"></i>
                    <select class="form-control" id="location" name="location">
                        <option value="">Choose Location</option>
                        <option value="Colombo">Colombo</option>
                        <option value="Kandy">Kandy</option>
                        <option value="Kurunegala">Kurunegala</option>
                        <!-- Add more locations as needed -->
                    </select>
                </div>
            </div>
            <!-- Specialty Selection -->
            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="form-group">
                    <i class="icon-head form-group-icon"></i>
                    <select class="form-control" id="specialty" name="specialty">
                        <option value="">Choose Specialty</option>
                        <option value="Cardiology Specialist">Cardiology Specialist</option>
                        <option value="Neurology Specialist">Neurology Specialist</option>
                        <option value="Pediatrician">Pediatrician</option>
                        <option value="Urologist">Urologist</option>
                        <option value="Laboratory Specialist">Laboratory Specialist</option>
                        <option value="Pathologist">Pathologist</option>
                        <!-- Add more specialties as needed -->
                    </select>
                </div>
            </div>
            <!-- Submit Button -->
            <div class="col-12">
                <button type="submit" class="btn btn__secondary btn__rounded btn__block btn__xhight mt-10">
                    <span>Search</span> <i class="icon-arrow-right"></i>
                </button>
                <div class="contact-result"></div>
            </div>
        </div>
    </form>
</div>
          </div><!-- /.col-lg-7 -->
          <div class="col-sm-12 col-md-12 col-lg-5">
            <div class="heading heading-light mb-30">
              <h3 class="heading__title mb-30">Helping Patients From Around the Globe!!</h3>
              <p class="heading__desc">Our staff strives to make each interaction with patients clear, concise, and
                inviting. Support the important work of Care Compass Hospital by making a much-needed today.
              </p>
            </div>
            <div class="d-flex align-items-center">

              <a class="video__btn video__btn-white popup-video" href="https://youtu.be/1R8j3p_9z60?si=blhGbpW6DmtBr-pD">
                <div class="video__player">
                  <i class="fa fa-play"></i>
                </div>
                <span class="video__btn-title color-white">Play Video</span>
              </a>
            </div>
            <div class="text__block">
              <p class="text__block-desc color-white font-weight-bold">We provide a comprehensive range of plans for
                families and individuals at every stage of life, with annual limits ranging to unlimited.</p>
              <div class="sinature color-white">
                <span class="font-weight-bold">Rasindu Randheera</span><span>, CC Hospitals Manager</span>
              </div>
            </div><!-- /.text__block -->
          </div><!-- /.col-lg-5 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.contact layout 3 -->

    <!-- ========================
      Footer
    ========================== -->
    <footer class="footer">
      <div class="footer-primary">
        <div class="container">
          <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-3">
              <div class="footer-widget-about">
                <img src="assets/images/logo.png" alt="logo" class="mb-30">
                <p class="color-gray">Our goal is to deliver quality of care in a courteous, respectful, and
                  compassionate manner. We hope you will allow us to care for you and strive to be the first and best
                  choice for your family healthcare.
                </p>
                <a href="appointment.php" class="btn btn__primary btn__primary-style2 btn__link">
                  <span>Make Appointment</span> <i class="icon-arrow-right"></i>
                </a>
              </div><!-- /.footer-widget__content -->
            </div><!-- /.col-xl-2 -->
            <div class="col-sm-6 col-md-6 col-lg-2 offset-lg-1">
              <div class="footer-widget-nav">
                <h6 class="footer-widget__title">Services</h6>
                <nav>
                  <ul class="list-unstyled">
                    <li><a href="departments.php">Neurology Clinic</a></li>
                    <li><a href="departments.php">Cardiology Clinic</a></li>
                    <li><a href="departments.php">Pathology Clinic</a></li>
                    <li><a href="departments.php">Laboratory Analysis</a></li>
                    <li><a href="departments.php">Pediatric Clinic</a></li>
                    <li><a href="departments.php">Cardiac Clinic</a></li>
                  </ul>
                </nav>
              </div><!-- /.footer-widget__content -->
            </div><!-- /.col-lg-2 -->
            <div class="col-sm-6 col-md-6 col-lg-2">
              <div class="footer-widget-nav">
                <h6 class="footer-widget__title">Links</h6>
                <nav>
                  <ul class="list-unstyled">
                    <li><a href="about-us.php">About Us</a></li>
                    <li><a href="doctors-grid.php">Our Doctors</a></li>
                    <li><a href="shop.php">Packages</a></li>
                    <li><a href="appointment.php">Appointments</a></li>
                  </ul>
                </nav>
              </div><!-- /.footer-widget__content -->
            </div><!-- /.col-lg-2 -->
            <div class="col-sm-12 col-md-6 col-lg-4">
              <div class="footer-widget-contact">
                <h6 class="footer-widget__title color-heading">Quick Contacts</h6>
                <ul class="contact-list list-unstyled">
                  <li>If you have any questions or need help, feel free to contact with our team.</li>
                  <li>
                    <a href="tel:01061245741" class="phone__number">
                      <i class="icon-phone"></i> <span>+94 71 5680282</span>
                    </a>
                  </li>
                  <li class="color-body">Baseline Road, Colombo.</li>
                </ul>
                <div class="d-flex align-items-center">
                  <a href="contact-us.php" class="btn btn__primary btn__link mr-30">
                    <i class="icon-arrow-right"></i> <span>Get Directions</span>
                  </a>
                  <ul class="social-icons list-unstyled mb-0">
                    <li><a href="https://www.facebook.com/profile.php?id=61571771665198"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="https://youtu.be/1R8j3p_9z60?si=blhGbpW6DmtBr-pD" target="_blank"><i class="fab fa-youtube"></i></a></li>
                  </ul><!-- /.social-icons -->
                </div>
              </div><!-- /.footer-widget__content -->
            </div><!-- /.col-lg-2 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.footer-primary -->
      <div class="footer-secondary">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <span class="fz-14">&copy; 2025 Rasindu Randheera</span>
              <a class="fz-14 color-primary" href="">st20305808</a>
            </div><!-- /.col-lg-6 -->
            <div class="col-sm-12 col-md-6 col-lg-6">
              <nav>
                <ul class="list-unstyled footer__copyright-links d-flex flex-wrap justify-content-end mb-0">
                  <li><a href="privacy.php">Privacy Policy</a></li>
                  <li><a href="cookies.html">Cookies</a></li>
                </ul>
              </nav>
            </div><!-- /.col-lg-6 -->
          </div><!-- /.row -->
        </div><!-- /.container -->
      </div><!-- /.footer-secondary -->
    </footer><!-- /.Footer -->
    <button id="scrollTopBtn"><i class="fas fa-long-arrow-alt-up"></i></button>

    <script>
      // List of searchable items
      // List of searchable items with URLs
const searchableItems = [
  { name: "Neurology Clinic", url: "services.php" },
  { name: "Cardiology Clinic", url: "services.php" },
  { name: "Pathology Clinic", url: "services.php" },
  { name: "Laboratory Analysis", url: "services.php" },
  { name: "Pediatric Clinic", url: "services.php" },
  { name: "Cardiac Clinic", url: "services.php" },
  { name: "Doctors", url: "doctors-grid.php" },
  { name: "Contact Us", url: "contact-us.php" },
  { name: "Appointment", url: "appointment.php" },
  { name: "Opening Hours", url: "index.php" },
  { name: "Emergency Line", url: "index.php" },
];

// Function to search items
function searchItems() {
  const input = document.getElementById("searchInput").value.toLowerCase();
  const suggestionsBox = document.getElementById("suggestions");

  // Clear previous suggestions
  suggestionsBox.innerHTML = "";

  // If input is empty, hide suggestions
  if (!input) {
    suggestionsBox.style.display = "none";
    return;
  }

  // Filter suggestions based on input
  const filteredItems = searchableItems.filter((item) =>
    item.name.toLowerCase().includes(input)
  );

  // Show suggestions
  if (filteredItems.length > 0) {
    filteredItems.forEach((item) => {
      const div = document.createElement("div");
      div.textContent = item.name;
      div.className = "suggestion-item";

      // On click, navigate to the item's URL
      div.onclick = function () {
        window.location.href = item.url;
      };

      suggestionsBox.appendChild(div);
    });
    suggestionsBox.style.display = "block";
  } else {
    suggestionsBox.style.display = "none";
  }
}

    </script>                    

  </div><!-- /.wrapper -->

  <script src="assets/js/jquery-3.5.1.min.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/main.js"></script>
</body>

</html>