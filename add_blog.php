<?php
include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $author = $_POST['author'];
    $email = $_POST['email'];

    // Handle file upload
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $sql = "INSERT INTO blogs (title, content, author, email, image) 
            VALUES ('$title', '$content', '$author', '$email', '$target_file')";

    if ($conn->query($sql) === TRUE) {
        echo "New blog post added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form method="POST" enctype="multipart/form-data" action="add_blog.php">
    <input type="text" name="title" placeholder="Title" required><br>
    <textarea name="content" placeholder="Content" required></textarea><br>
    <input type="text" name="author" placeholder="Author" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="file" name="image" required><br>
    <input type="submit" value="Add Blog Post">
</form>
