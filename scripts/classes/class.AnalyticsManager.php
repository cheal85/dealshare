<?php

class AnalyticsManager extends DataManager
{
	protected $select 	= "SELECT d.* ";
	protected $table	= "data_analytics ";
	protected $from 	= "FROM data_analytics d ";
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
	//  ----------------------------------------------------------


	//  ----------------------------------------------------------
	//  SET FUNCTIONS
	//  ----------------------------------------------------------
	
}

?>