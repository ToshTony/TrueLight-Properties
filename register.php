<?php
include 'con.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful.";
        header("Location: login.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/tlogo.png" />
    <title>Admin Register</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #198754, #1987545e);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .login-box {
            background: #fff;
            padding: 40px;
            width: 300px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            transform: translateY(-50px);
            animation: slideIn 0.5s ease-out;
        }

        h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
            position: relative;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            color: #333;
            outline: none;
            transition: border-color 0.3s ease;
        }

        input:focus {
            border-color: #198754;
        }

        input[type="submit"] {
            background-color: #1987549e;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            padding: 12px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #198754;
        }

        .footer-links {
            margin-top: 20px;
        }

        .footer-links a {
            text-decoration: none;
            color: #198754;
            font-size: 14px;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: #555;
        }

        /* Animations */
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-box">
            <h2>Register</h2>
            <form method="POST" action="register.php">
                <div class="input-group">
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <input type="submit" value="Register">
            </form>
            <div class="footer-links">
                <a href="login.php">Already have an account? Login</a>
                <a href="contact.html">Contact Admin</a>
            </div>
        </div>
    </div>

    <script>
        // Optional JS for additional effects like form validation or interactivity
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");
            form.addEventListener("submit", function(event) {
                const username = form.username.value.trim();
                const email = form.email.value.trim();
                const password = form.password.value.trim();

                // Simple form validation
                if (!username || !email || !password) {
                    alert("Please fill out all fields.");
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>
