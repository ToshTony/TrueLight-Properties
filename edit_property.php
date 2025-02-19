<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include database connection
include 'con.php';

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch property data
    $sql = "SELECT * FROM properties WHERE id = '$id'";
    $result = $conn->query($sql);
    $property = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get data from form
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $location = $_POST['location'];
        
        // Initialize image SQL update (in case no new image is uploaded)
        $image_sql = "";

        // Check if a new image is uploaded
        if ($_FILES['image']['name']) {
            // Image upload logic if image is updated
            $image = $_FILES['image']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($image);
            
            // Move the uploaded file to the desired directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_sql = "image = '$target_file',";
            } else {
                echo "Error uploading image.";
                exit;
            }
        }

        // Construct the SQL query
        $sql = "UPDATE properties SET title = '$title', price = '$price', description = '$description', location = '$location'";

        // Add the image update only if there's a new image
        if ($image_sql != "") {
            $sql .= ", $image_sql";
        }

        // Complete the query with the WHERE clause
        $sql .= " WHERE id = '$id'";

        // Debug: print the SQL query to check for any issues
        // echo $sql;
        // exit;  // Stop script execution to inspect the query

        if ($conn->query($sql) === TRUE) {
            header("Location: dashboard.php");  // Redirect to dashboard after success
            exit;
        } else {
            echo "Error: " . $conn->error;
        }
    }
} else {
    echo "No property ID specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Edit Property</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="container">
        <h2>Edit Property</h2>
        <form action="edit_property.php?id=<?php echo $property['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Property Title</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($property['title']); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($property['price']); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required class="form-control"><?php echo htmlspecialchars($property['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($property['location']); ?>" required class="form-control" />
            </div>
            <div class="form-group">
                <label for="image">Property Image (Leave empty if not changing)</label>
                <input type="file" id="image" name="image" class="form-control" />
                <img src="<?php echo $property['image']; ?>" alt="Property Image" class="img-fluid mt-3" width="200px" />
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Property</button>
        </form>
    </div>
</body>
</html>
