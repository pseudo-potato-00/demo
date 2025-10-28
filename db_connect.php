<?php
$host = 'gateway01.ap-southeast-1.prod.aws.tidbcloud.com'; // Your TiDB host
$port = 4000; // TiDB default port
$user = '3SVrJmiX7EkMehw.root'; // Your TiDB username
$password = 'uKiPr7lHDftihQXU'; // Your TiDB password
$database = 'energymeter_data'; // Your TiDB database name
$ssl_ca = __DIR__ . '/isrgrootx1.pem'; // Adjusted for Render path later

// Create connection with SSL
$conn = mysqli_init();

if (!$conn) {
    die("MySQL initialization failed.");
}

mysqli_ssl_set($conn, NULL, NULL, $ssl_ca, NULL, NULL);

if (!mysqli_real_connect(
    $conn,
    $host,
    $user,
    $password,
    $database,
    $port,
    NULL,
    MYSQLI_CLIENT_SSL
)) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($conn) {
    echo "✅ Connection successful!";
} else {
    echo "❌ Connection failed.";
}

// Optional: Confirm connection success
// echo "Connected successfully to TiDB Cloud!";
?>
