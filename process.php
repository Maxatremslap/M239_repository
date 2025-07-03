<?php
session_start();

// Database connection parameters – adjust as needed.
// Replace the placeholder values with your actual database credentials.
$host     = 'localhost'; // Usually 'localhost' if the database is on the same server.
$dbname   = 'furnitureshop_db'; // The name of your database.
$benutzer = 'sadmin'; // The database username.
$passwort = 'Sadminpassword1!'; // The database password.

try {
    $pdo = new PDO(
        "mysql:host=$host;port=3306;dbname=$dbname;charset=utf8",
        $benutzer,
        $passwort
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $exception) {
    die('Fehler bei der Verbindung: ' . $exception->getMessage());
}

// Nutzer registrieren
if (isset($_POST['register'])) {
    // Sanitize input using filter_input and trim
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password_input = $_POST['password'];

    if (empty($username) || empty($password_input)) {
        echo "Bitte alle Felder ausfüllen.";
        exit();
    }

    $password = password_hash($password_input, PASSWORD_DEFAULT);

    $sql = 'INSERT INTO users (username, password) VALUES (:username, :password)';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':username' => $username,
        ':password' => $password
    ]);

    // Option 1: Automatically log in the user after registration.
    $_SESSION['username'] = $username;
    header("Location: index.php");
    exit();

    // Option 2: Alternatively, you could redirect to the login page:
    // header("Location: login.php");
    // exit();
}

// Login-Überprüfung
if (isset($_POST['login'])) {
    $username = trim(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        echo "Bitte alle Felder ausfüllen.";
        exit();
    }
    
    $sql = 'SELECT * FROM users WHERE username = :username';
    $statement = $pdo->prepare($sql);
    $statement->execute([':username' => $username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Login fehlgeschlagen! Überprüfe deine Eingaben.";
        exit();
    }
}
?>
