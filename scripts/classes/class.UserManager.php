<?php

class UserManager extends DataManager
{
	protected $select 	= "SELECT d.* ";
	protected $table	= "data_users ";
	protected $from 	= "FROM data_users d ";
	protected $where 	= "WHERE 1 ";
	protected $group 	= "";
	protected $order 	= "ORDER BY d.id DESC";
	protected $limit 	= "";
	
	
    public function __construct()
    {
		#parent::__contruct();
    }
	//  ---------------------------------------------
	//  GET USER
	//  ---------------------------------------------
	public function GetUser($id)
	{
		//  BUILD QUERY
		$q = $this -> select . 
			$this -> from . 
			"WHERE id = '" . sanitize_db($id) . "' 
			AND active = 'yes' 
			LIMIT 0, 1 ";
			
		//  EXECUTE QUERY
		$array = array();	
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
					
		return ($array !== false? $array[0] : false);	
	}
	//  ---------------------------------------------


	//  ----------------------------------------------------------
	//  FUNCTIONALITY TO HANDLE SIGN UP AND LOGIN
	//  ----------------------------------------------------------
	public function AccountExists($email)
	{
		//  MAKE SAFE
		$email = sanitize_db($email);
		
		//  BUILD QUERY
		$q = $this -> select . 
			$this -> from . 
			"WHERE email = '" . $email . "' ";
			
		//  EXECUTE QUERY	
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
		//
		if(empty($array)) $retValue = false;
			else $retValue = true;
			
		return $retValue;	
	}
	//  ----------------------------------------------------------
	//  FUNCTIONALITY TO CHECK USERNAME AVAILABLE
	//  ----------------------------------------------------------
	public function UsernameAvailable($username)
	{
		//  MAKE SAFE
		$username = sanitize_db($username);
		
		//  BUILD QUERY
		$q = $this -> select . 
			$this -> from . 
			"WHERE user_name = '" . $username . "' ";
			
		//  EXECUTE QUERY	
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
		//
		if(empty($array)) {
			$retValue = true;
		}
		else {
			if($USER['id'] != $array[0]['id']) {
				$retValue = false;
			}
			else {
				//  username belongs to this user
				$retValue = true;
			}
		}
			
		return $retValue;	
	}
	//  ----------------------------------------------------------

	//  ----------------------------------------------------------
	//  LOGIN TO USER ACCOUNT
	//  ----------------------------------------------------------
	public function Login($email, $password)
	{
		//  
		if($user = $this -> GetWhere(array('email', 'active'), array($email, 'yes')))
		{
			//  HASH PASSWORD  --------------------
			$encryptedPassword = HashPassword($password);
			#echo $encryptedPassword . '<br>';
			#echo $user[0]['password'];
			//  -----------------------------------
			if($encryptedPassword == $user[0]['password'])
			{
				$_SESSION[SITE_NAME]['LOGGED_IN'] = true;
				$_SESSION[SITE_NAME]['LOGGED_ID'] = $user[0]['id'];
				
				return $user[0];
			}
			else
			{
				return false;
			}
		}
	}
	//  ----------------------------------------------------------
	//  FUNCTIONALITY TO HANDLE SIGN UP AND LOGIN
	//  ----------------------------------------------------------

}

?>