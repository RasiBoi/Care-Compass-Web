<?php
session_start();
// Database connection parameters
$servername = "localhost";
$username = "root"; // Default username for WampServer
$password = ""; // Default password is empty
$dbname = "CCH";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get search parameters from the form
$location = isset($_GET['location']) ? $_GET['location'] : '';
$specialty = isset($_GET['specialty']) ? $_GET['specialty'] : '';

// Prepare the SQL query
$sql = "SELECT * FROM doctors WHERE 1=1";
if (!empty($location)) {
    $sql .= " AND clinic_address = '" . $conn->real_escape_string($location) . "'";
}
if (!empty($specialty)) {
    $sql .= " AND specialty = '" . $conn->real_escape_string($specialty) . "'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
  <link rel="stylesheet" href="assets/css/libraries.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .search-results {
            width: 80%;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        .doctor-card {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            background-color: #f9f9f9;
        }

        .doctor-card img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
        }

        .doctor-info {
            flex-grow: 1;
            margin-right: 20px;
        }

        .doctor-name {
            font-weight: bold;
            color: #007bff;
        }

        .doctor-specialty,
        .doctor-location {
            margin-top: 5px;
            font-size: 14px;
            color: #555;
        }

        .book-button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }

        .book-button:hover {
            background-color: #218838;
        }

        .go-back {
            margin-bottom: 20px;
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
        }

        .go-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

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
                    <a href="contact-us.html" class="nav__item-link">Contact Us</a>
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


    <div class="search-results">
        <a href="appointment.php" class="go-back">Go Back</a>
        <h1>Search Results</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="doctor-card">
                    <img src="<?= htmlspecialchars($row['image_path']); ?>" alt="Doctor Image">
                    <div class="doctor-info">
                        <div class="doctor-name"><?= htmlspecialchars($row['name']); ?></div>
                        <div class="doctor-specialty"><?= htmlspecialchars($row['specialty']); ?></div>
                        <div class="doctor-location"><?= htmlspecialchars($row['clinic_address']); ?></div>
                    </div>
                    <button class="book-button" onclick="bookDoctor('<?= htmlspecialchars($row['id']); ?>')">Book Now</button>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No doctors found for the selected criteria.</p>
        <?php endif; ?>
    </div>

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
                    <li><a href="departments.html">Neurology Clinic</a></li>
                    <li><a href="departments.html">Cardiology Clinic</a></li>
                    <li><a href="departments.html">Pathology Clinic</a></li>
                    <li><a href="departments.html">Laboratory Analysis</a></li>
                    <li><a href="departments.html">Pediatric Clinic</a></li>
                    <li><a href="departments.html">Cardiac Clinic</a></li>
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
                  <a href="contact-us.html" class="btn btn__primary btn__link mr-30">
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
                  <li><a href="privacy.html">Privacy Policy</a></li>
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
        function bookDoctor(doctorId) {
            alert(`Booking initiated for doctor ID: ${doctorId}`);
            // Redirect or handle booking logic here
            window.location.href = `book_appointment.php?doctor_id=${doctorId}`;
        }
    </script>                    

  </div><!-- /.wrapper -->

  <script src="assets/js/jquery-3.5.1.min.js"></script>
  <script src="assets/js/plugins.js"></script>
  <script src="assets/js/main.js"></script>

</body>

</html>

<?php
$conn->close();
?>
