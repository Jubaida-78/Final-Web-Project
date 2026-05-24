<?php
include 'includes/auth.php';
include 'includes/db.php';
$id=$_SESSION['user_id'];
$logs=mysqli_query($conn,
"SELECT * FROM activity_logs
WHERE user_id='$id'
ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Activity Logs</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>

body{

    min-height:100vh;
    background:
    linear-gradient(137deg,#020617,#0f172a,#312e81,#4c1d95);
    font-family:Segoe UI,sans-serif;
    overflow-x:hidden;
}
.navbar{
    background:rgba(255,255,255,0.07);
    backdrop-filter:blur(12px);
    border-bottom:1px solid rgba(255,255,255,0.08);
}
.navbar-brand{
    color:white!important;
    font-size:28px;
    font-weight:bold;
}
.nav-link{
    color:white!important;
    margin-left:15px;
}
.activity-box{/*have toupdate */
    margin-top:55px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(16px);
    border-radius:30px;
    padding:40px;
    box-shadow:0 8px 32px rgba(0,0,0,0.3);
    border:1px solid rgba(255,255,255,0.08);
    color:white;
}
.activity-item{
    background:rgba(255,255,255,0.06);
    border-radius:20px;
    padding:22px;

    margin-bottom:20px;
    transition:0.4s;


    border-left:5px solid #38bdf8;
}

.activity-item:hover{
    transform:translateX(8px);
    background:rgba(255,255,255,0.11);
}
.activity-icon{
    width:60px;
    height:60px;
    border-radius:50%;
    background:
    linear-gradient(to right,#06b6d4,#3b82f6);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
    color:white;
}
.status{

    background:green;
    padding:8px 16px;
    border-radius:30px;
    font-size:14px;
}
.activity-time{
    color:gainsboro;
    font-size:14px;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">
<div class="container">
<a class="navbar-brand" href="dashboard.php">
<i class="fa-solid fa-user-shield"></i>User</a>
<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navMenu">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navMenu">
<ul class="navbar-nav ms-auto">
<li class="nav-item">
<a class="nav-link"href="dashboard.php">Dashboard</a>
</li>
<li class="nav-item">
<a class="nav-link"href="profile.php">Profile</a>
</li>
<li class="nav-item">
<a class="nav-link"href="payment.php">Payment</a>
</li>
<li class="nav-item">
<a class="nav-link active"href="activity_log.php">Activity</a>
</li>
<li class="nav-item">
<a class="nav-link"href="logout.php">Logout</a>
</li>
</ul>
</div>
</div>
</nav>


<div class="container">
<div class="activity-box">
<h1 class="mb-5"><i class="fa-solid fa-clock-rotate-left"></i>Activity History</h1>

<?php while($row=mysqli_fetch_assoc($logs)){
?>
<div class="activity-item">
<div class="d-flex
justify-content-between
align-items-center
flex-wrap">

<div class="d-flex align-items-center">
<div class="activity-icon me-4">
<i class="fa-solid fa-user-check"></i>
</div>
<div>
<h4>
<?php echo $row['activity'];
?>
</h4>
<p class="activity-time mb-0">
<?php echo $row['created_at'];
?>


</p>
</div>
</div>
<div>
<span class="status">Completed</span>
</div>
</div>
</div>
<?php }
?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>