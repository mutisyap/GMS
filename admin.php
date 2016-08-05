<?php    session_start();
if ($_SESSION['role']!='Admin'){
    die ("<script>alert ('Please login first'); window.location.assign('./');</script>");
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Garage management system</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/property.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a id="content" class="navbar-brand" href="./">GARAGE MANAGEMENT SYSTEM</a>
        </div>
        <div>
            <ul class="nav navbar-nav">
                <li class="active"><a>&nbsp;</a></li>
                <li><a id="viewCust" href="#">View Customers</a></li>
                <li><a id="registerCar" href="#">Add Vehicle</a></li>
                <!--<li><a id="viewVehicles" href="#">View Vehicles</a></li> -->
                <li><a id="createInvoice" href="#">Create Invoice</a></li>
                <li><a id="clearInvoice" href="#">Clear Invoice</a></li>
            </ul>
        </div>
        <div class="collapse navbar-right navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a><?echo $_SESSION['name']?></a></li>
                <li>
                <li><a id="signUp" href="logout.php"><i class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
            </ul>
        </div>
    </div>
</nav>


<?php
/**
 * Created by PhpStorm.
 * User: pta
 * Date: 8/4/16
 * Time: 11:34 AM
 */

//Role 1: View Customer details
require_once "connect.php";
$connect=connectDB();
echo "<div class='container' id='viewCustDiv' style='display: block'>
<form class='col-sm-4' name='admin_form' action='?' method='POST'>
<table class='table table-striped table-bordered table-hover table-responsive'>
    <h4 class='text-danger' style='text-align: center'><u>CUSTOMER ACCOUNTS</u></h4>
        <thead>
        <tr class='text-primary'>
            <th>Id Number</th>
            <th>Name</th>
        </tr>
        </thead>";
$sql="SELECT idNumber,name FROM Users WHERE role='User'";
$result=$connect->query($sql);
if ($result->num_rows>0){
while ($row = $result->fetch_assoc()){ ?>
    <tr>

        <td><?php echo $row['idNumber']; ?></td>
        <td><?php echo $row['name']; ?></td>
    </tr>
<?php } }else{ ?>
    <tr><td colspan='5'>No records found.</td></tr>
<?php } ?>
</table>
</form>
</div>

<div style="display: none"  id="registerCarDiv" class="container-fluid">
    <form name="addVehicle" class="form-horizontal" role="form" method="post" action="">
        <div class="form-group">
            <label class="control-label col-sm-2" for="description">Vehicle Description:</label>
            <div class="col-sm-4">
                <input id="description" required name="description" class="form-control" placeholder="Green Toyota Prado">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="noPlate">Number Plate:</label>
            <div class="col-sm-2">
                <input id="noPlate" required name="noPlate" class="form-control" placeholder="KCC 881 C">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="problem">Problem reported:</label>
            <div class="col-sm-4">
                <textarea required id="problem" name="problem" class="form-control" placeholder="Broken Wind screen"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label  class="col-sm-2 control-label" for="custID">Customer ID Number:</label>
            <div class="col-sm-2">
                <input type="number" onkeyup="getCustomer()" required id="custID" name="custID" class="form-control">
            </div>
            <label class="col-sm-2 control-label" id="custIDLabel"></label>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
                <button id="registerCarBtn" disabled type="submit" class="btn btn-primary">Add Vehicle</button>
            </div>
        </div>
    </form>
</div>

<div style="display: none"  id="invoiceDiv" class="container-fluid">
    <form name="invoiceForm" class="form-horizontal" role="form" method="post" action="">
        <div class="form-group">
            <label class="control-label col-sm-2" for="vehicleID">Vehicle ID:</label>
            <div class="col-sm-2">
                <input id="vehicleID" onkeyup="getVehicleID()" required name="vehicleID" class="form-control" placeholder="V004">
            </div>
            <label class="col-sm-2 control-label" id="numberPlate1"></label>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="amount">Amount Payable (Ksh):</label>
            <div class="col-sm-2">
                <input id="amount" required name="amount" class="form-control" placeholder="500" type="number">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="deadline">Payment Deadline:</label>
            <div class="col-sm-2">
                <input required id="deadline" name="deadline" class="form-control" placeholder="23-07-2016" type="date">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
                <button id="invoiceBtn" type="submit" class="btn btn-primary">Commit Invoice</button>
            </div>
        </div>
    </form>
</div>

<div class="container-fluid" style="display: none" id="clearInvoiceDiv">
    <form name="clearInvoiceForm" class="form-horizontal" role="form" method="post" action="">
        <div class="form-group">
            <label class="col-sm-2 control-label" for="invoiceID">Invoice ID:</label>
            <div class="col-sm-2">
                <input onkeyup="getVehicle()" class="form-control" id="invoiceID" name="invoiceID" required>
            </div>
            <label class="control-label col-sm-2" id="vehicleIDLabel">
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-2">
                <button disabled id="clearInvoiceBtn" type="submit" class="btn btn-primary">Clear Invoice</button>
            </div>
        </div>
    </form>
</div>


</body>
</html>

<?php
    if (isset($_POST['custID'])){
        $description=$_POST['description'];
        $noPlate=$_POST['noPlate'];
        $problem=$_POST['problem'];
        $custID=$_POST['custID'];
        $vehicleID=rand(100, 999);
        $vehicleID='V'.$vehicleID;

        $sql="INSERT INTO Vehicles (vehicleID, numberPlate, problem, description, custID)
        VALUES ('$vehicleID', '$noPlate', '$problem', '$description', '$custID')";
        $conn=connectDB();
        if ($conn->query($sql)==TRUE){
            echo "<script>alert ('Successfully added vehicle. Vehicle ID= {$vehicleID}');</script>";
        }else{
            echo "<script>alert ('Error adding vehicle. Please try again');</script>";
        }
    }
    if (isset($_POST['vehicleID'])){
        $vehicleID=$_POST['vehicleID'];
        $amount=$_POST['amount'];
        $deadline=$_POST['deadline'];

        $invoiceID=rand(1000, 9999);
        $invoiceID='N'.$invoiceID;

        $sql="INSERT INTO Invoice (invoiceID, vehicleID, amount, deadline)
        VALUES ('$invoiceID', '$vehicleID', '$amount', '$deadline')";
        $conn=connectDB();
        if ($conn->query($sql)==TRUE){
            echo "<script>alert ('Successfully added Invoice. Invoice ID= {$invoiceID}');</script>";
        }else{
            echo "<script>alert ('Error adding Invoice. Please try again');</script>";
        }
    }

    if (isset($_POST['invoiceID'])){
        $invoiceID=$_POST['invoiceID'];
        $paid='TRUE';
        $sql="UPDATE Invoice SET paid='$paid' WHERE invoiceID='$invoiceID'";
        $conn=connectDB();

        if ($conn->query($sql)==TRUE){
            echo "<script>alert ('Successfully Cleared Invoice.');</script>";
        }else{
            echo "<script>alert ('Error Clearing Invoice.');</script>";
        }
    }
?>