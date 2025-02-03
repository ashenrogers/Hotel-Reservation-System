<?php
// Include the database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form inputs and sanitize them
    $cardName = htmlspecialchars($_POST['cardName']);
    $cardNumber = htmlspecialchars($_POST['cardNumber']);
    $expDate = htmlspecialchars($_POST['expDate']);
    $cvv = htmlspecialchars($_POST['cvv']);
    $amount = htmlspecialchars($_POST['amount']);

    // Basic validation
    if (!empty($cardName) && !empty($cardNumber) && !empty($expDate) && !empty($cvv) && !empty($amount)) {
        // Insert data into the database
        $sql = "INSERT INTO payments (card_name, card_number, expiration_date, cvv, amount)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssds", $cardName, $cardNumber, $expDate, $cvv, $amount);

        if ($stmt->execute()) {
            echo "Payment saved successfully!";
        } else {
            echo "Error: " . $conn->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}

$conn->close();
?>
