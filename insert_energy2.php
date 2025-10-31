<?php
include 'db_connect.php';
header('Content-Type: application/json'); // Output JSON

$api_key_value = "1234";
$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $api_key = test_input($_POST["api_key"] ?? '');

    if ($api_key === $api_key_value) {
        $sensorid = test_input($_POST["sensorid"] ?? '');
        $ampere = test_input($_POST["ampere"] ?? '');
        $voltage = test_input($_POST["voltage"] ?? '');
        $power = test_input($_POST["power"] ?? '');
        $energy = test_input($_POST["energy"] ?? '');
        $frequency = test_input($_POST["frequency"] ?? '');
        $pf = test_input($_POST["pf"] ?? '');
        $error = test_input($_POST["error"] ?? '');

        $sql = "INSERT INTO sensordata (sensorid, ampere, voltage, power, energy, frequency, pf, error)
                VALUES ('$sensorid', '$ampere', '$voltage', '$power', '$energy', '$frequency', '$pf', '$error')";

        if ($conn->query($sql) === TRUE) {
            $response = ["status" => "success", "message" => "New record created successfully"];
        } else {
            $response = ["status" => "error", "message" => $conn->error];
        }
    } else {
        $response = ["status" => "error", "message" => "Wrong API Key provided"];
    }
} else {
    $response = ["status" => "error", "message" => "No data posted with HTTP POST."];
}

echo json_encode($response);
$conn->close();

function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
