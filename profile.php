<?php
include 'includes/auth.php';
include 'includes/db.php';
$id=$_SESSION['user_id'];
$result=mysqli_query($conn,
"SELECT * FROM users WHERE id='$id'");
$row=mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>

body{
    min-height:100vh;
    background:
    linear-gradient(135deg,#0f172a,#1e293b,#312e81);
    font-family:Segoe UI,sans-serif;
    overflow-x:hidden;
}
.navbar{
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(10px);
    border-bottom:1px solid rgba(255,255,255,0.1);
}
.navbar-brand{
    color:white!important;
    font-size:28px;
    font-weight:bold;
}
.nav-link{
    color:white!important;
    margin-left:15px;
    transition:0.3s;
}
.nav-link:hover{
    color:#38bdf8!important;
}
.profile-card{
    max-width:850px;
    margin:auto;
    margin-top:60px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(15px);
    border-radius:25px;
    padding:40px;
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
    border:1px solid rgba(255,255,255,0.1);
    color:white;
}
.profile-img{
    width:170px;
    height:170px;
    object-fit:cover;
    border-radius:50%;
    border:5px solid rgba(255,255,255,0.2);
    transition:0.4s;
}
.profile-img:hover{
    transform:scale(1.05);
}
.info-box{
    background:rgba(255,255,255,0.07);
    padding:18px;
    border-radius:15px;
    margin-top:15px;
    transition:0.3s;
}
.info-box:hover{
    transform:translateY(-3px);
    background:rgba(255,255,255,0.12);
}
.btn-custom{
    border:none;
    border-radius:12px;
    padding:12px 25px;
    font-weight:bold;
    transition:0.4s;
}
.update-btn{
    background:linear-gradient(to right,#06b6d4,#3b82f6);
    color:white;
}
.delete-btn{
    background:linear-gradient(to right,#ef4444,#dc2626);
    color:white;
}
.btn-custom:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 20px rgba(0,0,0,0.3);
}
.badge-box{
    margin-top:25px;
}
.badge-box span{
    display:inline-block;
    background:rgba(255,255,255,0.1);
    padding:10px 18px;
    border-radius:30px;
    margin:5px;
}
</style>

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark">
<div class="container">
<a class="navbar-brand" href="#">
<i class="fa-solid fa-user-shield"></i>User System
</a>
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
<a class="nav-link active" href="profile.php">Profile</a>
</li>
<li class="nav-item">
<a class="nav-link" href="activity_log.php">Activity</a>
</li>
<li class="nav-item">
<a class="nav-link" href="payment.php">Payment</a>
</li>
<li class="nav-item">
<a class="nav-link" href="logout.php">Logout</a>
</li>
</ul>
</div>
</div>
</nav>
<div class="container">
<div class="profile-card">
<div class="row align-items-center">
<div class="col-md-4 text-center">
<img src="uploads/profile_images/<?php echo $row['profile_image']; ?>"class="profile-img">
<h3 class="mt-3">
<?php echo $row['full_name']; ?>
</h3>
<p class="text-light">Verified User
</p>
</div>
<div class="col-md-8">
<h2 class="mb-4">Profile Information</h2>
<div class="info-box">
<h5><i class="fa-solid fa-user"></i>Full Name</h5>
<p>
<?php echo $row['full_name']; ?>
</p>
</div>
<div class="info-box">
<h5><i class="fa-solid fa-envelope"></i>Email Address</h5>
<p>
<?php echo $row['email']; ?>
</p>
</div>
<div class="badge-box">
<span><i class="fa-solid fa-circle-check"></i>Active</span>
<span><i class="fa-solid fa-shield-halved"></i>Secure</span>
<span><i class="fa-solid fa-user-lock"></i>Authenticated</span>
</div>
<div class="mt-4">
<a href="update_profile.php"
class="btn btn-custom update-btn">
<i class="fa-solid fa-pen"></i>Update Profile
</a>
<a href="delete_profile.php"
class="btn btn-custom delete-btn">
<i class="fa-solid fa-trash"></i>Delete Account
</a>
</div>
</div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>