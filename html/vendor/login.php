<?php
session_start();

// check if user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Database connection parameters
$host   = 'localhost';
$dbname = 'furnitureshop_db';
$dbUser = 'sadmin';
$dbPass = 'Sadminpassword1!';

try {
    $pdo = new PDO("mysql:host=$host;port=3306;dbname=$dbname;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die('Fehler bei der Verbindung: ' . $exception->getMessage());
}

// Helper function for safe output
function getSafeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

$message = "";

// Registration processing
if (isset($_POST['register'])) {
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password_input = $_POST['password'];

    if (empty($username) || empty($password_input)) {
        $message = "Bitte alle Felder ausfüllen.";
    } else {
        $password = password_hash($password_input, PASSWORD_DEFAULT);
        $sql = 'INSERT INTO users (username, password) VALUES (:username, :password)';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':username' => $username,
            ':password' => $password
        ]);

        // Automatically log in after registration:
        $_SESSION['username'] = $username;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Login processing
if (isset($_POST['login'])) {
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "Bitte alle Felder ausfüllen.";
    } else {
        $sql = 'SELECT * FROM users WHERE username = :username';
        $statement = $pdo->prepare($sql);
        $statement->execute([':username' => $username]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        } else {
            $message = "Login fehlgeschlagen! Überprüfe deine Eingaben.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="assets/images/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <title>Max's Möbel</title>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <style>
    /* Custom page-specific styles */
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f4f4;
    }
    .login-container {
      margin-top: 50px;
      margin-bottom: 50px;
      padding-top: 85px;
    }
    .login-container h2 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="<?php echo $_SERVER['PHP_SELF']; ?>">
          <h2>Online Store <em>Website</em></h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" 
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <!-- Standard Navigation Items -->
            <li class="nav-item active"><a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="products.php">Products</a></li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" 
                 aria-haspopup="true" aria-expanded="false">More</a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="about-us.php">About Us</a>
                <a class="dropdown-item" href="blog.php">Blog</a>
                <a class="dropdown-item" href="testimonials.php">Testimonials</a>
                <a class="dropdown-item" href="terms.php">Terms</a>
              </div>
            </li>
            <li class="nav-item"><a class="nav-link" href="checkout.php">Checkout</a></li>
            <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
            <!-- Display greeting and logout if logged in -->
            <?php if (isset($_SESSION['username'])): ?>
              <li class="nav-item">
                <span class="nav-link text-white">Hello, <?php echo getSafeInput($_SESSION['username']); ?>!</span>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary btn-sm" href="logout.php">Logout</a>
              </li>
              <?php if (strtolower($_SESSION['username']) === 'admin'): ?>
                <li class="nav-item">
                  <a class="nav-link" href="admin.php">Admin Panel</a>
                </li>
              <?php endif; ?>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo $_SERVER['PHP_SELF']; ?>">Login</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  
  <!-- Main Content -->
  <div class="container login-container">
    <?php if (!empty($message)): ?>
      <div class="alert alert-warning" role="alert"><?php echo getSafeInput($message); ?></div>
    <?php endif; ?>
    <div class="row">
      <!-- Registration Form -->
      <div class="col-md-6">
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-primary text-white">
            <h2 class="h5 mb-0">Registrieren</h2>
          </div>
          <div class="card-body">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="form-group">
                <label for="reg_username">Benutzername</label>
                <input type="text" name="username" id="reg_username" class="form-control" placeholder="Benutzername" required>
              </div>
              <div class="form-group">
                <label for="reg_password">Passwort</label>
                <input type="password" name="password" id="reg_password" class="form-control" placeholder="Passwort" required>
              </div>
              <button type="submit" name="register" class="btn btn-primary btn-block">Registrieren</button>
            </form>
          </div>
        </div>
      </div>
      
      <!-- Login Form -->
      <div class="col-md-6">
        <div class="card shadow-sm mb-4">
          <div class="card-header bg-success text-white">
            <h2 class="h5 mb-0">Login</h2>
          </div>
          <div class="card-body">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <div class="form-group">
                <label for="login_username">Benutzername</label>
                <input type="text" name="username" id="login_username" class="form-control" placeholder="Benutzername" required>
              </div>
              <div class="form-group">
                <label for="login_password">Passwort</label>
                <input type="password" name="password" id="login_password" class="form-control" placeholder="Passwort" required>
              </div>
              <button type="submit" name="login" class="btn btn-success btn-block">Login</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Additional Scripts -->
  <script src="assets/js/custom.js"></script>
  <script src="assets/js/owl.js"></script>
</body>
</html>
