<?php
session_start();

// Database connection parameters
$host   = 'localhost';
$dbname = 'furnitureshop_db';
$dbUser = 'sadmin';
$dbPass = 'Sadminpassword1!';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $exception) {
    die('Database Connection Error: ' . $exception->getMessage());
}

// Retrieve products from the "products" table
$sql = "SELECT * FROM products ORDER BY id ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Helper function for safe output
function getSafe($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Helper function to format CHF currency with apostrophe as thousands separator
function formatCHF($amount) {
    return number_format($amount, 2, '.', '\'');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../assets/images/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <title>Max's Möbel</title>
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/fontawesome.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/owl.css">
  <style>
    /* Custom styling if needed */
    .product-item {
        margin-bottom: 30px;
    }
    .down-content h4 {
        margin-bottom: 5px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.php"><h2>Online Store <em>Website</em></h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" 
                data-target="#navbarResponsive" aria-controls="navbarResponsive" 
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <!-- Standard Navigation Items -->
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item active"><a class="nav-link" href="products.php">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Page Heading -->
  <div class="page-heading about-heading header-text" style="background-image:url(../assets/images/heading-6-1920x500.jpg);">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Find the best furniture for your home</h4>
            <h2>Products</h2>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Products Section -->
  <div class="products">
    <div class="container">
      <div class="row">
        <?php foreach ($products as $product): ?>
          <div class="col-md-4">
            <div class="product-item">
              <!-- The image file is constructed using the product id. Adjust if needed. -->
              <a href="product-details.php?id=<?php echo getSafe($product['id']); ?>">
                <img src="../assets/images/product-<?php echo getSafe($product['id']); ?>-370x270.jpg" alt="<?php echo getSafe($product['name']); ?>">
              </a>
              <div class="down-content">
                <a href="product-details.php?id=<?php echo getSafe($product['id']); ?>"><h4><?php echo getSafe($product['name']); ?></h4></a>
                <!-- Pricing updated to CHF format with apostrophe as thousands separator -->
                <h6>
                  <small><del>CHF <?php echo formatCHF(getSafe($product['price']) * 1.25); ?></del></small>
                  CHF <?php echo formatCHF(getSafe($product['price'])); ?>
                </h6>
                <p><?php echo getSafe($product['description']); ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>

  <!-- Bootstrap Scripts -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/custom.js"></script>
  <script src="../assets/js/owl.js"></script>
</body>
</html>
