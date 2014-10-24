<?php
class authen extends CI_model
{
	private $username;
	private $password;
	private $code;
	private $key;
	
	public function setForm($username,$password){
		$this->username = $username;
		$this->password = $password;
	}
	public function loadDB(){
		$getDB = $this->db->query("SELECT username,password,passkey FROM user WHERE username='$this->username'");
		if($getDB->num_rows() > 0){
			$row = $getDB->row();
			$this->code = $row->password;
			$this->key = $row->passkey;
			return true;
		}
		return false;
	}
	
	public function isMatch(){
		$this->load->model('encryption');
		if($this->encryption->decode($this->code,$this->key) === $this->password) return true;
		return false;
	}
}
?>