<!DOCTYPE html>
<html>
<head>
    <title>Land Sales Accounting System</title>

    <style>

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
            margin-bottom: 20px;
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

        .admin-btn{
            background-color: #2c3e50;
        }

        .admin-btn:hover{
            background-color: #1a252f;
        }

    </style>

</head>

<body>

<?php include 'navbar.php'; ?>

<div class="header">

    <h1>Land Sales Accounting System</h1>
    <p>Public Viewing Dashboard</p>

</div>

<div class="container">

    <div class="card">

        <h2>View Records</h2>

        <a class="btn" href="view_sales.php">
            View Sales
        </a>

        <a class="btn" href="view_payments.php">
            View Payments
        </a>

    </div>

    <div class="card">

        <h2>Administration</h2>

        <a class="btn admin-btn" href="admin_login.php">
            Admin Mode
        </a>

    </div>

</div>

</body>
</html>