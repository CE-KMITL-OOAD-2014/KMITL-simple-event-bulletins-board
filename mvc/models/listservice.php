<?php
class listservice extends CI_model
{
	private $query;
	
	public function __construct(){
		$this->query = "SELECT * FROM event ";
	}
	
	public function setSearchQurey($keyword,$from = 'title',$outOfDate = false){
		if(!$from||$from === '') $from = 'title';
		$this->query = $this->query."WHERE $from LIKE '%$keyword%' ";
		if($outOfDate) $this->query = $this->query."AND duedate >= CURDATE() ";
		
		$this->input->set_cookie('search',$keyword."|".$from,'1200');
	}
	
	public function setSortQuery($type = 'id',$desc = 'DESC'){
		if(!$type||$type === '') $type = 'id';
		if(!$desc||$desc === '') $desc = 'DESC';
		$this->query = $this->query."ORDER BY $type $desc ";
		
		if($this->input->cookie('search') === false) $this->input->set_cookie('search',"||".$type."|".$desc,'1200');
		else {
			$search = explode("|",$this->input->cookie('search'));
			$this->input->set_cookie('search',$search[0]."|".$search[1]."|".$type."|".$desc,'1200');
		}
	}
	
	public function getList(){
		$eventlist = $this->db->query($this->query);
		return $eventlist;
	}
}
?>