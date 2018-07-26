<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/10/2018
 * Time: 2:42 PM
 */

class M_store extends MY_Model
{
    protected $_table_name  = 'store';
    protected $_timestamps  = TRUE;

    function get_list_store($where){
        return $this->db->query("SELECT 
							  `code`,`name`, IF(is_warehouse='1', 'Warehouse', 'Store') AS store  
							FROM
							  ".$this->_table_name."
							WHERE
								(name LIKE '%" .$where. "%' OR code LIKE '%" .$where. "%') AND is_active = 'checked'")->result();
    }

    function get_id($where){
        $data = explode(' | ', $where);
        $data_type = explode('/', $data[0]);
        $where = array("code" => $data_type[1], "name" => $data[1]);
        $data = $this->get_by($where, TRUE);
        return $data->id;
    }

    public function get($id = NULL, $single = FALSE)
    {
        $this->db->select('*, IF(is_warehouse=\'checked\', \'Warehouse\', \'Store\') AS store');
        return parent::get($id, $single); // TODO: Change the autogenerated stub
    }

}