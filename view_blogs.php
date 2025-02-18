<?php
include 'con.php';

$sql = "SELECT * FROM blogs";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['title'] . "</h3>";
    echo "<p>" . $row['content'] . "</p>";
    echo "<p>Author: " . $row['author'] . "</p>";
    echo "<p>Email: " . $row['email'] . "</p>";
    echo "<img src='" . $row['image'] . "' alt='Blog Image' width='200'><br>";
    echo "</div>";
}
?>
