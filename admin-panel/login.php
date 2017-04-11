<?php
session_start();
ob_start();
    ob_flush();
require '../functions/functions.php';
require '../functions/functions.admin.php';
if (session_control(get_session("username"), get_session("userpass"))) {
    go("index.php");
}

if (isset($_POST["login"])) {
    
    $username = $_POST["username"];
    $userpass = $_POST["userpass"];
    
    if (login($username, $userpass)) {
        go("index.php");
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'include/head.php'; ?>

<body class="login-img3-body">
    <div class="container">
        <form class="login-form" action="" method="post">
            <div class="login-wrap">
                <div style="">
                </div>
                <p class="login-img"><i class="icon_lock_alt"></i>
                </p>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_profile"></i></span>
                    <input type="text" class="form-control" name="username" placeholder="Username" autofocus>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                    <input type="password" class="form-control" name="userpass" placeholder="Password">
                </div>                
                <button class="btn btn-primary btn-lg btn-block" name="login" type="submit">Login</button>
            </div>
        </form>
    </div>
</body>

</html>