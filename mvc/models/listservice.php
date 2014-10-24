<?php
interface ListInterface{
	public function setQurey();
	public function getList();
}

class ListService extends CI_model implements ListInterface
{
	private $query;
	
	public function setQurey(){
		$this->query = "SELECT * FROM test";
	}
	
	public function getList(){
		if($this->query === null)$this->setQurey();
		$eventlist = $this->db->query($this->query);
		return $eventlist;
	}
}
?>