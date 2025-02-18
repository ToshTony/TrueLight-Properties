<?php
$host = 'localhost';
$username = 'trueligh_tlight'; 
$password = 'nairobiC1ty'; 
$database = 'trueligh_tlight';

// try {
//     // Create a PDO instance
//     $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
//     // Set the PDO error mode to exception
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Connected successfully yeeey pdo!";
// } catch (PDOException $e) {
//     echo "Connection failed: " . $e->getMessage();
// }


// Create the connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    echo "Connection Failure!!!!!!";
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully!";
?>
