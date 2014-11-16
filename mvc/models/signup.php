<?php
/**
 * signup Class
 *
 * class for user to register 
 *
 */
class signup extends CI_model
{
	//user value
	private $username;
	private $password;
	private $email;
	private $key;
	
	// --------------------------------------------------------------------
	
	/**
	 * set the Form from user
	 *
	 * this function will save form in to object attr
	 *
	 */
	public function setForm($username,$password,$email){
		$this->username = $username;
		$this->password = $password;
		$this->email = $email;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * get Key
	 *
	 * @return	key
	 */
	public function getKey(){
		return $this->key;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * genarate Key
	 *
	 * this function will generate key by random value
	 * and save key to object attr
	 *
	 */
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
	
	// --------------------------------------------------------------------
	
	/**
	 * save Form to db
	 *
	 * this function will save object attr 
	 * in to SQL database
	 *
	 */
	public function saveForm(){
		$this->load->database();
		$this->db->query("INSERT INTO user (username,password,email,passkey) 
							VALUES (
							'$this->username',
							'$this->password',
							'$this->email',
							'$this->key')"
						);
	}
	
	// --------------------------------------------------------------------
	
}
?>