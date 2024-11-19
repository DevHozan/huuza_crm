<?php
if (isset($_POST['submit_report'])) {
    // Collect form data for the report
    $reportType = $_POST['ReportType'];
    $userID = $_POST['UserID'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $visitingSite = $_POST['visiting_site'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $feedback = $_POST['feedback'];
    $clientNames = $_POST['Client_names'];
    $clientType = $_POST['Client_type'];

    // Create the data array for the insert function
    $data = [
        'ReportType' => $reportType,
        'UserID' => $userID,
        'description' => $description,
        'status' => $status,
        'visiting_site' => $visitingSite,
        'contact' => $contact,
        'address' => $address,
        'feedback' => $feedback,
        'Client_names' => $clientNames,
        'Client_type' => $clientType
        // 'ReportID' is auto-incremented by the database
        // 'DateCreated' can be handled automatically by the DB using current_timestamp
    ];

    // Insert the data into the reports table
    $insertedId = $mainmanager->insert('reports', $data);

    // Check if the insertion was successful
    if ($insertedId) {
        echo "Report submitted successfully with ID: $insertedId";
    } else {
        echo "Error submitting report.";
    }
}
?>
