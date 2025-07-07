<?php
session_start(); // Start session to check for logged-in users

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "CCH";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch schedule ID from URL
$schedule_id = isset($_GET['schedule_id']) ? intval($_GET['schedule_id']) : 0;

// Initialize variables
$patient_name = $email = $phone = "";
$user_logged_in = false;

// Check if the user is logged in
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
    $user_logged_in = true;

    // Fetch user details from `patients` table based on email
    $user_sql = "SELECT name, phone, email FROM patients WHERE email = ?";
    $stmt = $conn->prepare($user_sql);

    if (!$stmt) {
        die("SQL Error: " . $conn->error);
    }

    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $user_result = $stmt->get_result();

    if ($user_result->num_rows > 0) {
        $user = $user_result->fetch_assoc();
        $patient_name = $user['name'];
        $phone = $user['phone'];
        $email = $user['email'];
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $patient_name = $conn->real_escape_string($_POST['patient_name']);
  $mobile = $conn->real_escape_string($_POST['mobile']);
  $email = $conn->real_escape_string($_POST['email']);
  $nic = $conn->real_escape_string($_POST['nic']);
  $doctor_id = intval($_POST['doctor_id']);

  // Check if the time slot is already booked
  $check_booking_sql = "SELECT * FROM bookings WHERE schedule_id = ?";
  $stmt = $conn->prepare($check_booking_sql);
  $stmt->bind_param("i", $schedule_id);
  $stmt->execute();
  $check_booking_result = $stmt->get_result();

  if ($check_booking_result->num_rows > 0) {
      $error_message = "This time slot is already booked.";
  } else {
      // Insert booking into the database
      $insert_sql = "INSERT INTO bookings (doctor_id, schedule_id, patient_name, mobile, email, nic, created_at, payment_status)
                     VALUES (?, ?, ?, ?, ?, ?, NOW(), 'pending')";
      $stmt = $conn->prepare($insert_sql);
      $stmt->bind_param("iissss", $doctor_id, $schedule_id, $patient_name, $mobile, $email, $nic);

      if ($stmt->execute()) {
          $success = true; // Flag to trigger the popup
      } else {
          $error_message = "Error: " . $conn->error;
      }
  }
}


// Fetch schedule details
$schedule_sql = "SELECT timetable.*, doctors.name AS doctor_name, doctors.specialty, doctors.image_path, doctors.clinic_address 
                 FROM timetable 
                 INNER JOIN doctors ON timetable.doctor_id = doctors.id 
                 WHERE timetable.id = ?";
$stmt = $conn->prepare($schedule_sql);
$stmt->bind_param("i", $schedule_id);
$stmt->execute();
$schedule_result = $stmt->get_result();
$schedule = $schedule_result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Roboto:wght@400;700&display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
  <link rel="stylesheet" href="assets/css/libraries.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .booking-container {
            max-width: 800px;
            margin: 20px auto;
            font-family: Arial, sans-serif;
        }

        .doctor-info {
            text-align: center;
            margin-bottom: 30px;
        }

        .doctor-info img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input, 
        .form-group select, 
        .form-group button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #0056b3;
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

        .bill-preview {
            margin-top: 20px;
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }

        .bill-preview:hover {
            background-color: #218838;
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



<div class="booking-container">
<h2 style="text-align: center;">Confirm Booking</h2>


    <?php if (!empty($popup_message)): ?>
        <div id="popupMessage" class="popup <?= $popup_status; ?>">
            <?= $popup_message; ?>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let popup = document.getElementById("popupMessage");
                popup.style.display = "block";
                setTimeout(() => popup.style.display = "none", 3000);
            });
        </script>
    <?php endif; ?>

    <?php if ($schedule): ?>
        <div class="doctor-info">
            <img src="<?= htmlspecialchars($schedule['image_path']); ?>" alt="Doctor Image">
            <h3><?= htmlspecialchars($schedule['doctor_name']); ?></h3>
            <p><?= htmlspecialchars($schedule['specialty']); ?></p>
            <p><?= htmlspecialchars($schedule['clinic_address']); ?></p>
        </div>

        <form action="confirm_booking.php?schedule_id=<?= $schedule_id; ?>" method="POST">
            <input type="hidden" name="schedule_id" value="<?= $schedule_id; ?>">
            <input type="hidden" name="doctor_id" value="<?= $schedule['doctor_id']; ?>">

            <div class="form-group">
                <label for="patient_name">Patient Name</label>
                <input type="text" id="patient_name" name="patient_name" value="<?= htmlspecialchars($patient_name); ?>" required <?= $user_logged_in ? 'readonly' : ''; ?>>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile</label>
                <input type="text" id="mobile" name="mobile" value="<?= htmlspecialchars($phone); ?>" required <?= $user_logged_in ? 'readonly' : ''; ?>>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="nic">NIC</label>
                <input type="text" id="nic" name="nic" placeholder="NIC - Ex: 123456789V" required>
            </div>
            <div class="form-group">
                <button type="submit">Confirm Booking</button>
            </div>
        </form>
    <?php else: ?>
        <p>Schedule not found.</p>
    <?php endif; ?>
