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
  <title>Medcity - Medical Healthcare HTML5 Template</title>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
  <link rel="stylesheet" href="assets/css/libraries.css">
  <link rel="stylesheet" href="assets/css/style.css">
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

    <!-- ========================
       page title 
    =========================== -->
    <section class="page-title page-title-layout1 bg-overlay">
      <div class="bg-img"><img src="assets/images/page-titles/2.jpg" alt="background"></div>
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5">
            <span class="pagetitle__subheading">Caring For The Health Of You And Your Family.</span>
            <h1 class="pagetitle__heading">We Provide All Aspects Of Medical Practice For Your Whole Family!</h1>
            <p class="pagetitle__desc">Medcity has been present in Europe since 1990, offering innovative
              solutions, specializing in medical services for treatment of medical infrastructure.
            </p>
            <div class="d-flex flex-wrap align-items-center">
              <a href="appointment.php" class="btn btn__secondary btn__rounded mr-30">
                <span>Find A Doctor</span>
                <i class="icon-arrow-right"></i>
              </a>
              <a href="about-us.php" class="btn btn__secondary btn__outlined btn__rounded">
                <span>More About Us</span>
              </a>
            </div>
          </div><!-- /.col-xl-5 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.page-title -->

    <!-- ========================
        Services Layout 1
    =========================== -->
    <section class="services-layout1 pt-130">
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
          <!-- service item #1 -->
          <div class="col-sm-12 col-md-6 col-lg-4">
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
              </div><!-- /.service__content -->
            </div><!-- /.service-item -->
          </div><!-- /.col-lg-4 -->
          <!-- service item #2 -->
          <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="service-item">
              <div class="service__icon">
                <i class="icon-heart"></i>
                <i class="icon-heart"></i>
              </div><!-- /.service__icon -->
              <div class="service__content">
                <h4 class="service__title">Cardiology Clinic</h4>
                <p class="service__desc">All cardiologists study the disorders of the heart, but the study of adult and
                  child heart disorders are trained to take care of small children and adult heart disease.
                </p>
                <ul class="list-items list-items-layout1 list-unstyled">
                  <li>Neurocritical Care</li>
                  <li>Neuro Oncology</li>
                  <li>Geriatric Neurology</li>
                </ul>
              </div><!-- /.service__content -->
            </div><!-- /.service-item -->
          </div><!-- /.col-lg-4 -->
          <!-- service item #3 -->
          <div class="col-sm-12 col-md-6 col-lg-4">
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
              </div><!-- /.service__content -->
            </div><!-- /.service-item -->
          </div><!-- /.col-lg-4 -->
          <!-- service item #4 -->
          <div class="col-sm-12 col-md-6 col-lg-4">
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
              </div><!-- /.service__content -->
            </div><!-- /.service-item -->
          </div><!-- /.col-lg-4 -->
          <!-- service item #5 -->
          <div class="col-sm-12 col-md-6 col-lg-4">
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
              </div><!-- /.service__content -->
            </div><!-- /.service-item -->
          </div><!-- /.col-lg-4 -->
          <!-- service item #6 -->
          <div class="col-sm-12 col-md-6 col-lg-4">
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
              </div><!-- /.service__content -->
            </div><!-- /.service-item -->
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
      </div><!-- /.container -->
    </section><!-- /.Services Layout 1 -->

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
  { name: "Neurology Clinic", url: "services.html" },
  { name: "Cardiology Clinic", url: "services.html" },
  { name: "Pathology Clinic", url: "services.html" },
  { name: "Laboratory Analysis", url: "services.html" },
  { name: "Pediatric Clinic", url: "services.html" },
  { name: "Cardiac Clinic", url: "services.html" },
  { name: "Doctors", url: "doctors-grid.php" },
  { name: "Contact Us", url: "contact-us.html" },
  { name: "Appointment", url: "appointment.html" },
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