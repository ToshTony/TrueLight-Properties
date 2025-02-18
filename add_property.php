<?php
include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $location = $_POST['location'];

    // Handle file upload
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $sql = "INSERT INTO properties (title, price, description, location, image) 
            VALUES ('$title', '$price', '$description', '$location', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "New property added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" enctype="multipart/form-data" name="add_property" action="add_property.php">
    <input type="text" name="title" placeholder="Title" required><br>
    <input type="text" name="price" placeholder="Price" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="text" name="location" placeholder="Location" required><br>
    <input type="file" name="image" required><br>
    <input type="submit" value="Add Property">
</form>

<script>
    function validateForm() {
        var title = document.forms["add_property"]["title"].value; // 1
        if (title == "") { // 2
            alert("Title must be filled out kalulu"); // 3
            return false; // 4
        }
    }
</script>

