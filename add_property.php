<?php
include 'con.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get data from form
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $image = $_FILES['image']['name'];
    
     // Handle file upload
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

      $sql = "INSERT INTO properties (title, price, description, location, image) 
            VALUES ('$title', '$price', '$description', '$location', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "New property added successfully.";
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Add Property</title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="container p-3">
        <h2>Add Property</h2>
        <form action="add_property.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Property Title</label>
                <input type="text" id="title" name="title" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="image">Property Image</label>
                <input type="file" id="image" name="image" required class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary m-4">Add Property</button> <span>  <a href="dashboard.php"  class="btn btn-info m-4">Back to Admin</a></span>
        </form>


      
    </div>
  </body>
</html>
