<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // TODO: Perform validation and sanitization of form inputs

    // Database configuration
    $servername = "localhost";
    $username = "root";
    $db_password = ""; // Use a different variable name to avoid conflict with the password input variable
    $dbname = "delivero";

    // Create a database connection
    $conn = new mysqli($servername, $username, $db_password, $dbname); // Use $db_password instead of $password

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the email already exists
    $query = "SELECT * FROM signup WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Email already exists
        echo "exists";
    } else {
        // Email doesn't exist, insert user data into the database
        $query = "INSERT INTO signup (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($query) === true) {
            // User data inserted successfully
            echo "success";
        } else {
            // Error occurred while inserting user data
            echo "error";
        }
    }

    // Close the database connection
    $conn->close();
}
?>
