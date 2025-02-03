<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hotel_reservation";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $cardName = $conn->real_escape_string($_POST['cardName']);
    $cardNumber = $conn->real_escape_string($_POST['cardNumber']);
    $expDate = $conn->real_escape_string($_POST['expDate']);
    $cvv = $conn->real_escape_string($_POST['cvv']);
    $amount = $conn->real_escape_string($_POST['amount']);

    // Basic validation
    if (!empty($cardName) && !empty($cardNumber) && !empty($expDate) && !empty($cvv) && !empty($amount)) {
        // Simulate payment processing
        // In a real-world scenario, integrate with a payment gateway here

        // Log the payment in the database
        $sql = "INSERT INTO payments (card_name, card_number, exp_date, cvv, amount) 
                VALUES ('$cardName', '$cardNumber', '$expDate', '$cvv', '$amount')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Payment successful! Thank you for your payment.'); window.location.href='HomePage.html';</script>";
        } else {
            echo "<script>alert('Error processing payment: " . $conn->error . "'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields correctly.'); window.history.back();</script>";
    }
} else {
    // Redirect to the payment page if the script is accessed without a POST request
    header("Location: PaymentPage.html");
    exit();
}

// Close the database connection
$conn->close();
?>
