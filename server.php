<?php

$username = "";
$errors = array(); 

// $db = mysqli_connect('localhost', 'nsp', 'wart1drex*LIY2rern', 'nsp');
$db = mysqli_connect('localhost', 'root', '', 'nsp');

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            setcookie('user', $username, 0, "/");
            header('location: admin.php?mode=home');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
if (isset($_POST['logout_user'])) {
    setcookie('user', $username, time() + (0), "/");
    header('Location: index.php');
}
  
?>