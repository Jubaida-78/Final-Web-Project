<?php
include 'includes/db.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
if(isset($_POST['register'])){
    $full_name=mysqli_real_escape_string($conn,$_POST['full_name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=$_POST['password'];
    $check_email=mysqli_query($conn,"SELECT* FROM users WHERE email='$email'");
    if(mysqli_num_rows($check_email) > 0){
        echo "
        <script>
        alert('Email Already Exists');
        </script>
        ";
    }
    else{
        $hashed_password=password_hash($password,PASSWORD_DEFAULT);
        $verification_code=md5(rand());
        $image_name=$_FILES['profile_image']['name'];
        $temp_name=$_FILES['profile_image']['tmp_name'];
        move_uploaded_file($temp_name, "uploads/profile_images/".$image_name);
        $insert = "INSERT INTO users(full_name,email,password,profile_image,verification_code)
        VALUES('$full_name','$email','$hashed_password','$image_name','$verification_code')";
        if(mysqli_query($conn,$insert)){
            $mail=new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username='jubaida.b515@gmail.com';
            $mail->Password='yslb zogg xzjc zgwr';
            $mail->SMTPSecure='tls';
            $mail->Port=587;
            $mail->setFrom('jubaida.b515@gmail.com');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Email Verification';
            $mail->Body = "Click This Link To Verify Your Account:
            http://localhost/user-management-system/verify.php?code=$verification_code";
            $mail->send();
            echo "
            <script>
            alert('Registration Successful. Check Email For Verification');
            window.location.href='login.php';
            </script>
            ";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
<div class="container mt-5">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card p-4 shadow">
<h2 class="text-center mb-4">Register</h2>
<form method="POST" enctype="multipart/form-data">
<input type="text" name="full_name" class="form-control mb-3" placeholder="Full Name" required>
<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
<input type="file" name="profile_image" class="form-control mb-3" required>
<button type="submit" name="register" class="btn btn-primary w-100">Register</button>
</form>


<br>
<p class="text-center">Already Have Account?
<a href="login.php">Login</a>
</p>
</div>
</div>
</div>
</div>
</body>
</html>