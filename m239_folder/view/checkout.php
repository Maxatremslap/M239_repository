<?php
session_start();
// check if the user is logged in.
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$host = 'localhost';
$dbUser = 'sadmin';
$dbname = 'furnitureshop_db';
$dbPass = 'Sadminpassword1!';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $ex) {
    die('Database connection error: ' . $ex->getMessage());
}

$session_id = session_id();
$message    = '';
$error      = '';
$showReceipt = false;

// Process removal of an item if "Remove" is clicked.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $item_id = $_POST['item_id'];
    $sql = "DELETE FROM cart WHERE id = :id AND session_id = :session_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $item_id, ':session_id' => $session_id]);
    $message = "Item removed from cart.";
}

// Process finishing the order when the "Finish" button is clicked.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finish'])) {
    if (!isset($_SESSION['username'])) {
        $error = "Please log in to complete your order.";
    } else {
        // Re-fetch cart items for the current session.
        $sql = "SELECT * FROM cart WHERE session_id = :session_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':session_id' => $session_id]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (empty($cartItems)) {
            $error = "Your cart is empty!";
        } else {
            // Generate a unique transaction ID.
            $transaction_id = strtoupper(uniqid('TX-'));
            $subtotal = 0;
            foreach ($cartItems as $item) {
                $subtotal += floatval($item['price']) * intval($item['quantity']);
            }
            // Fixed shipping cost 
            $shipping = 25;
            $total = $subtotal + $shipping;
            // Clear the cart – simulating that the order has been placed.
            $sql = "DELETE FROM cart WHERE session_id = :session_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':session_id' => $session_id]);
            $showReceipt = true;  // This will trigger the receipt view.
        }
    }
}

// If no finish action, then (re)fetch the current cart items.
if (!$showReceipt) {
    $sql = "SELECT * FROM cart WHERE session_id = :session_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':session_id' => $session_id]);
    $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += floatval($item['price']) * intval($item['quantity']);
    }
}

