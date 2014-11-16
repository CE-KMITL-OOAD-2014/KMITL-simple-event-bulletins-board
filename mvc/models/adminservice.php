<?php
/**
 * adminservice Class
 *
 * all service for webmaster 
 *
 */
class adminservice extends CI_model
{
	/**
	 * get User's List form db
	 *
	 * this function will query  SQL database
	 * for user data
	 *
	 * @return	list of user in DB
	 *
	 */
	public function getUserList(){
		$this->load->database();
		$eventlist = $this->db->query("SELECT * FROM user ");
		return $eventlist;
	}
	
	// --------------------------------------------------------------------
	
}
?>