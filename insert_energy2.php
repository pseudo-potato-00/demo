<?php
include 'db_connect.php'; // Use your external database connection file
$api_key_value = "1234"; // A secret key for security

header('Content-Type: application/json'); // Tell Arduino we’re sending JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"]);
    if ($api_key == $api_key_value) {
        $sensorid = test_input($_POST["sensorid"]);
        $ampere = test_input($_POST["ampere"]);
        $voltage = test_input($_POST["voltage"]);
        $power = test_input($_POST["power"]);
        $energy = test_input($_POST["energy"]);
        $frequency = test_input($_POST["frequency"]);
        $pf = test_input($_POST["pf"]);
        $error = test_input($_POST["error"]);
        //$TimeStamp = test_input($_POST["TimeStamp"]);

        $sql = "INSERT INTO sensordata (sensorid, ampere, voltage, power, energy, frequency, pf, error)
                VALUES ('$sensorid', '$ampere', '$voltage', '$power', '$energy', '$frequency', '$pf', '$error')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode([
                "status" => "success",
                "message" => "New record created successfully"
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => $conn->error
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Wrong API Key provided."
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "No data posted with HTTP POST."
    ]);
}

$conn->close();

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
