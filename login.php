<?php
session_start();
include 'includes/db.php';
if(isset($_POST['login'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $select=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    if(mysqli_num_rows($select)>0){
        $row=mysqli_fetch_assoc($select);
        if($row['is_verified']==0){
            echo "
            <script>
            alert('Please Verify Your Email');
            </script>
            ";
        }
        else{
            if(password_verify($password,$row['password'])){
                $_SESSION['user_id']=$row['id'];
                $id=$row['id'];
                $user_name=$row['full_name'];
                $activity=$user_name.' Logged In';
                mysqli_query($conn,
                "INSERT INTO activity_logs(user_id,activity)
                VALUES('$id','$activity')");
                echo "
                <script>
                alert('Login Successful');
                window.location.href='dashboard.php';
                </script>
                ";
            }
            else{
                echo "
                <script>
                alert('Wrong Password');
                </script>
                ";
            }
        }

    }

    else{
        echo "
        <script>
        alert('Email Not Found');
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

<title>Modern Login</title>
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
    overflow:hidden;
    font-family:'Segoe UI',sans-serif;
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
.login-card{
    width:100%;
    max-width:460px;
    padding:45px;
    border-radius:30px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.08);
    box-shadow:0 8px 32px rgba(0,0,0,0.35);
    position:relative;
    z-index:2;
    animation:fadeUp 0.8s ease;
}
.icon-box{
    width:110px;
    height:110px;
    margin:auto;
    border-radius:35px;
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
    text-align:center;
    color:#cbd5e1;
    margin-bottom:35px;
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
.form-control::placeholder{
    color:#cbd5e1;
}
.login-btn{
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
.login-btn:hover{
    transform:translateY(-4px);
    box-shadow:0 8px 25px rgba(59,130,246,0.5);
}
.bottom-links{
    margin-top:25px;
    text-align:center;
}
.bottom-links a{
    color:#38bdf8;
    text-decoration:none;
    transition:0.3s;
}
.bottom-links a:hover{
    color:white;
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
<div class="login-card">
<div class="icon-box">
<i class="fa-solid fa-user-shield"></i>
</div>
<h1 class="title">Welcome Back</h1>
<p class="subtitle">Login to your futuristic smart system
</p>
<form method="POST">
<input
type="email"
name="email"
class="form-control"
placeholder="Enter Email"
required>
<input
type="password"
name="password"
class="form-control"
placeholder="Enter Password"
required>
<button
type="submit"
name="login"
class="login-btn">
<i class="fa-solid fa-right-to-bracket"></i>Login
</button>
</form>
<div class="bottom-links">
<a href="forgot_password.php">Forgot Password?</a>


</div>

</div>

</body>
</html>