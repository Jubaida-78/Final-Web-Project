<?php

include 'includes/db.php';

if(isset($_GET['code'])){

    $code = $_GET['code'];

    $update = mysqli_query($conn, "UPDATE users SET is_verified='1' WHERE verification_code='$code'");

    if($update){
        echo "
        <script>
        alert('Email Verified Successfully');
        window.location.href='login.php';
        </script>
        ";
    }
}

?>