<?php
include ('../admin/php/config.php');
ini_set ('display_errors', 'on');
ini_set ('log_errors', 'on');
ini_set ('display_startup_errors', 'on');
ini_set ('error_reporting', E_ALL);
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if (isset($_POST['recaptcha_response'])) {

    // Build POST request:
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6Le4RKUUAAAAAAeZIGIX1FI8wPs0rtvgxlej4REZ';
    $recaptcha_response = $_POST['recaptcha_response'];

    // Make and decode POST request:
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);

    // Take action based on the score returned:
    if ($recaptcha->score >= 0.5) {
        // Verified - send email
    } else {
        die('Your IP address has been registed as insecure. Please contact a site administrator.');
    }
}
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
  die ("You are missing a required field!");
} else {
try {
    $sql = "INSERT INTO inbox (name, email, subject, message)
    VALUES ('$name', '$email', '$subject', '$message')";
    // use exec() because no results are returned
    $pdo->exec($sql);
    echo "Message succesfully sent!";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;}?>
