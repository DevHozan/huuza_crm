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
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css">

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Huuza</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../../../assets/img/favicon.png" rel="icon">
  <link href="../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../../../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../../../assets/img/all_logo.png" alt="">
        <span class="d-none d-lg-block"></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

       
            <li>
              <hr class="dropdown-divider">
            </li>

           

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../../../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
    
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><? $_SESSION['username']; ?></h6>
              <span>Agent</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      

      <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="bi bi-house-door"></i> <!-- Home Icon -->
            <span>Home</span>
        </a>
    </li>
  

    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>My reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="list.php">
              <i class="bi bi-circle"></i><span>Visits</span>
            </a>
          </li>
          <li>
            <a href="reports.php">
              <i class="bi bi-circle"></i>all reports<span></span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Representatives</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="list.php">
              <i class="bi bi-circle"></i><span>Representatives</span>
            </a>
          </li>
          <li>
            <a href="reports.php">
              <i class="bi bi-circle"></i><span>Reports</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Sales Agent</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="list.php?head=List Of Agents">
              <i class="bi bi-circle"></i><span>Sales Agent</span>
            </a>
          </li>
          <li>
            <a href="reports.php?head=report Of Agents">
              <i class="bi bi-circle"></i><span>Reports</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

    
    <li class="nav-item">
        <a class="nav-link" href="general_report.html">
            <i class="bi bi-bar-chart-line"></i> <!-- General Report Icon -->
            <span>General Report</span>
        </a>
    </li>
    

      <li class="nav-item">
        <a class="nav-link collapsed" href="dashboard/signup.php">
          <i class="bi bi-card-list"></i>
          <span>Register</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../../../database/logout.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Logout</span>
        </a>
      </li><!-- End Login Page Nav -->


    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1></h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
    <h2>Report Submission Form</h2>
    <form action="" method="POST">
        
        <!-- Report Type -->
        <label for="report_type">Report Type:</label>
        <input type="text" id="report_type" name="ReportType" required>

        <!-- User ID (Assuming this would come from an existing users list) -->
        <!-- <label for="user_id">User ID:</label>
        <select id="user_id" name="UserID" required>
            <?php foreach($users as $user): ?>
                <option value="<?= $user['UserID']; ?>"><?= $user['username']; ?></option>
            <?php endforeach; ?>
        </select> -->
        <input type="hidden" id="user_id" name="UserID" value="<?= $_SESSION['user_id'] ?>" required>


        <!-- Description -->
        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <!-- Status -->
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="open">Open</option>
            <option value="in-progress">In Progress</option>
            <option value="closed">Closed</option>
        </select>

        <!-- Visiting Site -->
        <label for="visiting_site">Visiting Site:</label>
        <input type="text" id="visiting_site" name="visiting_site" required>

        <!-- Contact -->
        <label for="contact">Contact:</label>
        <input type="tel" id="contact" name="contact" required>

        <!-- Address -->
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <!-- Feedback -->
        <label for="feedback">Feedback:</label>
        <textarea id="feedback" name="feedback"></textarea>

        <!-- Client Names -->
        <label for="client_names">Client Names:</label>
        <input type="text" id="client_names" name="Client_names" required>

        <!-- Client Type -->
        <label for="client_type">Client Type:</label>
        <input type="text" id="client_type" name="Client_type" required>

        <input type="submit" name="submit_report" value="Submit Report">
    </form>
</div>

<script>
    function openAddForm() {
        document.getElementById('add_form').style.display = 'block';
    }

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
                            <th><b>Report ID</b></th>
                            <th>Report Type</th>
                            <th>User ID</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Visiting Site</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Feedback</th>
                            <th>Client Names</th>
                            <th>Client Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example dynamic row fetched from the database -->
                        <?php 
                        $reports = [];
                        foreach($reports as $report): ?>
                            <tr>
                                <td><?php echo $report['ReportID']; ?></td>
                                <td><?php echo $report['ReportType']; ?></td>
                                <td><?php echo $report['UserID']; ?></td>
                                <td><?php echo $report['description']; ?></td>
                                <td><?php echo $report['status']; ?></td>
                                <td><?php echo $report['visiting_site']; ?></td>
                                <td><?php echo $report['contact']; ?></td>
                                <td><?php echo $report['address']; ?></td>
                                <td><?php echo $report['feedback']; ?></td>
                                <td><?php echo $report['Client_names']; ?></td>
                                <td><?php echo $report['Client_type']; ?></td>
                                <td>
                                    <form method="get" action="list.php">
                                        <!-- Action buttons in a row -->
                                        <div class="btn-group" role="group">
                                            <!-- Approve Action -->
                                            <button type="submit" name="approve" value="<?php echo $report['ReportID']; ?>" class="btn btn-success">Approve</button>

                                            <!-- Delete Action -->
                                            <button type="submit" name="delete" value="<?php echo $report['ReportID']; ?>" class="btn btn-danger">Delete</button>

                                            <!-- Update Action -->
                                            <button type="submit" name="disactivate" value="<?php echo $report['ReportID']; ?>" class="btn btn-warning">Deactivate</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- End Table with horizontal scroll -->
        </div>
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