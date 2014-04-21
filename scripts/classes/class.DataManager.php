<?php

class DataManager
{
	protected $select 	= "SELECT d.* ";
	protected $table	= "data_site ";
	protected $from 	= "FROM data_site d ";
	protected $where 	= "WHERE 1 ";
	protected $group 	= "";
	protected $order 	= "ORDER BY d.id ";
	protected $limit 	= "";
	
	
    public function __construct()
    {

    }

	//  ---------------------------------------------
	//  UNIVERSAL GET SINGLE ENTRY
	//  ---------------------------------------------
	public function GetEntry($id)
	{
		//  BUILD QUERY
		$q = $this -> select . 
			$this -> from . 
			$this -> where . 
			"AND  id = '" . sanitize_db($id) . "' 
			LIMIT 0, 1";
			
		//  EXECUTE QUERY	
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
					
		return ($array !== false? $array[0] : false);	
	}
	//  ---------------------------------------------

	//  ---------------------------------------------
	//  UNIVERSAL GET PAGE OF ENTRY
	//  ---------------------------------------------
	public function GetEntries($page = false, $BROWSE_DATA)
	{
		
		if($page !== false)
		{
			$page = sanitize_db($page);
			$row  = ($page - 1) * CONTENT_COUNT;
			//  Create limit for sql string
			$limit = 'LIMIT ' . $row . ', ' . CONTENT_COUNT . ' ';
		}
		//  BUILD QUERY
		$q = $this -> select . 
			$this -> from . 
			($where? $where : $this -> where) . 
			$this -> order .
			($limit? $limit : $this -> limit);
			#echo $q;
		//  EXECUTE QUERY	
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
		
		#if($limit && $array)$array['data_count'] = $GLOBALS['myPageManager'] -> paginate($q);
					
		return ($array !== false? $array : false);	
	}
	//  ---------------------------------------------
	
	//  ---------------------------------------------
	//  UNIVERSAL GET ALL FUNCTION
	//  ---------------------------------------------
	public function GetAll()
	{
		$q = 	$this -> select . //CONCATENATE STRING
				$this -> from . //CONCATENATE STRING
				$this -> where . //CONCATENATE STRING
				$this -> group . //CONCATENATE STRING
				$this -> order . //CONCATENATE STRING
				$this -> limit;
		
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
		
		//  Return this array or, if 'false', return empty array
		return ($array !== false? $array : false);
	}
	//  ---------------------------------------------

	//  ---------------------------------------------
	//  UNIVERSAL CONDITIONED GET FUNCTION
	//  ---------------------------------------------
	public function GetWhere($key, $value)
	{
		$where = "WHERE 1 ";

		for($i=0; $i<count($key); $i++)
		{
			$where .= " AND " . sanitize_db($key[$i]) . "='" . sanitize_db($value[$i]) . "' ";
		}
		$q = 	$this -> select . //CONCATENATE STRING
				$this -> from  . //CONCATENATE STRING
				$where . //CONCATENATE STRING
				$this -> group . //CONCATENATE STRING
				$this -> order . //CONCATENATE STRING
				$this -> limit;
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
		
		//  Return this array or, if 'false', return empty array
		return ($array !== false? $array : false);
	}
	//  ---------------------------------------------

	//  ---------------------------------------------
	//  UNIVERSAL UPDATE FUNCTION
	//  ---------------------------------------------
	public function UpdateEntry($id, $key, $data)
	{
		$q = "UPDATE " . $this -> table . 
			" SET " . sanitize_db($key) . " = '" . sanitize_db($data) . "' " .
			" WHERE id = '" . sanitize_db($id) . "' ";
						
		$ret = $GLOBALS['myDbManager'] -> UPDATE($q);
		
		return ($ret !== false? $ret : false);
	}
	//  ---------------------------------------------

	//  ---------------------------------------------
	//  UNIVERSAL INCREMENTAL FUNCTION
	//  ---------------------------------------------
	public function Increment($id, $key, $increment = 1)
	{
		$key = addslashes($key);
		
		$q = "UPDATE " . $this -> table . 
			" SET " . $key . " = " . $key . "+" . sanitize_db($increment) . " " .
			" WHERE id = '" . sanitize_db($id) . "' ";
		$GLOBALS['myDbManager'] -> debug($q);
		$ret = $GLOBALS['myDbManager'] -> UPDATE($q);
		//
		return ($ret !== false? $ret : false);
	}
	//  ---------------------------------------------

	//  ---------------------------------------------
	//  UNIVERSAL DECREMENTAL FUNCTION
	//  ---------------------------------------------
	public function Decrement($id, $key, $decrement = 1)
	{
		$key = sanitize_db($key);
		
		$q = "UPDATE " . $this -> table . 
			" SET " . $key . " = " . $key . "-" . sanitize_db($decrement) . " " .
			" WHERE id = '" . sanitize_db($id) . "' ";
						
		$ret = $GLOBALS['myDbManager'] -> UPDATE($q);
		//
		return ($ret !== false? $ret : false);
	}
	//  ---------------------------------------------

	//  ---------------------------------------------
	//  UNIVERSAL INSERT FUNCTION
	//  ---------------------------------------------
	public function CreateEntry()
	{
		$q = "INSERT INTO " . $this -> table . 
			" (`date_added`) VALUES ( NOW() ) ";
		
		$id = $GLOBALS['myDbManager'] -> INSERT($q);
		
		return ($id !== false? $id : false);
	}
	//  ---------------------------------------------

	//  ---------------------------------------------
	//  BUILD ENTRY
	//  ---------------------------------------------
	public function BuildEntry($id, $dataArray, $ignore = array('id', 'date_added'))
	{
		$GLOBALS['myDbManager'] -> debug('id: ' . $id);
		
		$errors = false;
		
		foreach ($dataArray as $key => $value)
		{
			//	not in ignoreArray
			if (!(in_array($key, $ignore)))
			{
				$GLOBALS['myDbManager'] -> debug('input: ' . $key .  ' value: ' . $value);
				$ret = $this -> UpdateEntry($id, $key, $value);
				if($ret === false) {
					$GLOBALS['myDbManager'] -> debug('error for: ' . $key .  ' value: ' . $value);
					$errors = true;
				}
			}
		}
		
		return ($errors === false ? true : false);
	}
	//  ---------------------------------------------



}

?>