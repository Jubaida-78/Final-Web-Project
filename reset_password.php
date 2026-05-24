<?php
include 'includes/db.php';
if(isset($_GET['token'])){
    $token=$_GET['token'];
    if(isset($_POST['reset'])){
        $new_password =
        password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn,"UPDATE users SET
        password='$new_password'
        WHERE reset_token='$token'");
        $getUser=mysqli_query($conn,"SELECT * FROM users
        WHERE reset_token='$token'");
        $user=mysqli_fetch_assoc($getUser);
        $id=$user['id'];
        $user_name=$user['full_name'];
        $activity=$user_name . " Reset Password";
        mysqli_query($conn,"INSERT INTO activity_logs(user_id,activity)
        VALUES('$id','$activity')");
        echo "
        <script>alert('Password Reset Successful');
        window.location.href='login.php';
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Reset Password</title>
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
    display:flex;
    justify-content:center;
    align-items:center;
    background:
    linear-gradient(135deg,#020617,#0f172a,#312e81);
    font-family:'Segoe UI',sans-serif;
    overflow:hidden;
}
.glow1,
.glow2{
    position:absolute;
    border-radius:50%;
    filter:blur(100px);
    opacity:0.4;
}
.glow1{
    width:300px;
    height:300px;
    background:#06b6d4;
    top:-80px;
    left:-80px;
}
.glow2{
    width:300px;
    height:300px;
    background:#7c3aed;
    bottom:-80px;
    right:-80px;
}
.reset-card{
    width:100%;
    max-width:480px;
    padding:45px;
    border-radius:30px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.08);
    box-shadow:0 8px 32px rgba(0,0,0,0.35);
    position:relative;
    z-index:2;
    animation:fadeUp 0.7s ease;
}
.icon-box{
    width:110px;
    height:110px;
    margin:auto;
    border-radius:30px;
    background:
    linear-gradient(to right,#06b6d4,#3b82f6);
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:45px;
    color:white;
    margin-bottom:25px;
}
.title{
    color:white;
    text-align:center;
    font-size:38px;
    font-weight:bold;
    margin-bottom:10px;
}
.subtitle{
    color:#cbd5e1;
    text-align:center;
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
.reset-btn{
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
.reset-btn:hover{
    transform:translateY(-4px);
    box-shadow:0 8px 25px rgba(59,130,246,0.5);
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

<div class="glow1"></div>
<div class="glow2"></div>
<div class="reset-card">
<div class="icon-box">
<i class="fa-solid fa-key"></i>
</div>
<h1 class="title">Reset Password</h1>
<p class="subtitle">Create your new secure password
</p>
<form method="POST">
<div class="mb-4">
<label class="form-label">New Password</label>
<input
type="password"
name="password"
class="form-control"
placeholder="Enter New Password"
required>
</div>
<button
type="submit"
name="reset"
class="reset-btn">
<i class="fa-solid fa-shield-halved"></i>Reset Password
</button>
</form>

</div>

</body>
</html>