<?php
class adminservice extends CI_model
{
	public function getUserList(){
		$this->load->database();
		$eventlist = $this->db->query("SELECT * FROM user ");
		return $eventlist;
	}
}
?>