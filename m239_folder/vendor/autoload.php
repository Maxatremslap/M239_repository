<?php
// /vendor/autoload.php
// This file allows us to load the PHPMailer classes automatically.

spl_autoload_register(function ($class) {
    // This is a simple autoloader that works for the PHPMailer library structure.
    $prefix = 'PHPMailer\\PHPMailer\\';
    $base_dir = __DIR__ . '/PHPMailer/';
    
    // Does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }
    
    // Get the relative class name
    $relative_class = substr($class, $len);
    
    // Replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators, and append with .php
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
}); 