<?php
include 'includes/auth.php';
include 'includes/db.php';
$id=$_SESSION['user_id'];
if(isset($_POST['pay'])){
    $card_name=mysqli_real_escape_string($conn,$_POST['card_name']);
    $card_number=mysqli_real_escape_string($conn,$_POST['card_number']);
    $amount=mysqli_real_escape_string($conn,$_POST['amount']);
    if(strlen($card_number)<12){
        echo "
        <script>
        alert('Invalid Card Number');
        </script>
        ";
    }
    else if($amount<=0){
        echo "
        <script>
        alert('Amount must be greater than 0');
        </script>
        ";
    }
    else{
        mysqli_query($conn,"
        INSERT INTO payments(user_id,amount,payment_status)
        VALUES('$id','$amount','Successful')
        ");
        $result=mysqli_query($conn,
        "SELECT * FROM users WHERE id='$id'");
        $row = mysqli_fetch_assoc($result);
        $user_name=$row['full_name'];
        $activity=$user_name." Paid ".$amount." TK";
        mysqli_query($conn,
        "INSERT INTO activity_logs(user_id,activity)
        VALUES('$id','$activity')");
        echo "
        <script>
        alert('Payment Successful');
        window.location.href='payment.php';
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Smart Payment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}
body{
    min-height:100vh;
    background:
    linear-gradient(135deg,#020617,#0f172a,#312e81);
    font-family:'Segoe UI',sans-serif;
    overflow-x:hidden;
}
.navbar{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(15px);
    border-bottom:1px solid rgba(255,255,255,0.08);
    padding:15px 0;
}
.navbar-brand{
    color:white !important;
    font-size:28px;
    font-weight:bold;
}
.nav-link{
    color:white !important;
    margin-left:15px;
    transition:0.3s;
}
.nav-link:hover{
    color:#38bdf8 !important;
    transform:translateY(-2px);
}
.payment-box{
    width:100%;
    max-width:580px;
    margin:auto;
    margin-top:60px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border-radius:30px;
    padding:45px;
    box-shadow:0 8px 32px rgba(0,0,0,0.35);
    border:1px solid rgba(255,255,255,0.08);
    animation:fadeUp 0.8s ease;
}
.payment-icon{
    width:120px;
    height:120px;
    margin:auto;
    border-radius:35px;
    background:
    linear-gradient(to right,#06b6d4,#3b82f6);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:50px;
    color:white;
    margin-bottom:25px;
}
.payment-title{
    color:white;
    text-align:center;
    font-size:40px;
    font-weight:bold;
    margin-bottom:10px;
}
.payment-subtitle{
    text-align:center;
    color:#cbd5e1;
    margin-bottom:35px;
}
.form-label{
    color:white;
    margin-bottom:10px;
}
.form-control{
    height:55px;
    border:none;
    border-radius:15px;
    background:rgba(255,255,255,0.1);
    color:white;
}
.form-control:focus{
    background:rgba(255,255,255,0.15);
    color:white;
    border:1px solid #38bdf8;
    box-shadow:none;
}
.form-control::placeholder{
    color:#cbd5e1;
}
.pay-btn{
    width:100%;
    height:55px;
    border:none;
    border-radius:15px;
    background:
    linear-gradient(to right,#06b6d4,#3b82f6);
    color:white;
    font-size:18px;
    font-weight:bold;
    transition:0.4s;
}
.pay-btn:hover{
    transform:translateY(-4px);
    box-shadow:0 8px 25px rgba(59,130,246,0.5);
}
.badges{
    margin-top:30px;
    text-align:center;
}
.badges span{
    display:inline-block;
    background:rgba(255,255,255,0.1);
    color:white;
    padding:10px 18px;
    border-radius:30px;
    margin:5px;
    transition:0.3s;
}
.badges span:hover{
    transform:scale(1.05);
    background:rgba(255,255,255,0.18);
}
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}
</style>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
<div class="container">
<a class="navbar-brand" href="dashboard.php">
<i class="fa-solid fa-shield-halved"></i>SecurePay</a>
<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navMenu">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navMenu">
<ul class="navbar-nav ms-auto">
<li class="nav-item">
<a class="nav-link" href="dashboard.php">Dashboard</a>
</li>
<li class="nav-item">
<a class="nav-link" href="profile.php">Profile</a>
</li>
<li class="nav-item">
<a class="nav-link" href="activity_log.php">Activity</a>
</li>
<li class="nav-item">
<a class="nav-link" href="logout.php">Logout</a>
</li>
</ul>
</div>
</div>
</nav>
<div class="container">
<div class="payment-box">
<div class="payment-icon">
<i class="fa-solid fa-credit-card"></i>
</div>
<h1 class="payment-title">Smart Payment Gateway</h1>
<p class="payment-subtitle">Modern Secure Academic Payment System
</p>
<form method="POST">
<div class="mb-3">
<label class="form-label">Card Holder Name</label>
<input
type="text"
name="card_name"
class="form-control"
placeholder="Enter Card Holder Name"
required>
</div>
<div class="mb-3">
<label class="form-label">Card Number</label>
<input
type="text"
name="card_number"
class="form-control"
placeholder="1234 5678 9012 3456"
required>
</div>
<div class="mb-4">
<label class="form-label">Amount</label>
<input
type="number"
name="amount"
class="form-control"
placeholder="Enter Amount"
required>
</div>
<button
type="submit"
name="pay"
class="pay-btn">
<i class="fa-solid fa-lock"></i>Secure Payment
</button>
</form>
<div class="badges">
<span><i class="fa-solid fa-shield"></i>Secure</span>
<span><i class="fa-solid fa-bolt"></i>Fast</span>
<span><i class="fa-solid fa-circle-check"></i>Trusted</span>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>