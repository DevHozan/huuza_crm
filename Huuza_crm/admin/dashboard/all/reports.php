<?php
session_start(); // Start the session

include('../../../database/classes/UsersManager.php');
include('../../../database/classes/MainClass.php');
include('../../../database/connect.php');
include('../../../database/actions/update_user.php');
include('../../../database/actions/add_users.php');
$table='view_users';
$users=$mainmanager->fetchAll($table);
$districts=$mainmanager->fetchAll('district');
$provinces=$mainmanager->fetchAll('province');
include("../inner_header.php");
?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
  <div class="row">
  <button class="btn btn-primary m-2" style="width:10%" onclick="openAddForm()">Add</button>

<div class="add-form" id="add_form" style="display: none; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); width: 400px; max-height: 80%; z-index: 999; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 8px; overflow-y: auto;">
    <style>
        /* General Reset */
        .form {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Container */
        .form .container {
            width: 100%;
            max-width: 400px; /* Reduced width */
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Heading */
        .form h2 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        /* Form Labels */
        .form label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
            color: #333;
        }

        /* Form Inputs */
        .form input[type="text"],
        .form input[type="email"],
        .form input[type="tel"],
        .form input[type="password"],
        .form select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
        }

        .form input[type="text"]:focus,
        .form input[type="email"]:focus,
        .form input[type="tel"]:focus,
        .form input[type="password"]:focus,
        .form select:focus {
            border-color: #007bff;
            outline: none;
        }

        /* Submit Button */
        .form input[type="submit"] {
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

        .form input[type="submit"]:hover {
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
            .form .container {
                padding: 20px;
                width: 90%;
            }

            h2 {
                font-size: 20px;
            }
        }
    </style>

    <div class="form container">
        <button id="hide_form" onclick="closeAddForm()">Back</button>
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
                <option value="coordinator">Sales Agent Coordinator</option>
                <option value="representative">Sales Agent Representative</option>
                <option value="agent">Sales Agent</option>
                <!-- Add other roles as needed -->
            </select>

            <label for="telephone">Telephone:</label>
            <input type="tel" id="telephone" name="PhoneNumber" required>

      
            <label for="password">District:</label>
            <select name="DistrictID" id="">
                <?php foreach($districts as $district) {
                    echo "<option value='" . $district['DistrictID'] . "'>" . $district['DistrictName'] . "</option>";
                } ?>
            </select>

            <label for="password">Province:</label>
            <select name="ProvinceID" id="">
                <?php foreach($provinces as $province) {
                    echo "<option value='" . $province['ProvinceID'] . "'>" . $province['ProvinceName'] . "</option>";
                } ?>
            </select>


                    


            <input type="password" id="password" name="Password" required>
            <input type="submit" name="register" value="Register">
        </form>
    </div>
</div>

<script>
    // Function to show the add form
    function openAddForm() {
        document.getElementById('add_form').style.display = 'block';
    }

    // Function to close the add form
    function closeAddForm() {
        document.getElementById('add_form').style.display = 'none';
    }
</script>
  
    </div>
</div>

<div class="col-lg-12">
  <div class="filter_form">
    <label for="category">Select Category</label>
    <select id="category_select">
      <option value="username">Username</option>
      <option value="role">Role</option>
      <option value="district">District</option>
      <option value="province">Province</option>
      <option value="email">Email</option>
      <option value="phone">Phone</option>
      <option value="status">Status</option>
    </select>
    <label for="filter">Search Value</label>
    <input type="text" id="filter_input" placeholder="Enter search value">
  </div>

  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?= $_GET['head'] ?? '' ?></h5>

      <div style="width: 100%; overflow-x: auto;">
        <div class="card-container">
          <?php foreach($users as $user): ?>
            <div class="user-card" 
                 data-username="<?= strtolower($user['username']) ?>"
                 data-role="<?= strtolower($user['Role']) ?>"
                 data-district="<?= strtolower($user['DistrictName']) ?>"
                 data-province="<?= strtolower($user['ProvinceName']) ?>"
                 data-email="<?= strtolower($user['Email']) ?>"
                 data-phone="<?= strtolower($user['PhoneNumber']) ?>"
                 data-status="<?= strtolower($user['status']) ?>">
              <div class="card-header">
                <h6>User ID: <?= $user['UserID']; ?></h6>
              </div>
              <div class="card-body">
                <p><strong>Username:</strong> <?= $user['username']; ?></p>
                <p><strong>Role:</strong> <?= $user['Role']; ?></p>
                <p><strong>District:</strong> <?= $user['DistrictName']; ?></p>
                <p><strong>Province:</strong> <?= $user['ProvinceName']; ?></p>
                <p><strong>Email:</strong> <?= $user['Email']; ?></p>
                <p><strong>Phone Number:</strong> <?= $user['PhoneNumber']; ?></p>
                <p><strong>Status:</strong> <?= $user['status']; ?></p>
              </div>
              <div class="card-footer">
                <form method="get" action="list.php">
                  <div class="btn-group">
                    <button type="submit" name="approve" value="<?= $user['UserID']; ?>" class="btn btn-success">Approve</button>
                    <button type="submit" name="delete" value="<?= $user['UserID']; ?>" class="btn btn-danger">Delete</button>
                    <button type="submit" name="disactivate" value="<?= $user['UserID']; ?>" class="btn btn-warning">Deactivate</button>
                  </div>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Styles for the card layout -->
<style>
  .card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
  }

  .user-card {
    width: 300px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    overflow: hidden;
    background-color: #fff;
    transition: all 0.3s ease;
  }

  .user-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }

  .card-header {
    background-color: #f5f5f5;
    padding: 15px;
    font-weight: bold;
    text-align: center;
  }

  .card-body {
    padding: 15px;
  }

  .card-footer {
    padding: 15px;
    text-align: center;
    background-color: #f5f5f5;
  }

  .btn-group .btn {
    margin: 5px;
  }

  .btn-success {
    background-color: #28a745;
    border: none;
  }

  .btn-danger {
    background-color: #dc3545;
    border: none;
  }

  .btn-warning {
    background-color: #ffc107;
    border: none;
  }
</style>

<script>
  // Event listener to filter cards based on selected category and input value
  document.getElementById('filter_input').addEventListener('input', function() {
    let filterValue = this.value.toLowerCase();
    let selectedCategory = document.getElementById('category_select').value;

    // Select all user cards
    let cards = document.querySelectorAll('.user-card');
    
    // Loop through each card and check if it matches the filter criteria
    cards.forEach(function(card) {
      let match = false;

      // Check if the card's data attributes contain the filter value for the selected category
      if (card.dataset[selectedCategory] && card.dataset[selectedCategory].includes(filterValue)) {
        match = true;
      }

      // Show or hide the card based on whether it matches the filter
      if (match) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  });
</script>
          </div>
          <!-- End Table with horizontal scroll -->

        </div>
      </div>

    </div>
  </div>
</section>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Jobbook</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="">IT Team</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../../assets/vendor/quill/quill.js"></script>
  <script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../../assets/js/main.js"></script>

</body>

</html>