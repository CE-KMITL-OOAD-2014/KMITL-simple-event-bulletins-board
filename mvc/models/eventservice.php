<?php
class eventservice extends CI_model
{
	private $tmp_event;
	
	public function newEvent($title,$des,$image,$due_date){
		$this->tmp_event['title'] = $title;
		$this->tmp_event['des'] = $des;
		$this->tmp_event['image'] = $image;
		$this->tmp_event['author'] = $this->input->cookie('user');
		$this->tmp_event['postdate'] = date('y-m-j');
		$this->tmp_event['duedate'] = $due_date;
		return $this->tmp_event;
	}
	
	public function loadEvent($id){
		$this->load->database();
		$this->tmp_event = $this->db->query("SELECT * FROM event WHERE id='$id'");
		$this->tmp_event = $this->tmp_event->row_array();
		return $this->tmp_event;
	}
	
	public function saveEvent($id = -1){
		$this->load->database();
		$tmp_title = $this->tmp_event['title'];
		$tmp_des = $this->tmp_event['des'];
		$tmp_image = $this->tmp_event['image'];
		$tmp_author = $this->tmp_event['author'];
		$tmp_postdate = $this->tmp_event['postdate'];
		$tmp_duedate = $this->tmp_event['duedate'];
		if($id === -1)
			$this->db->query("INSERT INTO event (title,des,image,author,postdate,duedate) VALUES ('$tmp_title','$tmp_des','$tmp_image','$tmp_author','$tmp_postdate','$tmp_duedate')");
		else
			$this->db->query("UPDATE event SET title='$tmp_title',des='$tmp_des',image='$tmp_image',postdate='$tmp_postdate',duedate='$tmp_duedate' WHERE id='$id'");
	}
}
?>