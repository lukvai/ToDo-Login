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
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>

  <body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><i class="fas fa-tasks"></i> Task Manager</h5>
        <nav class="my-2 my-md-0 mr-md-3">
        </nav>
        <button class="btn btn-primary" href="" id="login">Sign in</button>
      </div>
  </div>

    <div class="container text-center" >
      <h1 class="display-4">Task Manager</h1>
      <p class="lead">This is a task manager where the user can view the tasks assigned to him and check if it's completed. And admin can create task, assign task to user, delete task, edit task.</p>
      <hr class="my-4">
    </div>

    <div class="text-center" id="signIn">
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

    <!-- <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script> -->
    <!-- <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script> -->
    <!-- <script type="text/javascript" src="../assets/js/loginScript.js"></script> -->
  </body>
  </html>