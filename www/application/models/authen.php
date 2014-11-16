<?php
/**
 * authen Class
 *
 * class for authentication when user log in
 * and compare input with database
 *
 */
class authen extends CI_model
{
	private $username;
	private $password;
	private $code;
	private $key;
	
	// --------------------------------------------------------------------
	
	/**
	 * set up log in Form  from user
	 *
	 */
	public function setForm($username,$password){
		$this->username = $username;
		$this->password = $password;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * load user data from db
	 *
	 * load encrypt password and key from SQL database
	 *
	 * @return if user is exist in database
	 *
	 */
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
	
	// --------------------------------------------------------------------
	
	/**
	 * check if data is exist in database
	 *
	 * @param	string	str to compare
	 * @param	string	type of column in db
	 * @return if data is exist in user database
	 *
	 */
	public function isHave($str , $type){
		$this->load->database();
		$getDB = $this->db->query("SELECT * FROM user WHERE $type='$str'");
		if($getDB->num_rows() > 0){
			return $getDB;
		}
		return null;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * check if password is correct
	 *
	 * @return if password is correct
	 *
	 */
	public function isPassMatch(){
		$this->load->model('encryption');
		if($this->encryption->decode($this->code,$this->key) === $this->password) 
			return true;
		return false;
	}
	
	// --------------------------------------------------------------------
	
}
?>