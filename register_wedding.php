<?php
// Include database connection
include('db.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data and sanitize inputs
    $name = htmlspecialchars($_POST['name']);
    $contact = htmlspecialchars($_POST['contact']);
    $email = htmlspecialchars($_POST['email']);
    $date = htmlspecialchars($_POST['date']);
    $weddingPlan = htmlspecialchars($_POST['weddingPlan']);
    $foodCombo = htmlspecialchars($_POST['foodCombo']);
    $cocktailMenu = htmlspecialchars($_POST['cocktailMenu']);
    $guestCount = intval($_POST['guestCount']);
    $totalAmount = htmlspecialchars($_POST['totalAmount']);

    // Basic validation to ensure required fields are filled
    if (!empty($name) && !empty($contact) && !empty($email) && !empty($date) && !empty($weddingPlan)) {
        // Prepare the SQL query to insert data
        $sql = "INSERT INTO wedding_reservations (name, contact, email, wedding_date, wedding_plan, food_combo, cocktail_menu, guest_count, total_amount)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare and bind parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssid", $name, $contact, $email, $date, $weddingPlan, $foodCombo, $cocktailMenu, $guestCount, $totalAmount);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Your wedding reservation has been successfully registered!";
            echo "<a href='Payment.html'>Press Here to payment</a>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }
}

$conn->close();
?>
