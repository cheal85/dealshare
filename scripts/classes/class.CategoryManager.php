<?php

class CategoryManager extends DataManager
{
	protected $select 	= "SELECT d.* ";
	protected $table	= "data_categories ";
	protected $from 	= "FROM data_categories d ";
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
	public function GetCategories($parent = false) {
		if($parent) {
			$where = " AND id_parent = '" . $parent . "' ";	
		}
		else {
			$where = " AND id_parent = 'root' ";
		}
		
		$q 			= "SELECT * FROM " . $this -> table . 
					" WHERE 1 " . $where . " ORDER BY title";
					
		return 		$GLOBALS['myDbManager'] -> SELECT($q);
	}
	//  ----------------------------------------------------------
	public function GetCategoriesAndParents($id) {
		$GLOBALS['myDbManager'] -> debug('get parents');

		$id = sanitize_db($id);
		$ret = array();
		$where = " WHERE id = '" . $id . "' ";
		
		$q 			= "SELECT id, id_parent FROM " . $this -> table . 
					$where . " ORDER BY id";
					//echo $q;
					
		if( $arr = $GLOBALS['myDbManager'] -> SELECT($q) ) {
			$ret[] = $arr[0]['id'];
			//  loop and format into string
			if($arr[0]['id_parent'] && ($arr[0]['id_parent'] != 'root')) {
				$cat_id = $this -> GetCategoriesAndParents($arr[0]['id_parent']);
				//
				if(is_array($cat_id)) array_push($ret, $cat_id[0]);
			}
		}
		return $ret;
	}
	//  ----------------------------------------------------------
	public function GetCategoriesAndSubs($id) {
		$id = sanitize_db($id);
		$where = " WHERE id = '" . $id . "' OR id_parent = '" . $id . "' ";
		
		$q 			= "SELECT id FROM " . $this -> table . 
					$where . " ORDER BY id";
					
		$arr = $GLOBALS['myDbManager'] -> SELECT($q);
		//  loop and format into string
		$string = "";
		for($i=0; $i<count($arr); $i++) {
			if($string != "") $string .= ", ";
			$string .= "'" . $arr[$i]['id'] . "'";
		}
		return $string;
	}
	//  ----------------------------------------------------------
	public function GetDealsFromInterface($string) {
		#$string = sanitize_db($string);
		$where = " WHERE id_category IN (" . $string . ") ";
		
		$q 			= "SELECT id_deal FROM interface_categories_deals " . 
					$where . " ORDER BY id";
					
		$arr = $GLOBALS['myDbManager'] -> SELECT($q);
		//  loop and format into string
		$string = "";
		for($i=0; $i<count($arr); $i++) {
			if($string != "") $string .= ", ";
			$string .= "'" . $arr[$i]['id_deal'] . "'";
		}
		return $string;
	}
	//  ----------------------------------------------------------
	//  SET FUNCTIONS
	//  ----------------------------------------------------------
	public function DisplayCategories($cats, $level, $parent = false) {
		//  array of category ids and parents
		$selected = $GLOBALS['myCategoryManager'] -> GetCategoriesAndParents($_GET['cat']);
		//  this list contains a selected category
		$cat_selected = false;
		$list = '';
		for($i=0; $i<count($cats); $i++) {
			$data = $cats[$i];
			
			if(($data['id_parent'] == $parent) || (!$parent && $data['id_parent'])) {
				$list .= '<li><p class="span-12" ><a id="cat-' . $data['url_safe'] . '" href="javascript:;" class="js-category category-button';
				if( in_array($data['id'], $selected) ) {
					$GLOBALS['breadcrumb_array'][] = $data['title'];
					$cat_selected = true;
					$list .= ' on selected';
				}
				$list .= '" rel="' . $data['id'] . '" >' . $data['title'] . '</a></p></li>';
				//
				if($categories = $this -> GetCategories($data['id'])) {
					$this -> DisplayCategories($categories, $level +1);	
				}
			}		
		}
		
		$GLOBALS['level_' . $level] .= '<div id="category-' . $cats[0]['id_parent'] . '" class="category-wrap" ';
		if($level > 0 AND !$cat_selected) $GLOBALS['level_' . $level] .= 'style="display:none" ';
		$GLOBALS['level_' . $level] .= '><ul>';
		//
		$GLOBALS['level_' . $level] .= $list;
		//
		$GLOBALS['level_' . $level] .= '</ul></div>';
		//
		return true;
	}
	
}

?>