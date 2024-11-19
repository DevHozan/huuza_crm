<?php
if (isset($_POST['add_payment'])) {
    // Collect form data for the payment record
    $dealID = $_POST['DealID'];
    $clientID = $_POST['ClientID'];
    $agentID = $_POST['AgentID'];
    $paymentType = $_POST['PaymentType'];
    $paymentStatus = $_POST['PaymentStatus'];
    $amountDue = $_POST['AmountDue'];
    $amountPaid = $_POST['AmountPaid'];
    
    $dueDate = $_POST['DueDate'];
    $datePaid = $_POST['DatePaid'];

    // Create the data array for the insert function
    $data = [
        'DealID' => $dealID,
        'ClientID' => $clientID,
        'AgentID' => $agentID,
        'PaymentType' => $paymentType,
        'PaymentStatus' => $paymentStatus,
        'AmountDue' => $amountDue,
        'AmountPaid' => $amountPaid,
        'DueDate' => $dueDate,
        'DatePaid' => $datePaid
    ];

    // Insert the data into the payments table
    $insertedId = $mainmanager->insert('payments', $data);

    // Check if the insertion was successful
    if ($insertedId) {
        echo "Payment record submitted successfully with ID: $insertedId";
    } else {
        echo "Error submitting payment record.";
    }
}
?>
