<?php
include 'includes/auth.php';
include 'includes/db.php';
$id =$_SESSION['user_id'];
$user=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM users WHERE id='$id'")
);
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Smart Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}
body{
    min-height:100vh;


    background:
    linear-gradient(135deg,#020617,#0f172a,#312e81,#4c1d95);
    font-family:Segoe UI,sans-serif;
    overflow-x:hidden;
    color:white;
}
.dark-mode{
    background:
    linear-gradient(135deg,#ffffff,#dbeafe,#cbd5e1,#e2e8f0);
    color:black;
}



::-webkit-scrollbar{
    width:8px;
}
::-webkit-scrollbar-thumb{
    background:#38bdf8;
    border-radius:20px;
}
.bg-glow1{
    position:fixed;
    width:350px;
    height:350px;
    background:#3b82f6;
    border-radius:50%;
    filter:blur(120px);
    top:-100px;
    left:-100px;
    opacity:0.25;
    z-index:-1;
}
.bg-glow2{
    position:fixed;
    width:350px;
    height:350px;
    background:#8b5cf6;
    border-radius:50%;
    filter:blur(120px);
    bottom:-100px;
    right:-100px;
    opacity:0.25;
    z-index:-1;
}
.navbar{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(16px);
    border-bottom:1px solid rgba(255,255,255,0.1);
    padding:15px 0;
    position:sticky;
    top:0;
    z-index:1000;
}
.navbar-brand{
    font-size:30px;
    font-weight:bold;
    color:white!important;
    letter-spacing:1px;
}
.nav-link{
    color:white!important;
    margin-left:15px;
    transition:0.4s;
    border-radius:12px;
    padding:10px 18px!important;
}
.nav-link:hover{
    background:rgba(255,255,255,0.12);
    color:#38bdf8!important;
    transform:translateY(-2px);
}
.dashboard-box{
    margin-top:50px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(20px);

    border-radius:35px;
    padding:50px;
    box-shadow:0 10px 40px rgba(0,0,0,0.35);
    border:1px solid rgba(255,255,255,0.08);
    position:relative;

    overflow:hidden;
}
.dashboard-box::before{
    content:"";
    position:absolute;
    width:250px;
    height:250px;
    background:rgba(255,255,255,0.05);
    border-radius:50%;
    top:-120px;
    right:-120px;
}
.user-img{
    width:200px;
    height:200px;
    border-radius:50%;
    object-fit:cover;
    border:.5px solid rgba(255,255,255,0.18);
    transition:0.5s;
    box-shadow:0 10px 30px rgba(0,0,0,0.4);
}
.user-img:hover{
    transform:scale(1.08) rotate(3deg);
    box-shadow:0 15px 40px rgba(56,189,248,0.5);
}
.user-name{
    font-size:55px;
    font-weight:bold;
    line-height:1.2;
}
.emnew{
    margin-top:10px;
}
.user-desc{
    margin-top:20px;
    font-size:18px;
    line-height:32px;
    color:grey;
}
.btn-modern{

    background:
    linear-gradient(to right,#06b6d4,#3b82f6);
    border:none;
    padding:14px 32px;
    border-radius:16px;
    color:white;
    font-weight:bold;
    transition:0.4s;
    margin-top:25px;
    text-decoration:none;
    display:inline-block;
}
.btn-modern:hover{
    transform:translateY(-4px) scale(1.03);
    box-shadow:0 12px 25px rgba(59,130,246,0.5);
    color:white;
}
.stats-box{
    margin-top:35px;
}
.stat-card{
    background:rgba(255,255,255,0.07);
    border-radius:20px;
    padding:25px;
    text-align:center;
    border:1px solid rgba(255,255,255,0.06);
    transition:0.4s;
}
.stat-card:hover{
    transform:translateY(-6px);
    background:rgba(255,255,255,0.12);
}

.stat-card i{
    font-size:35px;
    margin-bottom:10px;
    color:#38bdf8;
}
.stat-card h3{
    font-size:32px;
    font-weight:bold;
}
.feature-card{
    background:rgba(255,255,255,0.07);
    border-radius:28px;
    padding:40px;
    height:100%;
    transition:0.5s;
    text-decoration:none;
    color:white;
    display:block;
    position:relative;
    overflow:hidden;
    border:1px solid rgba(255,255,255,0.06);
}
.feature-card::before{
    content:"";
    position:absolute;
    width:220px;
    height:220px;
    background:rgba(255,255,255,0.04);
    border-radius:50%;
    top:-90px;
    right:-90px;
}
.feature-card:hover{
    transform:
    translateY(-10px)
    scale(1.03);
    background:rgba(255,255,255,0.13);

    box-shadow:0 15px 35px rgba(0,0,0,0.35);
}
.feature-card i{
    font-size:60px;
    margin-bottom:20px;
    color:#38bdf8;
    transition:0.4s;
}
.feature-card:hover i{
    transform:scale(1.15) rotate(5deg);
}
.feature-card h3{
    font-size:30px;
    font-weight:bold;
    margin-bottom:15px;
}
.feature-card p{
    color:#cbd5e1;
    line-height:30px;
    font-size:17px;
}
.quick-title{
    font-size:38px;
    font-weight:bold;
    margin-bottom:30px;
}
.footer{
    margin-top:80px;
    text-align:center;
    color:#cbd5e1;
    padding-top:35px;
    padding-bottom:25px;
    position:relative;
    overflow:hidden;
}
.footer::before{
    content:"";
    position:absolute;
    top:0;
    left:50%;
    transform:translateX(-50%);
    width:320px;
    height:2px;
    border-radius:20px;
    background:
    linear-gradient(
    to right,
    transparent,
    #38bdf8,
    #8b5cf6,
    #38bdf8,
    transparent
    );
    box-shadow:
    0 0 12px #38bdf8,
    0 0 25px #8b5cf6;
    animation:footerGlow 3s linear infinite;
}
.footer p{
    transition:0.4s;
    letter-spacing:1px;
}
.footer:hover p{
    color:white;
    letter-spacing:2px;
    text-shadow:
    0 0 10px rgba(56,189,248,0.7);
}
@keyframes footerGlow{
    0%{
        opacity:0.5;
        width:220px;
    }
    50%{
        opacity:1;
        width:340px;
    }
    100%{
        opacity:0.5;
        width:220px;
    }
}
@media(max-width:992px){
    .user-name{
        font-size:42px;
        margin-top:20px;
    }
    .dashboard-box{
        padding:30px;
    }
}
@media(max-width:768px){
    .user-img{
        width:150px;
        height:150px;
    }
    .user-name{
        font-size:34px;
    }
    .feature-card{
        padding:30px;
    }
}




</style>

</head>

<body>

<div class="bg-glow1"></div>
<div class="bg-glow2"></div>
<nav class="navbar navbar-expand-lg navbar-dark">
<div class="container">
<a class="navbar-brand" href="#"><i class="fa-solid fa-user-shield"></i>UserSystem</a>
<button class="navbar-toggler"type="button"
data-bs-toggle="collapse"
data-bs-target="#navMenu">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navMenu">
<ul class="navbar-nav ms-auto">
<li class="nav-item">
<a class="nav-link active"href="dashboard.php"><i class="fa-solid fa-house"></i>Dashboard</a>
</li>
<li class="nav-item">
<a class="nav-link"href="profile.php"><i class="fa-solid fa-user"></i>Profile</a>
</li>
<li class="nav-item">
<a class="nav-link"href="payment.php"><i class="fa-solid fa-credit-card"></i>Payment</a>
</li>
<li class="nav-item"><a class="nav-link"href="activity_log.php"><i class="fa-solid fa-clock-rotate-left"></i>Activity</a>
</li>
<li class="nav-item"><a class="nav-link"href="logout.php"onclick="return confirm('Are you sure you want to logout?')"><i class="fa-solid fa-right-from-bracket"></i>Logout</a>
</li>
<li class="nav-item">
<button
onclick="darkMode()"
class="nav-link border-0 bg-transparent">
<i class="fa-solid fa-moon"></i>Theme
</button>
</li>
</ul>
</div>
</div>
</nav>
<div class="container">
<div class="dashboard-box">
<div class="row align-items-center">
<div class="col-lg-4 text-center">
<img src="uploads/profile_images/<?php echo $user['profile_image'];?>"class="user-img">
</div>
<div class="col-lg-8">
<h1 class="user-name">Welcome,
<?php echo $user['full_name'];
?>
</h1>
<p class="user-desc">

Manage your profile,payments,security,activity history
and account settings from your futuristic smart dashboard with secure modern system access.
</p>
<p class="emnew">✨✨✨</p>

<a class="btn-modern"><i class="fa-solid fa navbar-brand"></i>Stay Connected..</a>
</div>
</div>
<div class="row stats-box g-4">
<div class="col-md-4">
<div class="stat-card">
<i class="fa-solid fa-user-check"></i><h3>100%</h3><p>Account Verified</p>
</div>
</div>
<div class="col-md-4">
<div class="stat-card">
<i class="fa-solid fa-shield-halved"></i><h3>Secure</h3><p>Protected Access</p>
</div>
</div>
<div class="col-md-4">
<div class="stat-card">
<i class="fa-solid fa-bolt"></i><h3>Fast</h3><p>Modern Performance</p>
</div>
</div>
</div>
<hr class="text-light my-5">
<h2 class="quick-title">
<i class="fa-solid fa-layer-group"></i>Quick Access</h2>

<div class="row g-4">
    
<div class="col-md-4">
<a href="profile.php"
class="feature-card">
<i class="fa-solid fa-user"></i><h3>Profile</h3>
<p>Update profile information,upload image,manage your account settings and personalize your experience.
</p>
</a>
</div>
<div class="col-md-4">
<a href="payment.php"
class="feature-card">
<i class="fa-solid fa-credit-card"></i>
<h3>Payments</h3>
<p>Perform secure payment simulations with smart futuristic payment gateway experience.
</p>
</a>
</div>
<div class="col-md-4">
<a href="activity_log.php"
class="feature-card">
<i class="fa-solid fa-clock-rotate-left"></i>
<h3>Activity Logs</h3>
<p>Track login activity,profile updates,payment history and account actions instantly.
</p>
</a>
</div>
<div class="col-md-4">
<a href="update_profile.php"
class="feature-card">
<i class="fa-solid fa-pen"></i>
<h3>Update Profile</h3>
<p>Edit your profile,change image,update personal information
</p>
</a>
</div>
<div class="col-md-4">
<a href="forgot_password.php"
class="feature-card">
<i class="fa-solid fa-key"></i>
<h3>Password Reset</h3>
<p>Reset your password securely using modern authentication and smart recovery system.
</p>
</a>
</div>
<div class="col-md-4">
<a href="delete_profile.php"
class="feature-card"
onclick="return confirm('Are you sure you want to delete your account?')">
<i class="fa-solid fa-trash"></i>
<h3>Delete Account</h3>
<p>Remove account permanently with secure confirmation protectionand modern routing system.
</p>
</a>
</div>
</div>
</div>
</div>


<div class="footer">
<p>© Web Technology
</p>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function darkMode(){
document.body.classList.toggle('dark-mode');
}
</script>

</body>
</html>