// A helper function to safely output data (to prevent XSS).
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
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Checkout - Max's Möbel - Quality furniture for your home">
    <meta name="author" content="Max Laemmler">
    <link rel="icon" href="../assets/images/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>Checkout - Max's Möbel</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
  </head>
  <body>
    <!-- Preloader -->
    <div id="preloader">
      <div class="jumper">
         <div></div>
         <div></div>
         <div></div>
      </div>
    </div>
    
    <!-- HEADER -->
    <header>
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php">
            <h2>Max's Möbel <em>Store</em></h2>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse"
                  data-target="#navbarResponsive" aria-controls="navbarResponsive"
                  aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                   aria-haspopup="true" aria-expanded="false">More</a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="about-us.php">About Us</a>
                  <a class="dropdown-item" href="blog.php">Blog</a>
                  <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                  <a class="dropdown-item" href="terms.php">Terms</a>
                </div>
              </li>
              <li class="nav-item active"><a class="nav-link" href="checkout.php">Checkout</a></li>
              <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
              <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item">
                  <span class="nav-link" style="pointer-events: none; color: #FFFFFF;">Hello, <?php echo getSafe($_SESSION['username']); ?>!</span>
                </li>
                <?php if (strtolower($_SESSION['username']) === 'admin'): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="admin.php">Admin Panel</a>
                  </li>
                <?php endif; ?>
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
    <div class="page-heading about-heading header-text" style="background-image: url(../assets/images/heading-6-1920x500.jpg);">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                <div class="text-content">
                   <h4>Review your selections</h4>
                   <h2>Shopping Cart</h2>
                </div>
             </div>
         </div>
      </div>
    </div>
    
    <!-- Main Content -->
    <div class="container mt-5">
      <?php if ($showReceipt): ?>
         <!-- Receipt Section -->
         <h2>Order Confirmation</h2>
         <p><strong>Transaction ID:</strong> <?php echo getSafe($transaction_id); ?></p>
         <p>Thank you for your purchase! A confirmation email has been sent to your registered email address.</p>
         <table class="table table-bordered table-striped">
            <thead>
               <tr>
                  <th>Product</th>
                  <th>Product Name</th>
                  <th>Quantity</th>
                  <th>Price</th>
                  <th>Total</th>
               </tr>
            </thead>
            <tbody>
              <?php foreach ($cartItems as $item): ?>
                 <tr>
                    <td><?php echo getSafe($item['product_id']); ?></td>
                    <td><?php echo getSafe($item['product_name']); ?></td>
                    <td><?php echo intval($item['quantity']); ?></td>
                    <td>CHF <?php echo formatCHF(floatval($item['price'])); ?></td>
                    <td>CHF <?php echo formatCHF(floatval($item['price']) * intval($item['quantity'])); ?></td>
                 </tr>
              <?php endforeach; ?>
            </tbody>
         </table>
         <ul class="list-group">
           <li class="list-group-item d-flex justify-content-between align-items-center">
             Sub-total <span>CHF <?php echo formatCHF($subtotal); ?></span>
           </li>
           <li class="list-group-item d-flex justify-content-between align-items-center">
             Shipping <span>CHF <?php echo formatCHF($shipping); ?></span>
           </li>
           <li class="list-group-item d-flex justify-content-between align-items-center">
             Total <span>CHF <?php echo formatCHF($total); ?></span>
           </li>
         </ul>
         <br>
         <div class="row">
           <div class="col-md-12">
             <div class="alert alert-success" role="alert">
               <h4 class="alert-heading">Your furniture is on its way!</h4>
               <p>Your order has been placed and will be delivered within 5-7 business days. Our delivery team will contact you to schedule a convenient delivery time.</p>
             </div>
           </div>
         </div>
         <a href="index.php" class="btn btn-primary">Continue Shopping</a>
      <?php else: ?>
         <?php if (!empty($message)): ?>
            <div class="alert alert-success" role="alert"><?php echo getSafe($message); ?></div>
         <?php endif; ?>
         <?php if (!empty($error)): ?>
            <div class="alert alert-danger" role="alert"><?php echo getSafe($error); ?></div>
         <?php endif; ?>
         <h2>Your Shopping Cart</h2>
         <?php if (!empty($cartItems)): ?>
            <table class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Product</th>
                     <th>Product Name</th>
                     <th>Quantity</th>
                     <th>Price</th>
                     <th>Total</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($cartItems as $item): ?>
                  <tr>
                     <td><?php echo getSafe($item['product_id']); ?></td>
                     <td><?php echo getSafe($item['product_name']); ?></td>
                     <td><?php echo getSafe($item['quantity']); ?></td>
                     <td>CHF <?php echo formatCHF(floatval($item['price'])); ?></td>
                     <td>CHF <?php echo formatCHF(floatval($item['price']) * intval($item['quantity'])); ?></td>
                     <td>
                        <form action="checkout.php" method="POST" style="display:inline;">
                           <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
                           <button type="submit" name="remove_item" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                     </td>
                  </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         <?php else: ?>
            <div class="alert alert-info">
              <p>Your shopping cart is empty. <a href="products.php">Browse our collection</a> to find beautiful furniture for your home.</p>
            </div>
         <?php endif; ?>
         
         <!-- Price Summary -->
         <?php if (!empty($cartItems)): ?>
           <div class="row mt-4">
              <div class="col-md-6">
                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Sub-total <span>CHF <?php echo formatCHF($subtotal); ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Shipping <span>CHF 25.00</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Total <span>CHF <?php echo formatCHF($subtotal + 25); ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                     Deposit payment required <span>CHF 20.00</span>
                  </li>
                </ul>
              </div>
           </div>
           <br>
           <!-- Finish Order Button: only display if logged in -->
           <?php if (isset($_SESSION['username'])): ?>
             <form action="checkout.php" method="POST">
                <button type="submit" name="finish" class="btn btn-primary">Finish Order &raquo;</button>
             </form>
           <?php else: ?>
             <div class="alert alert-warning">
               Please <a href="login.php">login</a> to complete your purchase. 
               <p class="mt-2 mb-0">Don't have an account? <a href="register.php">Register now</a> to track your orders and get exclusive offers.</p>
             </div>
           <?php endif; ?>
         <?php endif; ?>
      <?php endif; ?>
    </div>
  
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="inner-content">
              <p>Copyright &copy; 2025 Max's Möbel - Design: <a href="https://www.templatemo.com" target="_blank">TemplateMo</a></p>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/owl.js"></script>
  </body>
</html>