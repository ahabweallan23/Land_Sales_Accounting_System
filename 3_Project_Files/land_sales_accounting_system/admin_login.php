<?php

$message = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username == "admin" && $password == "admin"){

        header("Location: admin_dashboard.php");
        exit();

    }
    else{
        $message = "Invalid username or password!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>

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
            width: 40%;
            margin: auto;
            margin-top: 220px;
            background: white;
            padding: 30px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        input{
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        button{
            background: #3498db;
            color: white;
            padding: 12px 20px;
            border: none;
            cursor: pointer;
        }

        button:hover{
            background: #2980b9;
        }

        .error{
            background:red;
            color:white;
            padding:10px;
            margin-bottom:20px;
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
    <p>Admin Login</p>

</div>

<div class="container">

    <?php

    if($message != ""){
        echo "<div class='error'>$message</div>";
    }

    ?>

    <form method="POST">

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">
            Login
        </button>

    </form>

</div>

</body>
</html>