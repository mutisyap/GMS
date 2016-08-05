<?php
error_reporting(0);
    session_start();
if ($_SESSION['role']!='User'){
    die ("<script>alert ('Please login first'); window.location.assign('./');</script>");
}

echo "
<!DOCTYPE html>
<html lang='en'>
<head>
    <title>Garage management system</title>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' href='css/bootstrap.min.css'>
    <script src='js/jquery.js'></script>
    <script src='js/property.js'></script>
    <script src='js/bootstrap.min.js'></script>
</head>
<body>
<nav class='navbar navbar-default'>
    <div class='container-fluid'>
        <div class='navbar-header'>
            <a id='content' class='navbar-brand' href='./'>GARAGE MANAGEMENT SYSTEM</a>
        </div>
        <div>
        </div>
        <div class='collapse navbar-right navbar-collapse' id='myNavbar'>
            <ul class='nav navbar-nav navbar-right'>
            <li><a>{$_SESSION['name']}</a></li>
                <li>
                    <a id='signUp' href='logout.php'><i class='glyphicon glyphicon-log-out'></i> Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class='container-fluid'>
    <h4 class='text-danger' style='text-align: center'><u>INVOICES</u></h4></div>
";
?>

<?php
/**
 * Created by PhpStorm.
 * User: pta
 * Date: 8/4/16
 * Time: 11:34 AM
 */

require_once "connect.php";
$connect=connectDB();
$id=$_SESSION['id'];
echo "<div class='container' id='viewCustDiv' style='display: block'>
<table class='col-sm-8 table table-striped table-bordered table-hover table-responsive'>
        <thead>
        <tr class='text-primary'>
            <th>Invoice ID</th>
            <th>Vehicle Number Plate</th>
            <th>Charges</th>
            <th>Due Date</th>
            <th>PAID?</th>
        </tr>
        </thead>";
/*SELECT Orders.OrderID, Customers.CustomerName, Orders.OrderDate
FROM Orders
INNER JOIN Customers
ON Orders.CustomerID=Customers.CustomerID;*/
$sql="SELECT Vehicles.numberPlate, Invoice.amount, Invoice.deadline, Invoice.paid, Invoice.invoiceID FROM Vehicles INNER JOIN Invoice ON Vehicles.vehicleID=Invoice.vehicleID WHERE Vehicles.custID='$id'"; //change to only view theirs
$result=$connect->query($sql);
if ($result->num_rows>0){
    while ($row = $result->fetch_assoc()){ ?>
        <tr>

            <td><?php echo $row['invoiceID']; ?></td>
            <td><?php echo $row['numberPlate']; ?></td>
            <td><?php echo $row['amount']; ?></td>
            <td><?php echo $row['deadline']; ?></td>
            <td><?php echo $row['paid']; ?></td>
        </tr>
    <?php } }else{ ?>
    <tr><td colspan='5'>No records found.</td></tr>
<?php } ?>
</table>
</form>
</div>
</body>
</html>