<!DOCTYPE html>
<html>
<head>
<title>Dark Mode</title>

<style>
body{
    transition:0.5s;
}
.dark-mode{
    background:black;
    color:white;
}
</style>

</head>
<body>

<button onclick="darkMode()">Toggle Dark Mode</button>
<h1>User Management System</h1>
<script>
function darkMode(){
    document.body.classList.toggle('dark-mode');
}
</script>

</body>
</html>