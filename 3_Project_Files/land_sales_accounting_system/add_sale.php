<?php
include 'db_connect.php';

$message = "";

if (isset($_POST['submit'])) {

    $plot_id = $_POST['plot_id'];
    $client_id = $_POST['client_id'];
    $staff_id = $_POST['staff_id'];
    $sale_date = $_POST['sale_date'];
    $selling_price = $_POST['selling_price'];
    $payment_status = $_POST['payment_status'];
    $sale_status = $_POST['sale_status'];

    $sql = "INSERT INTO sales 
    (Plot_ID, Client_ID, Staff_ID, Sale_Date, Selling_Price, Payment_Status, Sale_Status)

    VALUES

    ('$plot_id', '$client_id', '$staff_id', '$sale_date', '$selling_price', '$payment_status', '$sale_status')";

    if (mysqli_query($conn, $sql)) {

        $sale_id = mysqli_insert_id($conn);

        $settings_query = "SELECT Commission_Percentage FROM settings LIMIT 1";

        $settings_result = mysqli_query($conn, $settings_query);

        $settings = mysqli_fetch_assoc($settings_result);

        $commission_percentage = $settings['Commission_Percentage'];

        $commission_amount = ($selling_price * $commission_percentage) / 100;

        if(isset($_POST['calculate_commission'])){

            $commission_sql = "INSERT INTO commissions
            (Sale_ID, Staff_ID, Commission_Amount, Commission_Date, Commission_Status)

            VALUES

            ('$sale_id', '$staff_id', '$commission_amount', '$sale_date', 'Pending')";

            mysqli_query($conn, $commission_sql);
        }

        $message = "Sale added successfully!";

    } else {
        $message = "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Sale</title>

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

        .checkbox-container{
            margin-bottom: 20px;
        }

        .checkbox-container input{
            width: auto;
            margin-right: 10px;
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
    <p>Add Sale</p>

</div>

<div class="container">

    <?php
    if($message != ""){
        echo "<div class='message'>$message</div>";
    }
    ?>

    <form method="POST">

        <label>Plot ID</label>
        <input type="number" name="plot_id" required>

        <label>Client ID</label>
        <input type="number" name="client_id" required>

        <label>Staff ID</label>
        <input type="number" name="staff_id" required>

        <label>Sale Date</label>
        <input type="date" name="sale_date" required>

        <label>Total Amount To Be Paid / Selling Price</label>
        <input type="number" name="selling_price" required>

        <div class="checkbox-container">

            <label>

                <input 
                    type="checkbox" 
                    name="calculate_commission"
                    value="yes"
                >

                Calculate Commission

            </label>

        </div>

        <label>Payment Status</label>

        <select name="payment_status">

            <option>Pending</option>
            <option>Partially Paid</option>
            <option>Fully Paid</option>

        </select>

        <label>Sale Status</label>

        <select name="sale_status">

            <option>Active</option>
            <option>Cancelled</option>

        </select>

        <button type="submit" name="submit">
            Add Sale
        </button>

    </form>

</div>

</body>
</html>