<?php

class DealManager extends DataManager
{
	protected $select 	= "SELECT d.* ";
	protected $table	= "data_deals ";
	protected $from 	= "FROM data_deals d ";
	protected $where 	= "WHERE 1 ";
	protected $group 	= "";
	protected $order 	= "ORDER BY d.date_added DESC ";
	protected $limit 	= "";
	
	
    public function __construct()
    {
		#parent::__contruct();
    }
	//  ----------------------------------------------------------
	//  TEMPLATE CODE FOR DEBUGGING TO DATABASE
		#$GLOBALS['myDbManager'] -> ExecuteQuery("INSERT INTO `debug` (`msg`) VALUES('" . $array[0]['email'] . "')");
	//  ----------------------------------------------------------

	//  ----------------------------------------------------------
	//  GET FUNCTIONS
	//  ----------------------------------------------------------
	
	//  ----------------------------------------------------------
	//  GET PAGE OF CONTENT
	//  ----------------------------------------------------------
	public function GetEntries($page = false, $BROWSE_DATA)
	{
  		$where = "WHERE enabled = 'yes' ";
		$limit = "";
		//  deal type
		if(isset($BROWSE_DATA['type'])) {
			$where .= "AND deal_type = '" . sanitize_db($BROWSE_DATA['type']) . "' ";
		}
		//  deal category - not yet implemented
		if(isset($BROWSE_DATA['category']) && ($BROWSE_DATA['category'] != '')) {
			$where .= "AND category = '" . sanitize_db($BROWSE_DATA['category']) . "' ";
		}
		//  get by user
		if(isset($BROWSE_DATA['user']) && ($BROWSE_DATA['user'] != '')) {
			$where .= "AND id_user = '" . sanitize_db($BROWSE_DATA['user']) . "' ";
		}
		//  search  query
		if(isset($BROWSE_DATA['search']) && ($BROWSE_DATA['search'] != '')) {
			$where .= "AND (title LIKE '%" . sanitize_db($BROWSE_DATA['search']) . "%') ";
		}
		//  page and limit query contruction
		if($page !== false)
		{
			$GLOBALS['myDbManager'] -> debug('page: ' . $page);
			if(isset($BROWSE_DATA['count']) && ($BROWSE_DATA['count'] > 0)) {
				if($page == 0) {
					$page = 1;
					$page = sanitize_db($page);
					$row  = 0;
				}
				elseif($page == 1) {
					$page = sanitize_db($page);
					$row  = 12;
					$BROWSE_DATA['count'] = ($BROWSE_DATA['count'] -12);
				}
				else {
					$page = sanitize_db($page);
					$row  = ($page - 1) * $BROWSE_DATA['count'];
				}
				//  Create limit for sql string
				$limit = 'LIMIT ' . $row . ', ' . $BROWSE_DATA['count'] . ' ';
				$GLOBALS['myDbManager'] -> debug('limit: ' . $limit);
			}
			else {
				$page = sanitize_db($page);
				$row  = $page * CONTENT_COUNT;
				//  Create limit for sql string
				$limit = 'LIMIT ' . $row . ', ' . CONTENT_COUNT . ' ';
				$GLOBALS['myDbManager'] -> debug('limit: ' . $limit);
			}
		}
		//  BUILD QUERY
		$GLOBALS['myDbManager'] -> debug('build query');
		$q = 	"SELECT d.* " . 
				"FROM data_deals d " . 
				$where . 
				"ORDER BY d.date_added DESC " .
				$limit;				
				//echo $q;
		$GLOBALS['myDbManager'] -> debug('query: ' . $q);
		//  EXECUTE QUERY	
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
		 //			
		$GLOBALS['myDbManager'] -> debug('count: ' . count($array));
		
		#$GLOBALS['myDbManager'] -> debug('var dump: ' . var_dump($array));
		return ($array !== false? $array : false);	
	}
	//  ----------------------------------------------------------

	//  ---------------------------------------------
	public function GetDeal($hash, $id)
	{
		//  BUILD QUERY
		$q = $this -> select . 
			$this -> from . 
			$this -> where . 
			" AND  hash = '" . sanitize_db($hash) . "' 
			AND  id = '" . sanitize_db($id) . "' 
			LIMIT 0, 1";
		//  EXECUTE QUERY	
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
		
					
		return ($array !== false? $array[0] : false);	
	}
	//  ---------------------------------------------
	public function GetLatest($id)
	{
		//  BUILD QUERY
		$q = $this -> select . 
			$this -> from . 
			$this -> where . 
			" AND  id_user = '" . sanitize_db($id) . "' 
			ORDER BY d.id DESC
			LIMIT 0, 3";
			#echo $q;
		//  EXECUTE QUERY	
		$array = $GLOBALS['myDbManager'] -> SELECT($q);
		
					
		return ($array !== false? $array : false);	
	}
	//  ---------------------------------------------
	//  ----------------------------------------------------------
	//  SET FUNCTIONS
	//  ----------------------------------------------------------
	
}

?>