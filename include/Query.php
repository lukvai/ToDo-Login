<?php
// include "DB.php";
class Query{
	protected $db;
		public function __construct(){
			$this->db = new DB();
			$this->db = $this->db->ret_obj();
		}
	// ---ADMIN ---
	public function getTable($tableName1, $tableName2){
		$query = "SELECT $tableName2.uname, $tableName1.id, $tableName1.taskSubject, $tableName1.uid, $tableName1.finished FROM $tableName1 LEFT JOIN $tableName2 ON $tableName1.uid = $tableName2.uid";
		$result = $this->db->query($query) or die($this->db->error);
		$data = $result->fetch_all(MYSQLI_ASSOC);
		return $data;
	}

	public function getUsernames($tableName){
		$query = "SELECT uid, uname FROM $tableName WHERE role = 0";
		$result = $this->db->query($query) or die($this->db->error);
		$data = $result->fetch_all(MYSQLI_ASSOC);
		return $data;
	}

	public function addTask($task, $tableName){
		$taskSubject = $task->getSubject();
		$finished = $task->getCompletion();
		$uid = $task->getID();
		$query= "INSERT INTO $tableName (taskSubject, finished, uid) VALUES ('$taskSubject', '$finished', '$uid')";
		$result = $this->db->query($query) or die($this->db->error);
		header("Location: admin.php");
	}

	public function deleteTask($task, $tableName){
		$id = $task->getID();
		$query = "DELETE FROM $tableName WHERE id = $id";
		$result = $this->db->query($query) or die($this->db->error);
		header("Location: admin.php");
	}

	public function editTask($task, $tableName){
		$id = $task->getID();
		$taskSubject = $task->getSubject();
		$finished = $task->getCompletion();
		$query = "UPDATE tasks SET taskSubject = '$taskSubject', finished = '$finished' WHERE id = '$id'";
		$result = $this->db->query($query) or die($this->db->error);
		header("Location: admin.php");
	}
	// ---END ADMIN---

	// ---USER---
	// Show User Tasks
	public function userTask($task,$tableName1, $tableName2){
		$id = $task->getID();
		$query = "SELECT $tableName2.uname, $tableName1.id, $tableName1.taskSubject, $tableName1.uid, $tableName1.finished FROM $tableName1 LEFT JOIN $tableName2 ON $tableName1.uid = $tableName2.uid WHERE $tableName1.uid = $id";
		$result = $this->db->query($query) or die($this->db->error);
		$data = $result->fetch_all(MYSQLI_ASSOC);
		return $data;
	}
	// Set User Task Completed
	public function setCompleted($task, $tableName){
		$id = $task->getID();
		$finished = $task->getCompletion();
		$query = "UPDATE tasks SET finished = '$finished' WHERE id = '$id'";
		$result = $this->db->query($query) or die($this->db->error);
		header("Location: user.php");
	}
	// ---END USER---
}

?>
