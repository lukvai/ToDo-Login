<?php 
include_once '../include/DB.php';
include_once '../include/Query.php';
include_once '../include/Task.php';

// Query To Get All Tasks
$query = new Query();
$table = $query->getTable('tasks', 'users');
// echo json_encode($table);

// Write Tasks To JSON
$fp = fopen('../tasks.json', 'w');
fwrite($fp, json_encode($table));
fclose($fp);
// Write Users To JSON
$usernames = $query->getUsernames('users');
// echo json_encode($usernames);
$fp2 = fopen('../usernames.json', 'w');
fwrite($fp2, json_encode($usernames));
fclose($fp2);

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </head>

  <body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal"><i class="fas fa-tasks"></i> Task Manager</h5>
        <nav class="my-2 my-md-0 mr-md-3">
        </nav>
        <a href="../index.php?q=logout" class="btn btn-primary">Logout</a>
      </div>
    </div>

    <div id="container" class="container">
      <div id="main-body">
        <h1>
            Admin
    	</h1>
      <div id="tasks"></div>
      <div id="newTaskForm"></div>
      </div>
      <div id="footer"></div>
    </div>
  </body>

  <script type="text/javascript" src="../assets/js/adminScript.js"></script>
  </html>

  <?php
  // Add task
  if(isset($_GET['subject']) && isset($_GET['userid'])){
    $subjectValue = $_GET['subject'];
    $useridValue = $_GET['userid'];
    $newTask = new Task();
    $newTask->setSubject($subjectValue);
    $newTask->setID($useridValue);
    $query->addTask($newTask, 'tasks');
  }

  // Delete Task
  if(isset($_GET['delete']) && isset($_GET['id'])){
    $taskID = $_GET['id'];
    $newTask = new Task();
    $newTask->setID($taskID);
    $query->deleteTask($newTask, 'tasks');
  }

// Edit Task
if(isset($_GET['editID']) && isset($_GET['editSubject']) && isset($_GET['done'])){
  $editID = $_GET['editID'];
  $editSubject = $_GET['editSubject'];
  $editDone = $_GET['done'];
  $editTask = new Task();
  $editTask->setID($editID);
  $editTask->setSubject($editSubject);
  $editTask->setCompletion($editDone);
  $query->editTask($editTask, 'tasks');
  // echo $editDone;
}else if(isset($_GET['editID']) && isset($_GET['editSubject'])){
  $editID = $_GET['editID'];
  $editSubject = $_GET['editSubject'];
  $editDone = 0;
  $editTask = new Task();
  $editTask->setID($editID);
  $editTask->setSubject($editSubject);
  $editTask->setCompletion($editDone);
  $query->editTask($editTask, 'tasks');
}
