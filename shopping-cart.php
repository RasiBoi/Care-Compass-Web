<?php
session_start();
include 'db_connection.php';

// Retrieve the session ID for cart identification
$session_id = session_id();

// Fetch cart items from the database
$cart_query = "
    SELECT 
        cart_items.id AS cart_id, 
        shop_items.name, 
        shop_items.image, 
        shop_items.price, 
        cart_items.quantity 
    FROM cart_items 
    JOIN shop_items 
    ON cart_items.product_id = shop_items.id 
    WHERE cart_items.session_id = '$session_id'
";
$cart_result = $conn->query($cart_query);

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $quantity = $_POST['quantity'];

    if ($quantity > 0) {
        // Update quantity for the cart item
        $update_query = "UPDATE cart_items SET quantity = $quantity WHERE id = $cart_id";
        $conn->query($update_query);
    } else {
        // Remove item from the cart if quantity is 0
        $delete_query = "DELETE FROM cart_items WHERE id = $cart_id";
        $conn->query($delete_query);
    }
    header('Location: shopping-cart.php');
    exit;
}

// Handle cart item removal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $cart_id = $_POST['cart_id'];
    $delete_query = "DELETE FROM cart_items WHERE id = $cart_id";
    $conn->query($delete_query);
    header('Location: shopping-cart.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart | Medcity</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">
  <link rel="stylesheet" href="assets/css/libraries.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    

    .cart-container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #fff;
    }

    .cart-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .cart-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }

    .cart-table th, 
    .cart-table td {
      border: 1px solid #ddd;
      padding: 15px;
      text-align: center;
    }

    .cart-table th {
      background-color: #f7f7f7;
    }

    .cart-table img {
      width: 50px;
      height: 50px;
      object-fit: cover;
    }

    .cart-actions {
      display: flex;
      justify-content: center;
      gap: 10px;
    }

    .btn-update, 
    .btn-remove {
      padding: 8px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-update {
      background-color: #007bff;
      color: #fff;
    }

    .btn-remove {
      background-color: #dc3545;
      color: #fff;
    }

    .cart-summary {
      border: 1px solid #ddd;
      padding: 20px;
      border-radius: 8px;
      background-color: #f7f7f7;
      text-align: right;
    }

    .cart-summary ul {
      list-style: none;
      padding: 0;
      margin: 0 0 20px;
    }

    .cart-summary ul li {
      display: flex;
      justify-content: space-between;
      padding: 5px 0;
    }

    .btn-checkout {
      padding: 10px 20px;
      background-color: #28a745;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    .btn-checkout:hover {
      background-color: #218838;
    }
  </style>
</head>

<body>
  <div class="wrapper">
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

    <section class="page-title">
      <div class="container">
        <h1 class="text-center">Shopping Cart</h1>
      </div>
    </section>

    <section class="shopping-cart">
      <div class="container">
        <div class="cart-layout">
          <!-- Cart Table -->
          <div class="cart-table table-responsive">
            <?php if ($cart_result->num_rows > 0): ?>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $total = 0;
                  while ($row = $cart_result->fetch_assoc()):
                      $item_total = $row['price'] * $row['quantity'];
                      $total += $item_total;
                  ?>
                    <tr>
                      <td>
                        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                        <p><?php echo $row['name']; ?></p>
                      </td>
                      <td>Rs<?php echo number_format($row['price'], 2); ?></td>
                      <td>
                        <form method="POST">
                          <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                          <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" style="width: 60px;">
                          <button type="submit" name="update_quantity" class="btn btn-primary">Update</button>
                        </form>
                      </td>
                      <td>Rs<?php echo number_format($item_total, 2); ?></td>
                      <td>
                        <form method="POST">
                          <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                          <button type="submit" name="remove_item" class="btn btn-danger">Remove</button>
                        </form>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            <?php else: ?>
              <p>Your cart is empty.</p>
            <?php endif; ?>
          </div>

          <!-- Cart Totals -->
          <div class="cart__total-amount">
            <h6>Cart Totals</h6>
            <ul>
              <li><span>Cart Subtotal:</span><span>Rs<?php echo number_format($total, 2); ?></span></li>
              <li><span>Order Total:</span><span>Rs<?php echo number_format($total, 2); ?></span></li>
            </ul>
            <a href="checkout.php" class="btn btn-success btn-block">Proceed to Checkout</a>
          </div>
        </div>
      </div>
    </section>

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

