<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Delivero";

// Create a database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if any of the fields is empty
    
    // To prevent SQL injection
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    $sql = "SELECT * FROM restaurantdetails WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);
    $count = $result->num_rows;

    if ($count > 0) {
        // Redirect to the location page after successful login
        echo "<script>alert('Successfully Logged in.'); window.location.href = 'restaurantinterface.html';</script>";
        exit();
    } else {
        echo "<script>alert('Invalid credentials. Please enter valid details.'); window.location.href = 'restaurantlogin.html';</script>";
        exit();
    }
}
?>


