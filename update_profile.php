<?php
include 'includes/auth.php';
include 'includes/db.php';
$id=$_SESSION['user_id'];
$user=mysqli_fetch_assoc(
mysqli_query($conn,
"SELECT * FROM users WHERE id='$id'")
);
if(isset($_POST['update'])){
    $full_name=$_POST['full_name'];
    $image_name=$_FILES['profile_image']['name'];
    $temp_name=$_FILES['profile_image']['tmp_name'];
    if($image_name!=""){
        move_uploaded_file(
        $temp_name,
        "uploads/profile_images/".$image_name
        );
        mysqli_query($conn,
        "UPDATE users SET
        full_name='$full_name',
        profile_image='$image_name'
        WHERE id='$id'");
    }
    else{
        mysqli_query($conn,
        "UPDATE users SET
        full_name='$full_name'
        WHERE id='$id'");
    }
    $activity=$full_name." Updated Profile";
    mysqli_query($conn,
    "INSERT INTO activity_logs(user_id,activity)
    VALUES('$id','$activity')");
    echo "
    <script>
    alert('Profile Updated Successfully');
    window.location.href='profile.php';
    </script>
    ";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"content="width=device-width, initial-scale=1.0">

<title>Update Profile</title>
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
.update-card{
    width:100%;
    max-width:550px;
    padding:45px;
    border-radius:30px;
    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(18px);
    border:1px solid rgba(255,255,255,0.08);
    box-shadow:0 8px 32px rgba(0,0,0,0.35);
    color:white;
}


.title{

    text-align:center;
    font-size:38px;
    font-weight:bold;
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
.update-btn{
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
.update-btn:hover{
    transform:translateY(-4px);
    box-shadow:0 8px 25px rgba(59,130,246,0.5);
}
</style>

</head>

<body>
<div class="update-card">
<h1 class="title">
<i class="fa-solid fa-user-pen"></i>Update Profile
</h1>
<form method="POST"
enctype="multipart/form-data">
<input
type="text"
name="full_name"
class="form-control"
value="<?php echo $user['full_name'];?>"
required>
<input
type="file"
name="profile_image"
class="form-control">
<button
type="submit"
name="update"
class="update-btn">
<i class="fa-solid fa-floppy-disk"></i>Save Changes
</button>
</form>
</div>

</body>
</html>