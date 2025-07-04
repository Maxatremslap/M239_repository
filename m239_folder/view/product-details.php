<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if product ID is provided in URL parameters
if (isset($_GET['id'])) {
    $product_id = (int)$_GET['id'];
} else {
    // Redirect to products page if no ID provided
    header('Location: products.php');
    exit;
}

// Database connection parameters
$host     = 'localhost';
$dbname   = 'furnitureshop_db';
$dbUser   = 'sadmin';
$dbPass   = 'Sadminpassword1!';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8",
        $dbUser,
        $dbPass
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch product details from database
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If product doesn't exist, redirect to products page
    if (!$product) {
        header('Location: products.php');
        exit;
    }
    
} catch (PDOException $exception) {
    die('Database connection error: ' . $exception->getMessage());
}

// Helper function to format CHF currency with apostrophe as thousands separator
function formatCHF($amount) {
    return number_format($amount, 2, '.', '\'');
}

// Helper function for safe output
function getSafe($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Check if the Add to Cart form was submitted
if (isset($_POST['add_to_cart'])) {
    try {
        // Retrieve product details from the form submission
        $product_id   = $_POST['product_id'];      
        $product_name = $_POST['product_name'];    
        $price        = $_POST['price'];           
        $quantity     = $_POST['quantity'];        
        $session_id   = session_id();

        // Insert the product into the "cart" table
        $sql = "INSERT INTO cart (session_id, product_id, product_name, price, quantity)
                VALUES (:session_id, :product_id, :product_name, :price, :quantity)";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':session_id'   => $session_id,
            ':product_id'   => $product_id,
            ':product_name' => $product_name,
            ':price'        => $price,
            ':quantity'     => $quantity
        ]);

        // Set success message
        $message = "Item added to cart!";
    } catch (PDOException $e) {
        $error_message = "Error adding to cart: " . $e->getMessage();
    }
}

