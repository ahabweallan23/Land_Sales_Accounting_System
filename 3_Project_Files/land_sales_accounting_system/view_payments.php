<?php
include 'db_connect.php';

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
}

$sql = "SELECT payments.*, sales.Selling_Price
        FROM payments
        JOIN sales ON payments.Sale_ID = sales.Sale_ID
        
        WHERE payments.Payment_ID LIKE '%$search%'
        OR payments.Sale_ID LIKE '%$search%'
        OR payments.Payment_Method LIKE '%$search%'
        OR payments.Payment_Type LIKE '%$search%'";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Payments</title>

    <style>

        .back-btn{
            position: fixed;
            top: 80px;
            left: 20px;
            background: #34495e;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            z-index: 1000;
            border-radius: 5px;
        }

        .back-btn:hover{
            background: #2c3e50;
        }
        
        body{
            font-family: Arial;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header{
            position: fixed;
            top: 60px;
            left: 0;
            width: 100%;
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
            z-index: 999;
        }

        .container{
            width: 95%;
            margin: auto;
            margin-top: 220px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        th{
            background-color: #34495e;
            color: white;
            padding: 12px;
        }

        td{
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        tr:hover{
            background-color: #f1f1f1;
        }

        .search-box{
            margin-bottom: 20px;
        }

        .search-box input{
            width: 350px;
            padding: 10px;
        }

        .search-box button{
            padding: 10px 15px;
            background: #3498db;
            color: white;
            border: none;
            cursor: pointer;
        }

        .search-box button:hover{
            background: #2980b9;
        }

    </style>

</head>

<body>

<?php include 'navbar.php'; ?>

<button class="back-btn" onclick="history.back()">
    ← Back
</button>
<div class="header">

    <h1>Land Sales Accounting System</h1>
    <p>View Payment Records</p>

</div>

<div class="container">

    <form method="GET" class="search-box">

        <input 
            type="text" 
            name="search" 
            placeholder="Search by Payment ID, Sale ID, Method or Type"
            value="<?php echo $search; ?>"
        >

        <button type="submit">
            Search
        </button>

    </form>

    <table>

        <tr>
            <th>Payment ID</th>
            <th>Sale ID</th>
            <th>Selling Price</th>
            <th>Payment Amount</th>
            <th>Payment Method</th>
            <th>Payment Type</th>
            <th>Payment Date</th>
            <th>Receipt Number</th>
        </tr>

        <?php

        while($row = mysqli_fetch_assoc($result)){

            $paymentType = $row['Payment_Type'];

            if($paymentType == 'Full'){
                $paymentBadge = "<div style='
                    background:green;
                    color:white;
                    width:120px;
                    padding:8px;
                    font-weight:bold;
                    margin:auto;
                '>$paymentType</div>";
            }
            else{
                $paymentBadge = "<div style='
                    background:orange;
                    color:white;
                    width:120px;
                    padding:8px;
                    font-weight:bold;
                    margin:auto;
                '>$paymentType</div>";
            }

            echo "

            <tr>

                <td>".$row['Payment_ID']."</td>
                <td>".$row['Sale_ID']."</td>
                <td>".$row['Selling_Price']."</td>
                <td>".$row['Payment_Amount']."</td>
                <td>".$row['Payment_Method']."</td>
                <td>$paymentBadge</td>
                <td>".$row['Payment_Date']."</td>
                <td>".$row['Receipt_Number']."</td>

            </tr>

            ";
        }

        ?>

    </table>

</div>

</body>
</html>