<?php
session_start(); // Start the session

include('../../../database/classes/UsersManager.php');
include('../../../database/classes/MainClass.php');
include('../../../database/connect.php');
include('../../../database/actions/update_report.php');
include('../../../database/actions/add_reports.php');
$table='view_users';
$users=$mainmanager->fetchAll($table);
$districts=$mainmanager->fetchAll('district');
$provinces=$mainmanager->fetchAll('province');
$reports =$mainmanager->fetchAllOnRole('reports_view','sales');
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
    <h2>Report Submission Form</h2>
    <form action="" method="POST">

        
        <!-- Report Type -->
        <label for="report_type">Report Type:</label>
   
        <select name="report_type" id="">
          <option value="daily">Today</option>
          <option value="weekly">Weekly</option>
        </select>

         
        <!-- Address -->
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" placeholder="eg:Musanze-karisimbi" required>


         <!-- Visiting Site -->
         <label for="visiting_site">Visiting Site:</label>
        <input type="text" id="visiting_site" name="visiting_site" placeholder="eg:Gorilla Motel or Home" required>

     

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
        <textarea id="description" name="description" required class="form-control" placeholder="Enter the description or the key contents to the site"></textarea>

        <!-- Status -->
        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="open">Open</option>
            <option value="in-progress">In Progress</option>
            <option value="closed">Closed</option>
        </select>

       
       

        <!-- Client Names -->
        <label for="client_names">Client Names:</label>
        <input type="text" id="client_names" name="Client_names" placeholder="eg:write the name of client" required>

        <!-- Client Type -->
        <label for="client_type">Client Type:</label>
        
        <select name="client_type" id="">
          <option value="">---select type of client---</option>
              <option value="candidate">Employee</option>
              <option value="employer">Employer</option>
        </select>

          <!-- Contact -->
          <label for="contact">Contact:</label>
        <input type="tel" id="contact" name="contact" placeholder="eg:0786647657" required>

         <!-- Feedback -->
         <label for="feedback">Feedback:</label>
        <select name="feedback" id="feedback">
          <option value="">Select Feedback Status</option>
          <option value="under_negotiation">Under Negotiation</option>
          <option value="lead">Lead</option>
          <option value="won">Won</option>
          <option value="lost">Lost</option>
          <option value="pending">Pending</option>
          <option value="follow_up">Follow Up</option>
          <option value="closed">Closed</option>
          <option value="not_interested">Not Interested</option>
          <option value="demo_scheduled">Demo Scheduled</option>
        </select>


        <input type="submit" name="submit_report" value="Submit Report">
    </form>
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
      <option value="reporttype">Report Type</option>
      <option value="status">Status</option>
      <option value="client_names">Client Name</option>
      <option value="visiting_site">Visiting Site</option>
      <option value="contact">Contact</option>
      <option value="address">Address</option>
    </select>
    <label for="filter">Search Value</label>
    <input type="text" id="filter_input" placeholder="Enter search value">
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title"><?= $_GET['head'] ?? 'Reports' ?></h5>

      <div style="width: 100%; overflow-x: auto;">
        <div class="card-container">
          <?php 
          
          foreach($reports as $report): ?>
            <div class="report-card" 
                 data-reporttype="<?= strtolower($report['ReportType']) ?>"
                 data-status="<?= strtolower($report['status']) ?>"
                 data-clientnames="<?= strtolower($report['Client_names']) ?>"
                 data-visitingSite="<?= strtolower($report['visiting_site']) ?>"
                 data-contact="<?= strtolower($report['contact']) ?>"
                 data-address="<?= strtolower($report['address']) ?>"
                 data-feedback="<?= strtolower($report['feedback']) ?>">
              <div class="card-header">
                <h6>Reporter name: <?= $report['username']; ?></h6>
              </div>
              <div class="card-body">
                <p><strong>Report Type:</strong> <?= $report['ReportType']; ?></p>
                <p><strong>Status:</strong> <?= $report['status']; ?></p>
                <p><strong>Client Name:</strong> <?= $report['Client_names']; ?></p>
                <p><strong>Visiting Site:</strong> <?= $report['visiting_site']; ?></p>
                <p><strong>Contact:</strong> <?= $report['contact']; ?></p>
                <p><strong>Address:</strong> <?= $report['address']; ?></p>
                <p><strong>Description:</strong> <?= $report['description']; ?></p>
                <p><strong>Feedback:</strong> <?= $report['feedback']; ?></p>
              </div>
              <div class="card-footer">
                <form method="get" action="reports.php">
                  <div class="btn-group">
                    <button type="submit" name="approve" value="<?= $report['ReportID']; ?>" class="btn btn-success">Approve</button>
                    <button type="submit" name="delete" value="<?= $report['ReportID']; ?>" class="btn btn-danger">Delete</button>
                    <button type="submit" name="disactivate" value="<?= $report['ReportID']; ?>" class="btn btn-warning">Deactivate</button>
                  </div>
                </form>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>

<style>
  .card-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
  }

  .report-card {
    width: 300px;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    overflow: hidden;
    background-color: #fff;
    transition: all 0.3s ease;
  }

  .report-card:hover {
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
    let cards = document.querySelectorAll('.report-card');
    
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
      &copy; Copyright <strong><span>Huuza CRM</span></strong>. All Rights Reserved
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