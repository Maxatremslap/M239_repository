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
$message_type = "warning"; // Default message type

// Check for success or error messages from callbacks
if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    $message_type = "success";
    unset($_SESSION['success_message']);
}

if (isset($_SESSION['error_message'])) {
    $message = $_SESSION['error_message'];
    $message_type = "danger";
    unset($_SESSION['error_message']);
}

// Registration processing
if (isset($_POST['register'])) {
    $username = trim(htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8'));
    $password_input = $_POST['password'];
    $email = isset($_POST['email']) ? trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL)) : null;

    if (empty($username) || empty($password_input)) {
        $message = "Bitte alle Felder ausfüllen.";
    } else {
        // Check if username already exists
        $checkUsername = 'SELECT COUNT(*) FROM users WHERE username = :username';
        $checkStmt = $pdo->prepare($checkUsername);
        $checkStmt->execute([':username' => $username]);
        $usernameExists = (int)$checkStmt->fetchColumn();
        
        if ($usernameExists > 0) {
            $message = "Dieser Benutzername ist bereits vergeben. Bitte wählen Sie einen anderen.";
        } else {
            // Standard registration
            $password = password_hash($password_input, PASSWORD_DEFAULT);
            
            // Check if we need to add email
            if (!empty($email)) {
                $sql = 'INSERT INTO users (username, password, email) VALUES (:username, :password, :email)';
                $params = [
                    ':username' => $username,
                    ':password' => $password,
                    ':email' => $email
                ];
            } else {
                $sql = 'INSERT INTO users (username, password) VALUES (:username, :password)';
                $params = [
                    ':username' => $username,
                    ':password' => $password
                ];
            }
            
            $statement = $pdo->prepare($sql);
            $statement->execute($params);

            // Automatically log in after registration
            $_SESSION['username'] = $username;
            if (!empty($email)) {
                $_SESSION['email'] = $email;
            }
            
            // Redirect to current page
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }
}

// Login processing
if (isset($_POST['login'])) {
    $username = trim(htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8'));
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "Bitte alle Felder ausfüllen.";
    } else {
        // Check both username and email for login
        $sql = 'SELECT * FROM users WHERE username = :username OR email = :email';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':username' => $username,
            ':email' => $username // Support login with email too
        ]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['id'];
            if (!empty($user['email'])) {
                $_SESSION['email'] = $user['email'];
            }
            
            // Redirect to current page
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
  <meta name="description" content="Login or register for Max's Möbel furniture store">
  <meta name="author" content="Max Lämmler">
  <link rel="icon" href="../assets/images/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
  <title>Login - Max's Möbel</title>
  <!-- Bootstrap core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="../assets/css/fontawesome.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/owl.css">
  <style>
    /* Custom page-specific styles */
    .login-heading {
      background-image: url(../assets/images/heading-4-1920x500.jpg);
      background-position: center center;
      background-repeat: no-repeat;
      background-size: cover;
      padding-top: 230px;
      padding-bottom: 110px;
      text-align: center;
    }
    
    .login-heading .text-content {
      background-color: rgba(0,0,0,0.5);
      padding: 30px;
      border-radius: 5px;
    }
    
    .login-heading h4,
    .login-heading h2 {
      color: #fff;
      font-weight: 700;
    }
    
    .login-container {
      margin-top: 50px;
      margin-bottom: 50px;
    }
    
    .login-container h2 {
      margin-bottom: 20px;
    }
    
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .card-header {
      border-radius: 10px 10px 0 0 !important;
      padding: 15px 20px;
    }
  </style>
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

  <!-- Header -->
  <header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <h2>Max's Möbel<em>Store</em></h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" 
                aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <!-- Standard Navigation Items -->
            <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
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
                <span class="nav-link" style="pointer-events: none; color: #FFFFFF;">Hello, <?php echo getSafeInput($_SESSION['username']); ?>!</span>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-outline-secondary btn-sm" href="../controller/logout.php">Logout</a>
              </li>
              <?php if (strtolower($_SESSION['username']) === 'admin'): ?>
                <li class="nav-item">
                  <a class="nav-link" href="admin.php">Admin Panel</a>
                </li>
              <?php endif; ?>
            <?php else: ?>
              <li class="nav-item active"><a class="nav-link" href="login.php">Login</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  
  <!-- Page Heading -->
  <div class="page-heading login-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="text-content">
            <h4>Secure account access</h4>
            <h2>Login or Register</h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Main Content -->
  <div class="container login-container">
    <?php if (!empty($message)): ?>
      <div class="alert alert-<?php echo $message_type; ?>" role="alert"><?php echo getSafeInput($message); ?></div>
    <?php endif; ?>
    
      <div class="row">
        <!-- Login Form -->
        <div class="col-md-6">
          <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
              <h2 class="h5 mb-0">Login</h2>
            </div>
            <div class="card-body">
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                  <label for="login_username">Username or Email</label>
                  <input type="text" name="username" id="login_username" class="form-control" placeholder="Enter your username or email" required>
                </div>
                <div class="form-group">
                  <label for="login_password">Password</label>
                  <input type="password" name="password" id="login_password" class="form-control" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
              </form>
            </div>
          </div>
        </div>
        
        <!-- Registration Form -->
        <div class="col-md-6">
          <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">
              <h2 class="h5 mb-0">Register</h2>
            </div>
            <div class="card-body">
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                  <label for="reg_username">Username</label>
                  <input type="text" name="username" id="reg_username" class="form-control" placeholder="Choose a username" required>
                </div>
                <div class="form-group">
                  <label for="reg_email">Email (optional)</label>
                  <input type="email" name="email" id="reg_email" class="form-control" placeholder="Enter your email">
                </div>
                <div class="form-group">
                  <label for="reg_password">Password</label>
                  <input type="password" name="password" id="reg_password" class="form-control" placeholder="Choose a password" required>
                </div>
                <button type="submit" name="register" class="btn btn-success btn-block">Register</button>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
  
  <!-- Call to Action -->
  <div class="call-to-action">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <div class="row">
              <div class="col-md-8">
                <h4>Ready to explore our collection?</h4>
                <p>Browse our extensive catalog of handcrafted furniture and find pieces that will transform your space.</p>
              </div>
              <div class="col-lg-4 col-md-6 text-right">
                <a href="products.php" class="filled-button">Browse Products</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="inner-content">
            <p>Copyright &copy; 2025 Max's Möbel</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  
  <!-- Bootstrap core JavaScript -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Additional Scripts -->
  <script src="../assets/js/custom.js"></script>
  <script src="../assets/js/owl.js"></script>
  
</body>
</html>
