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
		$getDB = $this->isHave($this->username ,'username');
		if($getDB !== null){
			$row = $getDB->row();
			$this->code = $row->password;
			$this->key = $row->passkey;
			return true;
		}
		return false;
	}
	
	public function isHave($str , $type){
		$this->load->database();
		$getDB = $this->db->query("SELECT * FROM user WHERE $type='$str'");
		if($getDB->num_rows() > 0){
			return $getDB;
		}
		return null;
	}
	
	
	public function isPassMatch(){
		$this->load->model('encryption');
		if($this->encryption->decode($this->code,$this->key) === $this->password) return true;
		return false;
	}
}
?>