<?php
include 'db_connect.php';

$search = "";

if(isset($_GET['search'])){
    $search = $_GET['search'];
}

$sql = "SELECT * FROM sales 
        WHERE Sale_ID LIKE '%$search%'
        OR Plot_ID LIKE '%$search%'
        OR Client_ID LIKE '%$search%'
        OR Staff_ID LIKE '%$search%'";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Sales</title>

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
            width: 90%;
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
            width: 300px;
            padding: 10px;
        }

        .search-box button{
            padding: 10px 15px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
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
    <p>View Sales Records</p>

</div>

<div class="container">

    <form method="GET" class="search-box">

        <input 
            type="text" 
            name="search" 
            placeholder="Search by Sale ID, Plot ID, Client ID or Staff ID"
            value="<?php echo $search; ?>"
        >

        <button type="submit">
            Search
        </button>

    </form>

    <table>

        <tr>
            <th>Sale ID</th>
            <th>Plot ID</th>
            <th>Client ID</th>
            <th>Staff ID</th>
            <th>Sale Date</th>
            <th>Selling Price</th>
            <th>Payment Status</th>
            <th>Sale Status</th>
        </tr>

        <?php

        while($row = mysqli_fetch_assoc($result)){

            $status = $row['Payment_Status'];

            if($status == 'Fully Paid'){
                $paymentBadge = "<div style='
                    background:green;
                    color:white;
                    width:140px;
                    padding:8px;
                    font-weight:bold;
                    margin:auto;
                '>$status</div>";
            }
            elseif($status == 'Partially Paid'){
                $paymentBadge = "<div style='
                    background:orange;
                    color:white;
                    width:140px;
                    padding:8px;
                    font-weight:bold;
                    margin:auto;
                '>$status</div>";
            }
            else{
                $paymentBadge = "<div style='
                    background:red;
                    color:white;
                    width:140px;
                    padding:8px;
                    font-weight:bold;
                    margin:auto;
                '>$status</div>";
            }

            $saleStatus = $row['Sale_Status'];

            if($saleStatus == 'Active'){
                $saleBadge = "<div style='
                    background:green;
                    color:white;
                    width:120px;
                    padding:8px;
                    font-weight:bold;
                    margin:auto;
                '>$saleStatus</div>";
            }
            else{
                $saleBadge = "<div style='
                    background:red;
                    color:white;
                    width:120px;
                    padding:8px;
                    font-weight:bold;
                    margin:auto;
                '>$saleStatus</div>";
            }

            echo "

            <tr>

                <td>".$row['Sale_ID']."</td>
                <td>".$row['Plot_ID']."</td>
                <td>".$row['Client_ID']."</td>
                <td>".$row['Staff_ID']."</td>
                <td>".$row['Sale_Date']."</td>
                <td>".$row['Selling_Price']."</td>
                <td>$paymentBadge</td>
                <td>$saleBadge</td>

            </tr>

            ";
        }

        ?>

    </table>

</div>

</body>
</html>