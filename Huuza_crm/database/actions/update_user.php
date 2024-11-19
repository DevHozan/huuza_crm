<?php
if (isset($_GET['approve'])) {  // Ensure this form uses POST method

    $userid = $_GET['approve'];  // Get the user ID from the form
    $table = "users";  // Table to update
    $data = [
        'status' => 'approved'  // The status to update
    ];
    $where = [
        'UserId' => $userid  // The condition to identify which user to update
    ];

    // Call the update method of MainClass
    $mainmanager->update($table, $data, $where);  // Assuming update method is correct
}
if (isset($_GET['delete'])) {  // Ensure this form uses POST method

    $userid = $_GET['delete'];  // Get the user ID from the form
    $table = "users";  // Table to update
 
    $where = [
        'UserId' => $userid  // The condition to identify which user to update
    ];

    // Call the update method of MainClass
    $mainmanager->delete($table, $where);  // Assuming update method is correct
}

if (isset($_GET['disactivate'])) {  // Ensure this form uses POST method

    $userid = $_GET['disactivate'];  // Get the user ID from the form
    $table = "users";  // Table to update
    $data = [
        'status' => 'disactive'  // The status to update
    ];
    $where = [
        'UserId' => $userid  // The condition to identify which user to update
    ];

    // Call the update method of MainClass
    $mainmanager->update($table, $data, $where);  // Assuming update method is correct
}
?>
