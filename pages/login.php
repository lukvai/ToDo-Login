<?php 
session_start();
include_once '../include/DB.php';
include_once '../include/User.php';
// include_once '../include/Query.php';

$user = new User();
$message = "";

// Check Login
if (isset($_POST['submit'])) { 
		extract($_POST);   
	    $login = $user->check_login($username, $password);
      $uid = $_SESSION['uid'];
      $role = $user->get_Role($uid);
      // echo $role;
	    if ($login && $role == 1) {
	        // Login Success
	       header("location: admin.php");
	    } else if($login && $role == 0){
           header("location: user.php");
      }else {
	        // Login Failed
	        $message = 'Wrong username or password';
	    }
	}

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>OOP Login Module</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  </head>

  <body>
    <div class="text-center">
      <form class="form-signin" method="post" action="">
        <h3 class="h3 mb-3 font-weight-normal">Please sign in</h3>
        <label for="Username" class="sr-only">Username</label>
        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus name="username" pattern="[aA-zZ0-9]{3,15}" required>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password" required>
       <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
       <div class="">
          <p><?php echo $message ?></p>
        </div>
      </form>
    </div>
  </body>
  </html>