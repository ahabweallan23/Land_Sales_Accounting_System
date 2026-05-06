<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

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
            width: 80%;
            margin: auto;
            margin-top: 220px;
        }

        .card{
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .btn{
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            margin: 10px;
            border-radius: 5px;
        }

        .btn:hover{
            background-color: #2980b9;
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
    <p>Administrator Dashboard</p>

</div>

<div class="container">

    <div class="card">

        <h2>System Modules</h2>

        <a class="btn" href="add_sale.php">
            Add Sale
        </a>

        <a class="btn" href="add_payment.php">
            Record Payment
        </a>

        <a class="btn" href="view_sales.php">
            View Sales
        </a>

        <a class="btn" href="view_payments.php">
            View Payments
        </a>

        <a class="btn" href="commission_settings.php">
            Commission Settings
        </a>

        <a class="btn" href="view_commissions.php">
            View Commissions
        </a>

    </div>

</div>

</body>
</html>