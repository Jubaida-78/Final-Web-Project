<?php
include 'includes/auth.php';

include 'includes/db.php';

$id=$_SESSION['user_id'];

$user=mysqli_fetch_assoc(
mysqli_query($conn,"SELECT * FROM users WHERE id='$id'")
);
if(isset($_POST['confirm_delete'])){
    unlink("uploads/profile_images/".$user['profile_image']);
    mysqli_query($conn,
    "DELETE FROM users WHERE id='$id'");
    session_destroy();
    echo "
    <script>
    alert('Profile Deleted Successfully');
    window.location.href='register.php';
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

<title>Delete Account</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{

    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:
    linear-gradient(135deg,#020617,#0f172a,#7f1d1d);
    font-family:'Segoe UI',sans-serif;
}

.glass-card{
    width:100%;
    max-width:550px;
    padding:45px;
    border-radius:32px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.08);
    box-shadow:0 8px 32px rgba(0,0,0,0.35);
    text-align:center;
    color:white;
    animation:fadeUp 0.7s ease;
}
.icon-box{
    width:120px;
    height:120px;
    margin:auto;
    border-radius:35px;
    background:
    linear-gradient(to right,#ef4444,#dc2626);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:50px;
    margin-bottom:25px;
}
.glass-card h1{
    font-size:36px;
    margin-bottom:15px;
}
.glass-card p{
    color:#e2e8f0;
    line-height:1.8;
    margin-bottom:35px;
}
.btn-modern{
    padding:14px 30px;
    border:none;
    border-radius:15px;
    font-weight:bold;
    transition:0.4s;
    margin:8px;

    
}
.delete-btn{
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
<i class="fa-solid fa-trash"></i>
</div>
<h1>Delete Account</h1>
<p>This action will permanently remove your account,profile image,and associated data.
</p>
<form method="POST">
<button type="submit"name="confirm_delete"class="btn btn-modern delete-btn">Yes,Delete</button>
<a href="dashboard.php"class="btn btn-modern cancel-btn">Cancel</a>


</form>

</div>

</body>
</html>