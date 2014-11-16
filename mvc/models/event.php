<?php
/**
 * event Class
 *
 * class for event object
 *
 */
class event extends CI_model
{
	private $id;
	private $title;
	private $desc;
	private $author;
	private $postdate;
	private $duedate;
	
	// --------------------------------------------------------------------
	
	/**
	 * build new event following param
	 *
	 */
	public function newEvent($title,$des,$image,$duedate){
		$this->id = -1; //set id to new event
		$this->title = $title;
		$this->des = $des;
		$this->image = $image;
		$this->author = $this->input->cookie('user'); //get username from cookie
		$this->postdate = date('y-m-j'); //this date
		$this->duedate = $duedate;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * load Event from database
	 *
	 * set this object to event
	 * following the $id parameter
	 *
	 */
	public function loadEvent($id){
		//get data from DB
		$this->load->database();
		$tmp_event = $this->db->query("SELECT * FROM event WHERE id='$id'");
		$tmp_event = $tmp_event->row_array();
		//assign data to object attr
		$this->title = $tmp_event['title'];
		$this->des = $tmp_event['des'];
		$this->image = $tmp_event['image'];
		$this->author = $tmp_event['author'];
		$this->postdate = $tmp_event['postdate'];
		$this->duedate = $tmp_event['duedate'];
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * save Event to database
	 *
	 * keep this object attr to DQL database
	 *
	 */
	public function saveEvent(){
		$this->load->database();
		//if this object is new event : insert it to db
		if($this->id === -1){
			$this->db->query("INSERT INTO event (title,des,image,author,postdate,duedate) 
			
			VALUES ('$this->title',
					'$this->des',
					'$this->image',
					'$this->author',
					'$this->postdate',
					'$this->duedate'
					)");
		}
		//if this object is exist event : edit it
		else{
			$this->db->query("UPDATE event SET 
				
				title='$this->title',
				des='$this->des',
				image='$this->image',
				postdate='$this->postdate',
				duedate='$this->duedate' 
				
				WHERE id='$this->id'");
		}
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * check if this object is match keyword
	 *
	 * @return	if this object is match keyword
	 */
	public function isHave($keyword = ''){
		//if keyword is null , always true
		if($keyword === '')
			return true;
		//checking by compare with title
		if(strstr($this->title,$keyword)) 
			return true;
		return false;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * check if this event is out of date
	 *
	 * @return if this event is out of date
	 */
	public function isExpire(){
		$duedate = new DateTime($this->duedate);
		$today = new DateTime("now");
		
		if($duedate < $today) 
			return true;
		return false;
	}
	
	// --------------------------------------------------------------------
	
	/**
	 * get this Event 
	 *
	 * @return	array of all attr 
	 */
	public function getEvent(){
		return array(
			'id' => $this->id,
			'title' => $this->title,
			'des' => $this->des,
			'image' => $this->image,
			'author' => $this->author,
			'postdate' => $this->postdate,
			'duedate' => $this->duedate
		);
	}
	
	// --------------------------------------------------------------------
	
}
?>