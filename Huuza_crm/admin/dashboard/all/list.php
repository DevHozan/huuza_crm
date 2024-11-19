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


      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><?= $_GET['head'] ?? '' ?></h5>

          <!-- Table in a frame with horizontal scroll -->
          <div style="width: 100%; overflow-x: auto;">
            <table class="table datatable" style="min-width: 1000px;">
              <thead>
                <tr>
                  <th><b>User ID</b></th>
                  <th>Username</th>
                  <!-- <th>password</th> -->
                  <th>Role</th>
                  <th>District</th>
                  <th>Province</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Date Created</th>
                  <th>Last Login</th>
                  <th>Status</th>
                  <th>Action</th>
                  
                </tr>
              </thead>
              <tbody>
                <!-- Example dynamic row fetched from the database -->
                <?php foreach($users as $user): ?>
                            <tr>
                                <td><?php echo $user['UserID']; ?></td>
                                <td><?php echo $user['username']; ?></td>
                                <!-- <td><?php echo $user['Password']; ?></td> Be careful with displaying passwords -->
                                <td><?php echo $user['Role']; ?></td>
                                <td><?php echo $user['DistrictName']; ?></td>
                                <td><?php echo $user['ProvinceName']; ?></td>
                                <td><?php echo $user['Email']; ?></td>
                                <td><?php echo $user['PhoneNumber']; ?></td>
                                <td><?php echo $user['DateCreated']; ?></td>
                                <td><?php echo $user['LastLogin']; ?></td>
                                <td><?php echo $user['status']; ?></td>
                                <td>
                                <form method="get" action="list.php">
                             <!-- Action buttons in a row -->
                        <div class="btn-group" role="group">
                            <!-- Approve Action -->
                            <button type="submit" name="approve" value="<?php echo $user['UserID']; ?>" class="btn btn-success">Approve</button>

                            <!-- Delete Action -->
                            <button type="submit" name="delete" value="<?php echo $user['UserID']; ?>" class="btn btn-danger">Delete</button>

                            <!-- Update Action -->
                            <button type="submit" name="disactivate" value="<?php echo $user['UserID']; ?>" class="btn btn-warning">Desactivate</button>
                        </div>
                        </form>
                             </td>
                            </tr>
                            <?php endforeach; ?>

                <!-- Add more rows here dynamically from the database -->
              </tbody>
            </table>
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