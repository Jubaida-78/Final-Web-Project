<?php
include 'includes/db.php';
if(isset($_POST['submit'])){
    $email=$_POST['email'];
    $token=md5(rand());
    mysqli_query($conn,"UPDATE users SET
    reset_token='$token'
    WHERE email='$email'");
    echo "
    <script>alert('Password Reset Link Generated');
    </script>
    ";echo "
    <div style='text-align:center;margin-top:20px;'>
    <a href='reset_password.php?token=$token'
    style='
    background:#3b82f6;
    padding:14px 25px;
    border-radius:12px;
    color:white;
    text-decoration:none;
    font-weight:bold;
    '>
    Open Reset Password Page
    </a>
    </div>
    ";


}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Forgot Password</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"rel="stylesheet">
<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
.forgot-card{
    width:100%;
    max-width:500px;
    padding:45px;
    border-radius:30px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.08);
    box-shadow:0 8px 32px rgba(0,0,0,0.35);
    color:white;

}
.icon{
    text-align:center;
    font-size:70px;
    color:#38bdf8;
    margin-bottom:20px;
}
.title{
    text-align:center;
    font-size:38px;
    font-weight:bold;
    margin-bottom:10px;
}
.subtitle{
    text-align:center;
    color:#cbd5e1;
    margin-bottom:30px;
}
.form-control{
    height:55px;
    border:none;
    border-radius:15px;
    background:rgba(255,255,255,0.1);
    color:white;
    margin-bottom:20px;
}
.form-control:focus{
    background:rgba(255,255,255,0.15);
    color:white;
    border:1px solid #38bdf8;
    box-shadow:none;
}
.send-btn{
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
.send-btn:hover{
    transform:translateY(-4px);
    box-shadow:0 8px 25px rgba(59,130,246,0.5);


}


</style>

</head>

<body>

<div class="forgot-card">
<div class="icon">
<i class="fa-solid fa-lock"></i>
</div>
<h1 class="title">Forgot Password</h1>
<p class="subtitle">Generate your secure password reset link
</p>
<form method="POST">
<input
type="email"
name="email"
class="form-control"
placeholder="Enter Your Email..."
required>
<button
type="submit"
name="submit"
class="send-btn">
<i class="fa-solid fa-paper-plane"></i>Send Reset Link
</button>
</form>
</div>
</body>
</html>