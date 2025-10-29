<?php
include 'db_connect.php'; // Use external connection file

$api_key_value = "1234"; // A secret key for security

// SQL query to retrieve data (customize as needed)
$sql = "SELECT * FROM sensorsetting"; 
$result = $conn->query($sql);

$data = array();
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data); // Encode the data as JSON

$conn->close();
?>
