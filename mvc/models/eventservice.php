<?php
class eventservice extends CI_model
{
	private $tmp_event;
	
	public function loadEvent($id){
		$this->load->database();
		$this->tmp_event = $this->db->query("SELECT * FROM event WHERE id='$id'");
		return $this->tmp_event->row_array();
	}
}
?>