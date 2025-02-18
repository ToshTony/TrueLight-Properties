<?php
include 'con.php'; // Your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $message = $_POST['message'];

    // Insert into database
    $sql = "INSERT INTO contact_messages (name, email, phone_number, message) 
            VALUES ('$name', '$email', '$phone_number', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Message sent successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
