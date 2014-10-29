<?php
class signup extends CI_model
{
	private $username;
	private $password;
	private $email;
	private $key;
	
	public function setForm($username,$password,$email){
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
	}
	public function getKey(){
		return $this->key;
	}
	
	public function genKey(){
		$this->key = "";
		while(strlen($this->key)<20){
			$type = chr(rand(0,2));
			switch($type){
				case 0: $this->key .= chr(rand(48,57));
				case 1: $this->key .= chr(rand(65,90));
				default: $this->key .= chr(rand(97,122));
			}
		}
	}
	
	public function saveForm(){
		$this->load->database();
		$this->db->query("INSERT INTO user (username,password,email,passkey) VALUES ('$this->username','$this->password','$this->email','$this->key')");
	}
}
?>