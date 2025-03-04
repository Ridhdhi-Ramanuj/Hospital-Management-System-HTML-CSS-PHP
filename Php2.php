<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    // Database connection settings
    $db_host = "localhost";
    $db_user = "root"; // Change this to your MySQL username
    $db_pass = "";     // Change this to your MySQL password
    $db_name = "abc"; // Change this to your database name

    // Create a database connection
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute an SQL INSERT statement
    $sql = "INSERT INTO appointments (name, email, mobile, subject, message, timestamp) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $mobile, $subject, $message);

    if ($stmt->execute()) {
        // Data inserted successfully
        echo "Your appointment has been successfully booked.";
    } else {
        // Error occurred while inserting data
        echo "Error: " . $conn->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Invalid request method
    echo "Error: Invalid request method.";
}
?>
