<?php
session_start();
include 'includes/db.php';
if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}
$id=$_SESSION['user_id'];

if(isset($_POST['confirm_logout'])){
    $result = mysqli_query($conn,
    "SELECT * FROM users WHERE id='$id'");
    $row=mysqli_fetch_assoc($result);
    $user_name=$row['full_name'];
    $activity=$user_name." Logged Out";
    mysqli_query($conn,
    "INSERT INTO activity_logs(user_id,activity)
    VALUES('$id','$activity')");


    session_destroy();
    echo "
    <script>
    alert('Logout Successful');
    window.location.href='login.php';
    </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Logout</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:
    linear-gradient(135deg,#020617,#0f172a,#312e81);
    font-family:'Segoe UI',sans-serif;
}
.glass-card{
    width:100%;
    max-width:500px;
    padding:45px;
    border-radius:30px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.08);
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
    text-align:center;
    color:white;
    animation:fadeUp 0.7s ease;
}
.icon-box{
    width:110px;
    height:110px;
    margin:auto;
    border-radius:35px;
    background:
    linear-gradient(to right,#06b6d4,#3b82f6);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:45px;
    margin-bottom:25px;
}
.glass-card h1{
    font-size:35px;
    margin-bottom:15px;
}
.glass-card p{
    color:#cbd5e1;
    margin-bottom:35px;
    line-height:1.7;
}
.btn-modern{
    padding:14px 28px;
    border:none;
    border-radius:14px;
    font-weight:bold;
    transition:0.4s;
    margin:8px;
}
.logout-btn{
    background:
    linear-gradient(to right,#ef4444,#dc2626);
    color:white;
}
.cancel-btn{
    background:
    linear-gradient(to right,#06b6d4,#3b82f6);
    color:white;
}
.btn-modern:hover{
    transform:translateY(-4px);
    box-shadow:0 8px 25px rgba(0,0,0,0.3);
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
<div class="glass-card">
<div class="icon-box">
<i class="fa-solid fa-right-from-bracket"></i>
</div>
<h1>Logout Account</h1>
<p>Are you sure you want to logout from your account?
</p>
<form method="POST">
<button
type="submit"
name="confirm_logout"
class="btn btn-modern logout-btn">Yes, Logout
</button>
<a href="dashboard.php"class="btn btn-modern cancel-btn">Cancel</a>
</form>
</div>

</body>
</html>