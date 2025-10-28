<?php
$servername = "localhost"; // Replace with your MySQL server name
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "energymeter_data"; // Replace with your database name
$api_key_value = "1234"; // A secret key for security

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $sensorid = test_input($_POST["sensorid"]);
        $ampere = test_input($_POST["ampere"]);
        $voltage = test_input($_POST["voltage"]);
        $power = test_input($_POST["power"]);
        $energy = test_input($_POST["energy"]);
		$frequency = test_input($_POST["frequency"]);
		$pf = test_input($_POST["pf"]);
		$error = test_input($_POST["error"]);
		//$TimeStamp = test_input($_POST["TimeStamp"]);
		
        $sql = "INSERT INTO sensordata (sensorid, ampere, voltage, power, energy, frequency, pf,error)
                VALUES ('" . $sensorid . "', '" . $ampere . "', '" . $voltage . "', '" . $power . "', '" . $energy . "', '" . $frequency . "', '" . $pf . "', '" . $error . "')";

        if ($conn->query($sql) === TRUE) {
			
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Wrong API Key provided.";
    }
} else {
    echo "No data posted with HTTP POST.";
}

$conn->close();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>