<?php
if (isset($_GET['approve_payments'])) {  // Ensure this form uses GET method
    $paymentId = $_GET['approve'];  // Get the PaymentID from the URL
    $table = "payments";  // Table to update
    $data = [
        'PaymentStatus' => 'approved'  // The status to update
    ];
    $where = [
        'PaymentID' => $paymentId  // The condition to identify which payment to update
    ];

    // Call the update method of MainClass
    $mainmanager->update($table, $data, $where);  // Assuming update method is correct
}

if (isset($_GET['paid_payments'])) {  // Ensure this form uses GET method
    $paymentId = $_GET['approve'];  // Get the PaymentID from the URL
    $table = "payments";  // Table to update
    $data = [
        'PaymentStatus' => 'paid in full'  // The status to update
    ];
    $where = [
        'PaymentID' => $paymentId  // The condition to identify which payment to update
    ];

    // Call the update method of MainClass
    $mainmanager->update($table, $data, $where);  // Assuming update method is correct
}


if (isset($_GET['delete_payments'])) {  // Ensure this form uses GET method
    $paymentId = $_GET['delete'];  // Get the PaymentID from the URL
    $table = "payments";  // Table to delete from
    $where = [
        'PaymentID' => $paymentId  // The condition to identify which payment to delete
    ];

    // Call the delete method of MainClass
    $mainmanager->delete($table, $where);  // Assuming delete method is correct
}

if (isset($_GET['reject_payments'])) {  // Ensure this form uses GET method
    $paymentId = $_GET['disactivate'];  // Get the PaymentID from the URL
    $table = "payments";  // Table to update
    $data = [
        'PaymentStatus' => 'reject'  // The status to update
    ];
    $where = [
        'PaymentID' => $paymentId  // The condition to identify which payment to update
    ];

    // Call the update method of MainClass
    $mainmanager->update($table, $data, $where);  // Assuming update method is correct
}
?>
