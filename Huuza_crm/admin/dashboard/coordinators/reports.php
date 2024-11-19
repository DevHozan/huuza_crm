<?php
session_start(); // Start the session
if(!isset($_SESSION['username'])){
  header('location:../../../database/logout.php');

}

include('../../../database/classes/UsersManager.php');
include('../../../database/classes/MainClass.php');
include('../../../database/connect.php');
include('../../../database/actions/update_report.php');
include('../../../database/actions/update_expense.php');
include('../../../database/actions/add_reports.php');
$table='view_users';
$users=$mainmanager->fetchAll($table);
$districts=$mainmanager->fetchAll('district');
$provinces=$mainmanager->fetchAll('province');
$expenses=$mainmanager->fetchAll('payments');
$reports =$mainmanager->fetchAllOnRole('reports_view','coordinator');
include("../inner_header.php");
?>

  <main id="main" class="main">

    <div class="pagetitle">
      
      <nav class="navbar navbar-expand-lg navbar-light bg-dark">
  <div class="container-fluid">
    <!-- Navigation links for each user -->
    <?php foreach($users as $user): ?>
      <a href="reports.php?userid=<?=$user['UserID']?>" 
         class="btn btn-success ">
         <?php echo $user['username']; ?>
      </a>
    <?php endforeach; ?>
  </div>
</nav>

<?php

if (isset($_GET['userid']) && isset($users)) {
    echo "<div class='container mt-4'>";
    echo "<div class='row'>";

    // Loop through users to match the UserID
    foreach ($users as $user) {
        if ($user['UserID'] == $_GET['userid']) {
            echo "<div class='col-lg-9'>";
            echo "<div class='card p-3 mb-4'>";
            echo "<h5 class='card-title'>{$user['username']}'s Reports</h5>";
            echo "<div class='d-flex justify-content-start gap-3'>";
            echo "<button id='employees' class='btn btn-primary'>Employees</button>";
            echo "<button id='employers' class='btn btn-primary'>Employers</button>";
            echo "<button id='expenses' class='btn btn-primary'>Expenses</button>";
            echo "</div>";
            echo "</div>"; // Close card
             echo "</div>"; // Close col-lg-9
        }
    }
    echo "</div>"; // Close row
    echo "</div>"; // Close container
}

?>




    </div><!-- End Page Title -->
    <section class="section">
  <div class="row">
  <!-- <button class="btn btn-primary m-2" style="width:10%" onclick="openAddForm()">Add</button> -->

