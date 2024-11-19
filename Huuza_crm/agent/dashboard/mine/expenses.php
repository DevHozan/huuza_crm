<?php 
session_start(); // Start the session
if(!isset($_SESSION['user_id'])){
    header('location:../../../database/logout.php');
}

include('../../../database/classes/UsersManager.php');
include('../../../database/classes/MainClass.php');
include('../../../database/connect.php');
include('../../../database/actions/update_user.php');
include('../../../database/actions/add_payment.php');
// Fetch payments from the database
$table = 'payments';
$payments = $mainmanager->fetchAll($table);

include("../inner_header.php");
?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Payments</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Payments</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <button class="btn btn-primary m-2" style="width:10%" onclick="openAddForm()">Request Payment</button>

            <div class="add-form" id="add_form" style="display: none; position: fixed; top: 20px; left: 50%; transform: translateX(-50%); width: 400px; max-height: 80%; z-index: 999; background-color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); padding: 20px; border-radius: 8px; overflow-y: auto;">
                <div class="form container">
                    <button id="hide_form" onclick="closeAddForm()">Back</button>
                    <h2>Payment Form</h2>
                    <form action="" method="POST">
                        <!-- <label for="DealID">Deal ID:</label>
                        <input type="number" id="DealID" class="form-control" name="DealID" required> -->

                        <!-- <label for="ClientID">Client ID:</label> -->
                        <input type="hidden" id="ClientID"  class="form-control"name="ClientID" value="<?= $_SESSION['user_id']; ?>" required>

                        <!-- <label for="AgentID">Agent ID:</label>
                        <input type="number" id="AgentID" class="form-control" name="AgentID" required> -->
                        <input type="hidden" id="AgentID" class="form-control" name="AgentID" value="<?= $_SESSION['user_id']; ?>" required>

                        <!-- <label for="PaymentType">Payment Type:</label>
                        <select id="PaymentType" class="form-control" name="PaymentType" required>
                            <option value="Client">Client</option>
                            <option value="Agent">Agent</option>
                        </select> -->
                        <input type="hidden" class="form-control" name="PaymentType" value='Agent' required>


                        <!-- <label for="PaymentStatus">Payment Status:</label>
                        <select id="PaymentStatus" class="form-control" name="PaymentStatus" required>
                            <option value="Pending">Pending</option>
                            <option value="Partially Paid">Partially Paid</option>
                            <option value="Paid in Full">Paid in Full</option>
                        </select> -->
                        <input type="hidden" class="form-control" name="PaymentStatus" value="Pending" required>

                        <label for="AmountDue">Amount Due:</label>
                        <input type="number" class="form-control" step="0.01" id="AmountDue" name="AmountDue" required>

                        <!-- <label for="AmountPaid">Amount Paid:</label> -->
                        <input type="hidden" class="form-control" step="0.01" id="AmountPaid" name="AmountPaid" value='00' required>

                        <label for="DueDate">Due Date:</label>
                        <input type="date" class="form-control" id="DueDate" name="DueDate">

                        <label for="DatePaid">Date Paid:</label>
                        <input type="date" class="form-control" id="DatePaid" name="DatePaid">

                        <input type="submit" name="add_payment" value="Add Payment">
                    </form>
                </div>
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

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Payments Table</h5>

                    <div style="width: 100%; overflow-x: auto;">
                        <table class="table datatable" style="min-width: 1000px;">
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <!-- <th>Deal ID</th>
                                    <th>Client ID</th> -->
                                    <!-- <th>Agent ID</th> -->
                                    <th>user type</th>
                                    <th>Payment Status</th>
                                    <th>Amount Due</th>
                                    <th>Amount Paid</th>
                                    <th>Due Date</th>
                                    <th>Date Paid</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($payments as $payment):
                                  if ($payment['AgentID'] == $_SESSION['user_id'] && $payment['PaymentType'] == 'Agent') { ?> 
                                    <tr>
                                        <td><?php echo $payment['PaymentID']; ?></td>
                                        <!-- <td><?php echo $payment['DealID']; ?></td>
                                       <td><?php echo $payment['ClientID']; ?></td> -->
                                        <!-- <td><?php echo $payment['AgentID']; ?></td> -->
                                        <td><?php echo $payment['PaymentType']; ?></td>
                                        <td><?php echo $payment['PaymentStatus']; ?></td>
                                        <td><?php echo $payment['AmountDue']; ?></td>
                                        <td><?php echo $payment['AmountPaid']; ?></td>
                                        <td><?php echo $payment['DueDate']; ?></td>
                                        <td><?php echo $payment['DatePaid']; ?></td>
                                        <td>
                                            <form method="get" action="expenses.php">
                                                <div class="btn-group" role="group">
                                                <!-- <button type="submit" name="edit" value="<?php echo $payment['PaymentID']; ?>" class="btn btn-warning">Edit</button>
                                                    <button type="submit" name="delete" value="<?php echo $payment['PaymentID']; ?>" class="btn btn-danger">Delete</button>
                                                -->
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
        </div>
    </section>
</main>

<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>CRM System</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
        Designed by <a href="">IT Team</a>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../../assets/js/main.js"></script>

</body>
</html>
