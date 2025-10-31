<?php
// Load environment variables from Render (set under "Environment" in the dashboard)
$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: 4000; // fallback to 4000 if not set
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$ssl_ca = __DIR__ . '/isrgrootx1.pem'; // Make sure this file is in your repo root

// Initialize MySQL connection
$conn = mysqli_init();

if (!$conn) {
    die("MySQL initialization failed.");
}

// Enable SSL for TiDB Cloud
mysqli_ssl_set($conn, NULL, NULL, $ssl_ca, NULL, NULL);

// Attempt secure connection
if (!mysqli_real_connect(
    $conn,
    $host,
    $user,
    $password,
    $database,
    (int)$port,
    NULL,
    MYSQLI_CLIENT_SSL
)) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_query($conn, "SET time_zone = '+08:00'");

// Optional success message for testing
//echo "✅ Connected successfully to TiDB Cloud!";
?>
