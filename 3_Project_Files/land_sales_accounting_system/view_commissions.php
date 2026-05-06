<?php
include 'db_connect.php';

if(isset($_GET['paid'])){

    $commission_id = $_GET['paid'];

    $update = "UPDATE commissions
               SET Commission_Status = 'Paid'
               WHERE Commission_ID = '$commission_id'";

    mysqli_query($conn, $update);
}

$query = "SELECT * FROM commissions";

$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Commissions</title>

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
            font-family:Arial;
            background:#f4f4f4;
            margin:0;
            padding:0;
        }

        .header{
            position:fixed;
            top:60px;
            left:0;
            width:100%;
            background:#2c3e50;
            color:white;
            padding:20px;
            text-align:center;
        }

        .container{
            width:90%;
            margin:auto;
            margin-top:220px;
        }

        table{
            width:100%;
            border-collapse:collapse;
            background:white;
        }

        th{
            background:#34495e;
            color:white;
            padding:12px;
        }

        td{
            padding:10px;
            border-bottom:1px solid #ddd;
            text-align:center;
        }

        .btn{
            background:#3498db;
            color:white;
            padding:8px 12px;
            text-decoration:none;
        }

    </style>

</head>

<body>

<?php include 'navbar.php'; ?>

<button class="back-btn" onclick="history.back()">
    ← Back
</button>
<div class="header">

    <h1>View Commissions</h1>

</div>

<div class="container">

    <table>

        <tr>
            <th>Commission ID</th>
            <th>Sale ID</th>
            <th>Staff ID</th>
            <th>Commission Amount</th>
            <th>Commission Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php

        while($row = mysqli_fetch_assoc($result)){

            $status = $row['Commission_Status'];

            if($status == 'Paid'){
                $statusBadge = "<div style='
                    background:green;
                    color:white;
                    width:100px;
                    padding:8px;
                    margin:auto;
                '>Paid</div>";
            }
            else{
                $statusBadge = "<div style='
                    background:orange;
                    color:white;
                    width:100px;
                    padding:8px;
                    margin:auto;
                '>Pending</div>";
            }

            echo "

            <tr>

                <td>".$row['Commission_ID']."</td>
                <td>".$row['Sale_ID']."</td>
                <td>".$row['Staff_ID']."</td>
                <td>".$row['Commission_Amount']."</td>
                <td>".$row['Commission_Date']."</td>
                <td>$statusBadge</td>

                <td>

            ";

            if($status != 'Paid'){

                echo "

                <a class='btn'
                   href='view_commissions.php?paid=".$row['Commission_ID']."'>
                   Mark as Paid
                </a>

                ";
            }
            else{
                echo "Completed";
            }

            echo "

                </td>

            </tr>

            ";
        }

        ?>

    </table>

</div>

</body>
</html>