</div>

<!-- Booking Success Popup -->
<div id="bookingPopup" class="popup-container" style="display: none;">
    <div class="popup-content">
        <h2>Booking Successful</h2>
        <p>Your appointment has been successfully booked.</p>
        <div class="popup-buttons">
            <a href="pay.php" class="pay-now-btn">Pay Now</a>
            <button class="pay-later-btn" onclick="closePopup()">Pay Later</button>
        </div>
    </div>
</div>

<!-- CSS for the Popup -->
<style>
    .popup-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }
    
    .popup-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
        width: 300px;
    }
    
    .popup-buttons {
        margin-top: 20px;
    }

    .pay-now-btn, .pay-later-btn {
        padding: 10px 15px;
        border: none;
        cursor: pointer;
        font-size: 16px;
        margin: 5px;
        display: inline-block;
        border-radius: 4px;
        text-decoration: none;
    }

    .pay-now-btn {
        background-color: #007bff;
        color: white;
    }

    .pay-now-btn:hover {
        background-color: #0056b3;
    }

    .pay-later-btn {
        background-color: #6c757d;
        color: white;
    }

    .pay-later-btn:hover {
        background-color: #5a6268;
    }
</style>

<!-- JavaScript to Show the Popup -->
<script>
    function closePopup() {
        document.getElementById("bookingPopup").style.display = "none";
    }

    // Show popup if booking was successful
    <?php if (isset($success) && $success === true): ?>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("bookingPopup").style.display = "flex";
        });
    <?php endif; ?>
</script>



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

        function printBill() {
    const patientName = document.getElementById('patient_name').value;
    const mobile = document.getElementById('mobile').value;
    const nic = document.getElementById('nic').value;

    if (!patientName || !mobile || !nic) {
        alert('Please fill out the required fields before printing the bill preview.');
        return;
    }

    const billWindow = window.open('', 'Bill Preview', 'width=900, height=650');
    billWindow.document.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Bill Preview</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    background-color: #f8f9fa;
                }
                .header {
                    background-color: #007bff;
                    color: white;
                    padding: 20px;
                    text-align: center;
                }
                .header img {
                    max-height: 50px;
                    margin-bottom: 10px;
                }
                .content {
                    padding: 20px;
                }
                .content h2 {
                    margin-top: 0;
                    color: #007bff;
                }
                .details {
                    margin: 20px 0;
                    padding: 15px;
                    background-color: #ffffff;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                }
                .footer {
                    background-color: #343a40;
                    color: white;
                    text-align: center;
                    padding: 10px;
                    position: absolute;
                    bottom: 0;
                    width: 100%;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <img src="assets/images/logo/logo.png" alt="Hospital Logo">
                <h1>Care Compass Hospital</h1>
                <p>Baseline Road, Colombo | +94 71 5680282</p>
            </div>
            <div class="content">
                <h2>Appointment Confirmation</h2>
                <div class="details">
                    <p><strong>Patient Name:</strong> ${patientName}</p>
                    <p><strong>Mobile:</strong> ${mobile}</p>
                    <p><strong>NIC:</strong> ${nic}</p>
                    <p><strong>Doctor:</strong> <?= htmlspecialchars($schedule['doctor_name']); ?></p>
                    <p><strong>Specialty:</strong> <?= htmlspecialchars($schedule['specialty']); ?></p>
                    <p><strong>Time Slot:</strong> <?= htmlspecialchars($schedule['time_slot']); ?></p>
                    <p><strong>Clinic Address:</strong> <?= htmlspecialchars($schedule['clinic_address']); ?></p>
                </div>
            </div>
            <div class="footer">
                <p>&copy; 2025 Care Compass Hospital. All Rights Reserved.</p>
            </div>
        </body>
        </html>
    `);
    billWindow.document.close();
    billWindow.focus();
}

</script>                    

</div><!-- /.wrapper -->

<script src="assets/js/jquery-3.5.1.min.js"></script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/main.js"></script>

</body>

</html>
