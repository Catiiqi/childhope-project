<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "childhope";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $phone = $_POST["phone_number"];
    $knowOrphanCare = $_POST["known_about"];
    $whyVolunteer = $_POST["volunteer"];
    $area = $_POST["area"];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO contactus (name, age, email, phone_number, known_about, volunteer, area) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $name, $age, $email, $phone, $knowOrphanCare, $whyVolunteer, $area);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: home.html");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>