// Get similar products (excluding current product)
$stmt = $pdo->prepare("SELECT * FROM products WHERE id != ? ORDER BY RAND() LIMIT 3");
$stmt->execute([$product_id]);
$similarProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo getSafe($product['name']); ?> - Max's Möbel">
  <meta name="author" content="Max Laemmler">
  <link rel="icon" href="../assets/images/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <title><?php echo getSafe($product['name']); ?> - Max's Möbel</title>
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/fontawesome.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/owl.css">
</head>
<body>
  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
      <div class="jumper">
          <div></div>
          <div></div>
          <div></div>
      </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <header>
      <nav class="navbar navbar-expand-lg">
          <div class="container">
              <a class="navbar-brand" href="index.php">
                  <h2>Max's Möbel <em>Store</em></h2>
              </a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                      aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarResponsive">
                  <ul class="navbar-nav ml-auto">
                      <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                      <li class="nav-item active"><a class="nav-link" href="products.php">Products <span class="sr-only">(current)</span></a></li>
                      <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
                      <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                      <?php if(isset($_SESSION['username'])): ?>
                          <!-- Greeting for logged in user -->
                          <li class="nav-item">
                              <span class="nav-link" style="pointer-events: none; color: #FFFFFF;">Hello, <?php echo getSafe($_SESSION['username']); ?>!</span>
                          </li>
                          <!-- Logout button -->
                          <li class="nav-item">
                              <a class="nav-link btn btn-outline-secondary btn-sm" href="../controller/logout.php">Logout</a>
                          </li>
                      <?php else: ?>
                          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                      <?php endif; ?>
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
                      <h4>Max's Möbel Collection</h4>
                      <h2><?php echo getSafe($product['name']); ?></h2>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- Main Product Section -->
  <div class="products">
      <div class="container">
          <div class="row">
              <!-- Product Images Column -->
              <div class="col-md-4 col-xs-12">
                  <div>
                      <img src="../assets/images/product-<?php echo $product_id; ?>-370x270.jpg" alt="<?php echo getSafe($product['name']); ?>" class="img-fluid wc-image">
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-sm-4 col-xs-6">
                          <div>
                              <img src="../assets/images/product-<?php echo $product_id; ?>-370x270.jpg" alt="<?php echo getSafe($product['name']); ?>" class="img-fluid">
                          </div>
                          <br>
                      </div>
                      <div class="col-sm-4 col-xs-6">
                          <div>
                              <img src="../assets/images/product-<?php echo ($product_id % 5) + 1; ?>-370x270.jpg" alt="<?php echo getSafe($product['name']); ?>" class="img-fluid">
                          </div>
                          <br>
                      </div>
                      <div class="col-sm-4 col-xs-6">
                          <div>
                              <img src="../assets/images/product-<?php echo (($product_id + 1) % 5) + 1; ?>-370x270.jpg" alt="<?php echo getSafe($product['name']); ?>" class="img-fluid">
                          </div>
                          <br>
                      </div>
                  </div>
              </div>
              <!-- Product Details Column -->
              <div class="col-md-8 col-xs-12">
                  <!-- If an item was added, show a message -->
                  <?php if (isset($message)) : ?>
                      <div class="alert alert-success" role="alert">
                          <?php echo htmlspecialchars($message); ?>
                      </div>
                  <?php endif; ?>
                  <?php if (isset($error_message)) : ?>
                      <div class="alert alert-danger" role="alert">
                          <?php echo htmlspecialchars($error_message); ?>
                      </div>
                  <?php endif; ?>
                  <!-- Product Details Form -->
                  <form action="" method="post" class="form">
                      <h2><?php echo getSafe($product['name']); ?></h2>
                      <br>
                      <p class="lead">
                          <small><del>CHF <?php echo formatCHF($product['price'] * 1.25); ?></del></small>
                          <strong class="text-primary">CHF <?php echo formatCHF($product['price']); ?></strong>
                      </p>
                      <br>
                      <p class="lead"><?php echo getSafe($product['description']); ?></p>
                      <br>
                      <div class="row">
                          <div class="col-sm-4">
                              <label class="control-label">Options</label>
                              <div class="form-group">
                                  <select class="form-control" name="extra">
                                      <?php if($product['category'] == 'seating'): ?>
                                          <option value="fabric">Premium Fabric</option>
                                          <option value="leather">Natural Leather</option>
                                          <option value="eco">Eco-friendly Material</option>
                                      <?php elseif($product['category'] == 'tables'): ?>
                                          <option value="oak">Oak Wood</option>
                                          <option value="walnut">Walnut Wood</option>
                                          <option value="pine">Pine Wood</option>
                                      <?php else: ?>
                                          <option value="standard">Standard</option>
                                          <option value="premium">Premium</option>
                                          <option value="custom">Custom</option>
                                      <?php endif; ?>
                                  </select>
                              </div>
                          </div>
                          <div class="col-sm-8">
                              <label class="control-label">Quantity</label>
                              <div class="row">
                                  <div class="col-sm-6">
                                      <div class="form-group">
                                          <input type="number" name="quantity" class="form-control" placeholder="1" value="1" min="1">
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <!-- Hidden product information -->
                                      <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                      <input type="hidden" name="product_name" value="<?php echo getSafe($product['name']); ?>">
                                      <input type="hidden" name="price" value="<?php echo getSafe($product['price']); ?>">
                                      <!-- Submit button for adding to cart -->
                                      <button type="submit" name="add_to_cart" class="btn btn-primary">Add to Cart</button>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>

  <!-- Similar Products Section -->
  <div class="latest-products">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="section-heading">
                      <h2>Similar Products</h2>
                      <a href="products.php">view more <i class="fa fa-angle-right"></i></a>
                  </div>
              </div>
              
              <?php foreach ($similarProducts as $similarProduct): ?>
              <div class="col-md-4">
                  <div class="product-item">
                      <a href="product-details.php?id=<?php echo getSafe($similarProduct['id']); ?>">
                          <img src="../assets/images/product-<?php echo getSafe($similarProduct['id']); ?>-370x270.jpg" alt="<?php echo getSafe($similarProduct['name']); ?>">
                      </a>
                      <div class="down-content">
                          <a href="product-details.php?id=<?php echo getSafe($similarProduct['id']); ?>">
                              <h4><?php echo getSafe($similarProduct['name']); ?></h4>
                          </a>
                          <h6>
                              <small><del>CHF <?php echo formatCHF($similarProduct['price'] * 1.25); ?></del></small>
                              CHF <?php echo formatCHF($similarProduct['price']); ?>
                          </h6>
                          <p><?php echo substr(getSafe($similarProduct['description']), 0, 100); ?>...</p>
                      </div>
                  </div>
              </div>
              <?php endforeach; ?>
              
          </div>
      </div>
  </div>

  <!-- Footer -->
  <footer>
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="inner-content">
                      <p>Copyright © 2025 Max's Möbel</p>
                  </div>
              </div>
          </div>
      </div>
  </footer>

  <!-- Bootstrap Scripts -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Additional Scripts -->
  <script src="../assets/js/custom.js"></script>
  <script src="../assets/js/owl.js"></script>
</body>
</html>