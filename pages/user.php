<?php 
session_start();
include_once '../include/DB.php';
include_once '../include/Query.php';
include_once '../include/Task.php';

// Query To get users ID and POSTS
$query = new Query();
$uid = $_SESSION['uid'];
$taskID = new Task();
$taskID->setID($uid);
$table = $query->userTask($taskID, 'tasks', 'users');
// echo json_encode($table) . $uid;
$fp = fopen('../tasks.json', 'w');
fwrite($fp, json_encode($table));
fclose($fp);
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Home</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>

  <body>
    <div id="container" class="container">
      <div id="header">
        <a href="../index.php?q=logout" class="btn btn-success">LOGOUT</a>
      </div>
      <div id="main-body">
        <h1>
            User
      </h1>
      <div id="tasks"></div>
      <div id="newTaskForm"></div>
      </div>
      <div id="footer"></div>
    </div>
  </body>

  <script type="text/javascript" src="../assets/js/userScript.js"></script>
  </html>

  <?php 

  // Set Task Comppleted
  if(isset($_GET['editID']) && isset($_GET['done'])){
    $editID = $_GET['editID'];
    $editDone = $_GET['done'];
    $editTask = new Task();
    $editTask->setID($editID);
    $editTask->setCompletion($editDone);
    $query->setCompleted($editTask, 'tasks');
  }
