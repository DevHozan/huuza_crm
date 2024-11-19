<?php

include('../database/classes/UsersManager.php');
include('../database/classes/MainClass.php');
include('../database/connect.php');
include('../database/actions/add_users.php');

$districts=$mainmanager->fetchAll('district');
$provinces=$mainmanager->fetchAll('province');



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body and Font Settings */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            padding: 40px;
        }

        /* Container */
        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Heading */
        h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form Labels */
        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        /* Form Inputs */
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="tel"]:focus,
        input[type="password"]:focus,
        select:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Submit Button */
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Link */
        p {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                width: 90%;
            }
            
            h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="" method="POST">
            <label for="names">Full Name:</label>
            <input type="text" id="names" name="Username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="Email" required>

            <label for="role">Role:</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="Sales Agent Officer">Sales Agent Officer</option>
                <option value="Sales Agent Representative">Sales Agent Representative</option>
                <option value="Sales Agent">Sales Agent</option>
                <!-- Add other roles as needed -->
            </select>

            <label for="telephone">Telephone:</label>
            <input type="tel" id="telephone" name="PhoneNumber" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="Password" required>

            
            <label for="password">Province:</label>
            <select name="ProvinceID" id="">
                <?php foreach($provinces as $province) {
                    echo "<option value='" . $province['ProvinceID'] . "'>" . $province['ProvinceName'] . "</option>";
                } ?>
            </select>

            
            <label for="password">District:</label>
            <select name="DistrictID" id="">
                <?php foreach($districts as $district) {
                    echo "<option value='" . $district['DistrictID'] . "'>" . $district['DistrictName'] . "</option>";
                } ?>
            </select>
            <input type="submit" name="register" value="Register" required>


            

        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
</body>
</html>
