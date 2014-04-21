<?php

class DbManager
{
	private $dbConnect;
	
    public function __construct($dbHost, $dbName, $dbUser, $dbPassword)
    {
		$this -> dbConnect = new mysqli($dbHost, $dbUser, $dbPassword, $dbName)
				or die('Could not connect: ' . mysqli_error());
				
    }

	public function SELECT($q)
	{
		$result = $this -> ExecuteQuery($q, MYSQL_ASSOC);

		if($result !== false) {
			$arr = array();
			
			while($row = mysqli_fetch_array($result))
			{ 
				$arr[] = $row;
			}
			@mysqli_free_result($results);
			return $arr;
		}
		else {
			$myDbManager -> debug(mysql_error);
			@mysqli_free_result($results);
			return false;
		}
	}
	
	public function INSERT($q)
	{
		$result = $this -> ExecuteQuery($q);
		
		if($result !== false) {
			$ret		= mysqli_insert_id($this -> dbConnect);
			
			@mysqli_free_result($results);
			return $ret;
		}
		else {
			@mysqli_free_result($results);
			return false;
		}
	}
	
	public function UPDATE($q)
	{
		$result = $this -> ExecuteQuery($q);
		if($result !== false) {
			$ret		= mysqli_affected_rows($this -> dbConnect);
			
			@mysqli_free_result($results);
			return $ret;
		}
		else {
			//echo 'Could not connect: ' . mysql_error();
			@mysqli_free_result($results);
			return false;
		}
	}
	
	public function DELETE($q)
	{
		$result = $this -> ExecuteQuery($q);
		
		if($result !== false) {
			$ret		= mysqli_affected_rows($this -> dbConnect);
			
			@mysqli_free_result($results);
			return $ret;
		}
		else {
			@mysqli_free_result($results);
			return false;
		}
	}
	
	public function ExecuteQuery($q)
	{
		$result = mysqli_query($this->dbConnect, $q);
		
		return	($result !== false ? $result : false);
	}
	
	public function debug($msg)
	{
		if((!ONLINE) || (DEBUG)) {
			$msg = addslashes($msg);
			$tmp = $this -> ExecuteQuery("INSERT INTO `debug` (`msg`, `date_added`) VALUES('" . $msg . "', NOW() )");
		}
	}

}

?>