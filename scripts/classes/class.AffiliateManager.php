<?php

class AffiliateManager extends DataManager
{
	protected $select 	= "SELECT d.* ";
	protected $table	= "data_affiliates ";
	protected $from 	= "FROM data_affiliates d ";
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
}

?>