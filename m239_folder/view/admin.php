<?php
session_start();

// Only admin should access this page.
if (!isset($_SESSION['username']) || strtolower($_SESSION['username']) !== 'admin') {
    header("Location: login.php");
    exit();
}

// Database connection parameters - adjust for your XAMPP setup
$host   = 'localhost';
$dbname = 'furnitureshop_db';
$dbUser = 'sadmin';
$dbPass = 'Sadminpassword1!';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die('Database Connection Error: ' . $exception->getMessage());
}

// Helper function to safely output data.
function getSafe($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Process product updates (price and stock)
if (isset($_POST['update_product'])) {
    $product_id = $_POST['product_id'];
    $price      = $_POST['price'];
    // If the checkbox is not checked, default to 0 (out of stock)
    $in_stock   = isset($_POST['in_stock']) ? 1 : 0;
    
    $sql = "UPDATE products SET price = :price, in_stock = :in_stock WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':price'    => $price,
        ':in_stock' => $in_stock,
        ':id'       => $product_id
    ]);
}

// Process new product insertion
if (isset($_POST['insert_product'])) {
    $name        = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
    $description = trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
    $price       = $_POST['price'];
    // in_stock comes from a select field ('1' or '0')
    $in_stock    = $_POST['in_stock'];
    
    if (!empty($name) && is_numeric($price)) {
        $sql = "INSERT INTO products (name, description, price, in_stock) VALUES (:name, :description, :price, :in_stock)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'        => $name,
            ':description' => $description,
            ':price'       => $price,
            ':in_stock'    => $in_stock
        ]);
    }
}

// Fetch products from the database
$sql = "SELECT * FROM products ORDER BY id ASC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Admin Panel - Manage Products - Max's Möbel</title>
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/fontawesome.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/owl.css">
    <style>
      .admin-container {
         margin-top: auto;
         margin-bottom: 50px;
      }
      .admin-container h2 {
         margin-bottom: 20px;
      }
      .table td, .table th {
         vertical-align: middle;
      }
    </style>
  </head>
  <body>
    <!-- Header -->
    <header>
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2>Online Store <em>Website</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                  aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
              <li class="nav-item">
                <span class="nav-link text-white">Hello, <?php echo getSafe($_SESSION['username']); ?>!</span>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary btn-sm" href="../controller/logout.php">Logout</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="admin.php">Admin Panel</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
    <!-- Main Content -->
    <div class="container admin-container">
      <h2 style="margin-bottom: 40px">Manage Products</h2>
      
      <!-- Products Table for Editing -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price (CHF)</th>
            <th>In Stock</th>
            <th>Update</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($products as $product): ?>
          <tr>
            <form method="post" action="admin.php">
              <td>
                <?php echo getSafe($product['id']); ?>
                <input type="hidden" name="product_id" value="<?php echo getSafe($product['id']); ?>">
              </td>
              <td><?php echo getSafe($product['name']); ?></td>
              <td><?php echo getSafe($product['description']); ?></td>
              <td>
                <input type="number" name="price" step="0.01" value="<?php echo getSafe($product['price']); ?>" class="form-control" style="width:100px;">
              </td>
              <td class="text-center">
                <input type="checkbox" name="in_stock" <?php echo ($product['in_stock']) ? 'checked' : ''; ?>>
              </td>
              <td>
                <button type="submit" name="update_product" class="btn btn-primary btn-sm">Update</button>
              </td>
            </form>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      
      <!-- Form to Insert a New Product -->
      <h2>Add New Product</h2>
      <form method="post" action="admin.php">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="new_name">Product Name</label>
            <input type="text" class="form-control" name="name" id="new_name" placeholder="Product Name" required>
          </div>
          <div class="form-group col-md-4">
            <label for="new_price">Price (CHF)</label>
            <input type="number" class="form-control" name="price" id="new_price" step="0.01" placeholder="Price" required>
          </div>
          <div class="form-group col-md-4">
            <label for="new_in_stock">In Stock</label>
            <select class="form-control" name="in_stock" id="new_in_stock" required>
              <option value="1" selected>Yes</option>
              <option value="0">No</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="new_description">Description</label>
          <textarea class="form-control" name="description" id="new_description" rows="3" placeholder="Description" required></textarea>
        </div>
        <button type="submit" name="insert_product" class="btn btn-success">Add Product</button>
      </form>
      
    </div>
    
    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/owl.js"></script>
  </body>
</html>
