<?php 

class Task{
	private $id, $taskSubject, $finished;

	public function getCompletion()
    {
        return $this->finished;
    }
    public function getSubject(){
        return $this->taskSubject;
    }
    public function getID(){
        return $this->id;
    }
    public function setID($id)
    {
        $this->id = $id;
    }
    public function setSubject($taskSubject)
    {
        $this->taskSubject = $taskSubject;
    }
    public function setCompletion($finished){
        $this->finished = $finished;
    }
}


?>