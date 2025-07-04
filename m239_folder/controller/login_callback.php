<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Database connection parameters – should match your login.php file
$host     = 'localhost';
$dbname   = 'furnitureshop_db';
$benutzer = 'sadmin';
$passwort = 'Sadminpassword1!';

$googleClientId = 'YOUR_GOOGLE_CLIENT_ID.apps.googleusercontent.com';
$googleClientSecret = 'YOUR_GOOGLE_CLIENT_SECRET'; // Important: Store this securely!
$redirectUri = 'http://' . $_SERVER['HTTP_HOST'] . '/m239/controller/login_callback.php';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8",
        $benutzer,
        $passwort
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die('Database connection error: ' . $exception->getMessage());
}

// Helper function for safe output
function getSafeInput($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Process the authorization code from Google
if (isset($_GET['code'])) {
    $code = $_GET['code'];
    
    // Exchange the authorization code for an access token
    $tokenUrl = 'https://oauth2.googleapis.com/token';
    $tokenData = [
        'code' => $code,
        'client_id' => $googleClientId,
        'client_secret' => $googleClientSecret,
        'redirect_uri' => $redirectUri,
        'grant_type' => 'authorization_code'
    ];
    
    // Initialize cURL session for token request
    $ch = curl_init($tokenUrl);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($tokenData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    
    // Execute the request and get response
    $tokenResponse = curl_exec($ch);
    $tokenError = curl_error($ch);
    curl_close($ch);
    
    if ($tokenError) {
        $_SESSION['error_message'] = "Failed to retrieve token: $tokenError";
        header('Location: ../view/login.php');
        exit();
    }
    
    // Parse the token response
    $tokenResult = json_decode($tokenResponse, true);
    
    if (!isset($tokenResult['access_token'])) {
        $_SESSION['error_message'] = "Invalid token response";
        header('Location: ../view/login.php');
        exit();
    }
    
    // Get user information with the access token
    $userInfoUrl = 'https://www.googleapis.com/oauth2/v3/userinfo';
    $ch = curl_init($userInfoUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization: Bearer ' . $tokenResult['access_token']]);
    
    // Execute the request and get response
    $userResponse = curl_exec($ch);
    $userError = curl_error($ch);
    curl_close($ch);
    
    if ($userError) {
        $_SESSION['error_message'] = "Failed to retrieve user information: $userError";
        header('Location: ../view/login.php');
        exit();
    }
    
    // Parse the user information
    $userInfo = json_decode($userResponse, true);
    
    if (!isset($userInfo['email'])) {
        $_SESSION['error_message'] = "Invalid user information";
        header('Location: ../view/login.php');
        exit();
    }
    
    // Check if the user exists in the database
    $sql = 'SELECT * FROM users WHERE email = :email';
    $statement = $pdo->prepare($sql);
    $statement->execute([':email' => $userInfo['email']]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // User exists, perform login
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['google_user'] = true;
        
        // Redirect to home page or dashboard
        header('Location: ../view/index.php');
        exit();
    } else {
        // User doesn't exist - redirect to registration
        $_SESSION['temp_google_data'] = [
            'email' => $userInfo['email'],
            'name' => $userInfo['name'] ?? '',
            'picture' => $userInfo['picture'] ?? '',
            'access_token' => $tokenResult['access_token']
        ];
        
        // Redirect to complete registration
        header('Location: ../view/login.php?complete_google_registration=1');
        exit();
    }
} else {
    // No authorization code provided
    $_SESSION['error_message'] = "Authorization failed. Please try again.";
    header('Location: ../view/login.php');
    exit();
}
?>