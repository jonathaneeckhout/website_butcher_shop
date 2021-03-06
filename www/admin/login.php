<?php
//include config
require_once('../includes/config.php');

//check if already logged in
if( $user->is_logged_in() ){ header('Location: index.php'); }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../style/normalize.css">
    <link rel="stylesheet" href="../style/main.css">
</head>
<body>

    <div id="login">
        <?php
        //process login form if submitted
        if(isset($_POST['submit'])){
            $apc_key = "{$_SERVER['SERVER_NAME']}~login:{$_SERVER['REMOTE_ADDR']}";
            $tries = (int)apc_fetch($apc_key);
            if ($tries >= 3) {
                header("HTTP/1.1 429 Too Many Requests");
                echo "You've exceeded the number of login attempts. Please try again in a few minutes.";
                exit();
            }
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            if($user->login($username,$password)){
                //logged in return to index page
                apc_delete($apc_key);
                header('Location: index.php');
                exit;
            } else {
                apcu_store($apc_key, $tries+1, 600);
                $message = '<p class="error">Wrong username or password</p>';
            }
        }//end if submit
        if(isset($message)){ echo $message; }
        ?>
        <form action="" method="post">
            <p><label>Username</label><input type="text" name="username" value=""  /></p>
            <p><label>Password</label><input type="password" name="password" value=""  /></p>
            <p><label></label><input type="submit" name="submit" value="Login"  /></p>
        </form>

    </div>
</body>
</html>
