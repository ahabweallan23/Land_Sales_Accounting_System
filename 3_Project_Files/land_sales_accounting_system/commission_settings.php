<?php
include 'db_connect.php';

$message = "";

if(isset($_POST['update'])){

    $percentage = $_POST['percentage'];

    $sql = "UPDATE settings
            SET Commission_Percentage = '$percentage'
            WHERE Setting_ID = 1";

    mysqli_query($conn, $sql);

    $message = "Commission percentage updated successfully!";
}

$query = "SELECT * FROM settings LIMIT 1";

$result = mysqli_query($conn, $query);

$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Commission Settings</title>

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
            background:#f4f4f4;
            margin:0;
            padding:0;
        }

        .header{
            position: fixed;
            top: 60px;
            left: 0;
            width: 100%;
            background:#2c3e50;
            color:white;
            padding:20px;
            text-align:center;
        }

        .container{
            width:40%;
            margin:auto;
            margin-top:220px;
            background:white;
            padding:30px;
        }

        input{
            width:100%;
            padding:10px;
            margin-top:5px;
            margin-bottom:20px;
        }

        button{
            background:#3498db;
            color:white;
            padding:12px 20px;
            border:none;
            cursor:pointer;
        }

    </style>

</head>

<body>

<?php include 'navbar.php'; ?>

<button class="back-btn" onclick="history.back()">
    ← Back
</button>
<div class="header">

    <h1>Commission Settings</h1>

</div>

<div class="container">

    <?php
    if($message != ""){
        echo "<p>$message</p>";
    }
    ?>

    <form method="POST">

        <label>Commission Percentage (%)</label>

        <input 
            type="number" 
            step="0.01"
            name="percentage"
            value="<?php echo $row['Commission_Percentage']; ?>"
            required
        >

        <button type="submit" name="update">
            Update Percentage
        </button>

    </form>

</div>

</body>
</html>