<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT') ?: 4000;
$user = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$ssl_ca = __DIR__ . '/isrgrootx1.pem';

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
    (int)$port,
    NULL,
    MYSQLI_CLIENT_SSL
)) {
    die("Connection failed: " . mysqli_connect_error());
}
