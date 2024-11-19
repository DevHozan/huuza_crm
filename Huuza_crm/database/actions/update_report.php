<?php
if (isset($_GET['approve'])) {  // Ensure this form uses POST method

    $reportId = $_GET['approve'];  // Get the report ID from the form
    $table = "reports";  // Table to update
    $data = [
        'status' => 'approved'  // The status to update
    ];
    $where = [
        'ReportID' => $reportId  // The condition to identify which report to update
    ];

    // Call the update method of MainClass
    $mainmanager->update($table, $data, $where);  // Assuming update method is correct
}

if (isset($_GET['delete'])) {  // Ensure this form uses POST method

    $reportId = $_GET['delete'];  // Get the report ID from the form
    $table = "reports";  // Table to delete from
    $where = [
        'ReportID' => $reportId  // The condition to identify which report to delete
    ];

    // Call the delete method of MainClass
    $mainmanager->delete($table, $where);  // Assuming delete method is correct
}

if (isset($_GET['disactivate'])) {  // Ensure this form uses POST method

    $reportId = $_GET['disactivate'];  // Get the report ID from the form
    $table = "reports";  // Table to update
    $data = [
        'status' => 'disactive'  // The status to update
    ];
    $where = [
        'ReportID' => $reportId  // The condition to identify which report to update
    ];

    // Call the update method of MainClass
    $mainmanager->update($table, $data, $where);  // Assuming update method is correct
}
?>
