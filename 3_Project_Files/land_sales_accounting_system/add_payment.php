<?php
include 'db_connect.php';

$message = "";

if (isset($_POST['submit'])) {

    $sale_id = $_POST['sale_id'];
    $payment_date = $_POST['payment_date'];
    $payment_amount = $_POST['payment_amount'];
    $payment_method = $_POST['payment_method'];
    $receipt_number = $_POST['receipt_number'];
    $transaction_id = $_POST['transaction_id'];
    $payment_type = $_POST['payment_type'];

    $sql = "INSERT INTO payments
    (Sale_ID, Payment_Date, Payment_Amount, Payment_Method, Receipt_Number, Transaction_ID, Payment_Type)

    VALUES

    ('$sale_id', '$payment_date', '$payment_amount', '$payment_method', '$receipt_number', '$transaction_id', '$payment_type')";

    if (mysqli_query($conn, $sql)) {
        $message = "Payment recorded successfully!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Record Payment</title>

    <style>

        body{
            font-family: Arial;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

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
            width: 50%;
            margin: auto;
            background: white;
            padding: 30px;
            margin-top: 220px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        input, select{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        button{
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover{
            background-color: #2980b9;
        }

        .message{
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
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
    <p>Record Payment</p>

</div>

<div class="container">

    <?php
    if($message != ""){
        echo "<div class='message'>$message</div>";
    }
    ?>

    <form method="POST">

        <label>Sale ID</label>
        <input type="number" name="sale_id" required>

        <label>Payment Date</label>
        <input type="date" name="payment_date" required>

        <label>Payment Amount</label>
        <input type="number" name="payment_amount" required>

        <label>Payment Method</label>

        <select name="payment_method">

            <option>Cash</option>
            <option>Bank Transfer</option>
            <option>Mobile Money</option>

        </select>

        <label>Receipt Number</label>
        <input type="text" name="receipt_number" required>

        <label>Transaction ID</label>
        <input type="text" name="transaction_id">

        <label>Payment Type</label>

        <select name="payment_type">

            <option>Full</option>
            <option>Installment</option>

        </select>

        <button type="submit" name="submit">
            Record Payment
        </button>

    </form>

</div>

</body>
</html>