<div class="add-form" id="add_form" style="display: none; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); width: 400px; max-height: 80%; z-index: 999; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 8px; overflow-y: auto;">
    <style>
      button {
        background-color:#8A143E;
      }
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
      <option value="client_type">Client Type</option>
      <option value="visiting_site">Visiting Site</option>
      <option value="contact">Contact</option>
      <option value="address">Address</option>
    </select>
    <label for="filter">Search Value</label>
    <input type="text" id="filter_input" placeholder="Enter search value">
  </div>
  <div class="card" id='candidates_reports' style='display:none'>
    <div class="card-body">
        <h5 class="card-title"><?= $_GET['head'] ?? 'Reports of candidates' ?></h5>

        <div style="width: 100%; overflow-x: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Reporter Name</th>
                        <th>Report Type</th>
                        <th>Status</th>
                        <th>Client Name</th>
                        <th>Client Type</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Feedback</th>
                        <th>Date generated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $report): 
                    if ($report['UserID'] == $_GET['userid'] && $report['Client_type'] == 'candidate') { ?>
                        <tr data-reporttype="<?= strtolower($report['ReportType']) ?>"
                            data-status="<?= strtolower($report['status']) ?>"
                            data-clientnames="<?= strtolower($report['Client_names']) ?>"
                            data-clienttype="<?= strtolower($report['Client_type']) ?>"
                            data-visitingSite="<?= strtolower($report['visiting_site']) ?>"
                            data-contact="<?= strtolower($report['contact']) ?>"
                            data-address="<?= strtolower($report['address']) ?>"
                            data-feedback="<?= strtolower($report['feedback']) ?>">
                            <td><?= $report['username']; ?></td>
                            <td><?= $report['ReportType']; ?></td>
                            <td><?= $report['status']; ?></td>
                            <td><?= $report['Client_names']; ?></td>
                            <td><?= $report['Client_type']; ?></td>
                            <td><?= $report['contact']; ?></td>
                            <td><?= $report['address']; ?></td>
                            <td><?= $report['description']; ?></td>
                            <td><?= $report['feedback']; ?></td>
                            <td><?php echo $report['DateGenerated']; ?></td>
                            <td>
                                <form method="get" action="reports.php">
                                    <div class="btn-group">
                                        <button type="submit" name="approve" value="<?= $report['ReportID']; ?>" class="btn btn-success">Approve</button>
                                        <button type="submit" name="delete" value="<?= $report['ReportID']; ?>" class="btn btn-danger">Delete</button>
                                        <button type="submit" name="disactivate" value="<?= $report['ReportID']; ?>" class="btn btn-warning">Deactivate</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php } endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="card" id='employers_reports' style='display:none'>
    <div class="card-body">
        <h5 class="card-title"><?= $_GET['head'] ?? 'Reports of employers' ?></h5>

        <div style="width: 100%; overflow-x: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Reporter Name</th>
                        <th>Report Type</th>
                        <th>Status</th>
                        <th>Client Name</th>
                        <th>Client Type</th>
                        <th>Contact</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Feedback</th>
                        <th>Date generated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reports as $report): 
                    if ($report['UserID'] == $_GET['userid'] && $report['Client_type'] == 'employer') { ?>
                        <tr data-reporttype="<?= strtolower($report['ReportType']) ?>"
                            data-status="<?= strtolower($report['status']) ?>"
                            data-clientnames="<?= strtolower($report['Client_names']) ?>"
                            data-clienttype="<?= strtolower($report['Client_type']) ?>"
                            data-visitingSite="<?= strtolower($report['visiting_site']) ?>"
                            data-contact="<?= strtolower($report['contact']) ?>"
                            data-address="<?= strtolower($report['address']) ?>"
                            data-feedback="<?= strtolower($report['feedback']) ?>">
                            <td><?= $report['username']; ?></td>
                            <td><?= $report['ReportType']; ?></td>
                            <td><?= $report['status']; ?></td>
                            <td><?= $report['Client_names']; ?></td>
                            <td><?= $report['Client_type']; ?></td>
                            <td><?= $report['contact']; ?></td>
                            <td><?= $report['address']; ?></td>
                            <td><?= $report['description']; ?></td>
                            <td><?= $report['feedback']; ?></td>
                            <td><?php echo $report['DateGenerated']; ?></td>
                            <td>
                                <form method="get" action="reports.php">
                                    <div class="btn-group">
                                        <button type="submit" name="approve" value="<?= $report['ReportID']; ?>" class="btn btn-success">Approve</button>
                                        <button type="submit" name="delete" value="<?= $report['ReportID']; ?>" class="btn btn-danger">Delete</button>
                                        <button type="submit" name="disactivate" value="<?= $report['ReportID']; ?>" class="btn btn-warning">Deactivate</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    <?php } endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="card" id='expenses_reports' style='display:block'>
    <div class="card-body">
        <h5 class="card-title"><?= $_GET['head'] ?? 'Payments Report' ?></h5>

        <div style="width: 100%; overflow-x: auto;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Deal ID</th>
                        <th>Client ID</th>
                        <th>Agent ID</th>
                        <th>Payment Type</th>
                        <th>Payment Status</th>
                        <th>Amount Due</th>
                        <!-- <th>Amount Paid</th> -->
                        <th>Due Date</th>
                        <th>Date Paid</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($expenses as $payment):
                      if (isset($_GET['userid'])&&$payment['AgentID'] == $_GET['userid'] && $payment['PaymentType'] == 'Agent') { ?> 
                      
                        <tr>
                            <td><?= $payment['PaymentID']; ?></td>
                            <td><?= $payment['DealID']; ?></td>
                            <td><?= $payment['ClientID']; ?></td>
                            <td><?= $payment['AgentID']; ?></td>
                            <td><?= $payment['PaymentType']; ?></td>
                            <td><?= $payment['PaymentStatus']; ?></td>
                            <td><?= number_format($payment['AmountDue'], 2); ?></td>
                            <!-- <td><?= number_format($payment['AmountPaid'], 2); ?></td> -->
                            <td><?= $payment['DueDate']; ?></td>
                            <td><?= $payment['DatePaid'] ?? 'Not Paid Yet'; ?></td>
                            <td>
                            <form method="get" action="reports.php"> <!-- Change to POST method -->
                                <input type="hidden" name="userid" value="<?=$payment['AgentID']?>">
                                <input type="hidden" name="approve" value="<?= $payment['PaymentID']; ?>"> <!-- Payment ID -->
                                <input type="hidden" name="delete" value="<?= $payment['PaymentID']; ?>"> <!-- Payment ID -->
                                <input type="hidden" name="disactivate" value="<?= $payment['PaymentID']; ?>"> <!-- Payment ID -->
                                
                                <div class="btn-group">
                                    <button type="submit" name="approve_payments" class="btn btn-success">Approve</button>
                                    <button type="submit" name="paid_payments" class="btn btn-success">Paid</button>
                                    <button type="submit" name="delete_payments" class="btn btn-danger">Delete</button>
                                    <button type="submit" name="disactivate_payments" class="btn btn-warning">Update</button>
                                </div>
                            </form>



                            </td>
                        </tr>
                    <?php } endforeach; ?>
                </tbody>
            </table>
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
  <script>
  document.getElementById('employees').addEventListener('click', function(){
    document.getElementById('candidates_reports').style.display = 'block';
    document.getElementById('expenses_reports').style.display = 'none';
    document.getElementById('employers_reports').style.display = 'none';
  });

  document.getElementById('employers').addEventListener('click', function(){
    document.getElementById('employers_reports').style.display = 'block';
    document.getElementById('candidates_reports').style.display = 'none';
    document.getElementById('expenses_reports').style.display = 'none';
  });

  document.getElementById('expenses').addEventListener('click', function(){
    document.getElementById('expenses_reports').style.display = 'block';
    document.getElementById('candidates_reports').style.display = 'none';
    document.getElementById('employers_reports').style.display = 'none';
  });
</script>

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