<?php

class CommentManager extends DataManager
{
	protected $select 	= "SELECT d.* ";
	protected $table	= "data_comments ";
	protected $from 	= "FROM data_comments d ";
	protected $where 	= "WHERE 1 ";
	protected $group 	= "";
	protected $order 	= "ORDER BY d.date_added DESC ";
	protected $limit 	= "";
	
	
    public function __construct()
    {
		#parent::__contruct();
    }
	//  ----------------------------------------------------------
	//  GET FUNCTIONS
	//  ----------------------------------------------------------
	public function GetEntries($page = 'all', $BROWSE_DATA)
	{
		$where = 'WHERE 1 ';
		if(($page != 'all') && ($BROWSE_DATA['count'] > 0))
		{
			$page = sanitize_db($page);
			$row  = ($page - 1) * $BROWSE_DATA['count'];
			//  Create limit for sql string
			$limit = 'LIMIT ' . $row . ', ' . $BROWSE_DATA['count'] . ' ';
		}
		/*if($BROWSE_DATA['id_user']) {
			$where .= " AND id_user = '" . $BROWSE_DATA['id_user'] . "' ";
		}*/
		$GLOBALS['myDbManager'] -> debug('deal ' . $BROWSE_DATA['id_deal']);
		if(isset($BROWSE_DATA['id_deal'])) {
			$where .= " AND id_deal = '" . sanitize_db($BROWSE_DATA['id_deal']) . "' ";
		}
		//  BUILD QUERY
		$q = 	$this -> select . 
				$this -> from . 
				(isset($where) ? $where : $this -> where) . 
				$this -> order .
				(isset($limit) ? $limit : '');
				#echo $q;
				$GLOBALS['myDbManager'] -> debug('query ' . $q);
		#$q = 'SELECT d.* FROM data_deals d WHERE 1 ORDER BY d.id DESC LIMIT 0, 20';
		//  EXECUTE QUERY	
		if($array = $GLOBALS['myDbManager'] -> SELECT($q)) {
			#if($limit && $array)$array['data_count'] = $GLOBALS['myPageManager'] -> paginate($q);
						
			return $array;	
		}
		else {
				$GLOBALS['myDbManager'] -> debug('query failed');
			return false;	
		}
	}
	//  ----------------------------------------------------------
	//  SET FUNCTIONS
	//  ----------------------------------------------------------
	
}

?>