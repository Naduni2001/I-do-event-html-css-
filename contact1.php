<?php
// Replace '_database_host', '_database_name', '_username', and '_password' with your actual database credentials
$servername = "localhost";
$dbname = "idoevent";
$username = "root";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $event_name = $_POST["event_name"];
    $address = $_POST["address"];
    $message = $_POST["message"];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO contact_details (name, email, number, event_name, address, message) VALUES (:name, :email, :number, :event_name, :address, :message)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':number', $number);
        $stmt->bindParam(':event_name', $event_name);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':message', $message);

        $stmt->execute();

        // Redirect to a thank you page after successful submission
        header("Location: thank_you_page.html");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>
