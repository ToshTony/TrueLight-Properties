<?php
include 'con.php';

$sql = "SELECT * FROM properties";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "<h3>" . $row['title'] . "</h3>";
    echo "<p>" . $row['description'] . "</p>";
    echo "<p>Price: $" . $row['price'] . "</p>";
    echo "<p>Location: " . $row['location'] . "</p>";
    echo "<img src='" . $row['image'] . "' alt='Property Image' width='200'><br>";
    echo "</div>";
}
?>
