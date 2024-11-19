<?php
if (isset($_POST['register'])) {
    // Collect form data
    $names = $_POST['Username'];
    $password = $_POST['Password'];
    $telephone = $_POST['PhoneNumber'];
    $email = $_POST['Email'];
    $role = $_POST['role'];
    $status = 'pending';  // Assuming 'pending' is a checkbox or select field
    $provinceId = $_POST['ProvinceID'];
    $districtId = $_POST['DistrictID'];

    // Create the data array for the insert function
    $data = [
        'username' => $names,
        'Password' =>$password,// Hash the password before storing
        'Role' => $role,
        'DistrictID' => $districtId,
        'ProvinceID' => $provinceId,
        'Email' => $email,
        'PhoneNumber' => $telephone,
        'status' => $status
        // 'DateCreated' is handled automatically by the DB (current_timestamp)
        // 'LastLogin' is NULL initially and can be updated later when the user logs in
    ];

    // Insert the data into the users table
    $insertedId = $mainmanager->insert('users', $data);

    // Check if the insertion was successful
    if ($insertedId) {
        echo "User registered successfully with ID: $insertedId";
    } else {
        echo "Error registering user.";
    }
}
?>
