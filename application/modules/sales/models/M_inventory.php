<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/5/2018
 * Time: 8:18 PM
 */

class M_inventory extends MY_Model
{
    protected $_table_name  = 'inventory';
    protected $_timestamps  = TRUE;

    public function get($id = NULL, $single = FALSE)
    {
        $table1_join = 'product';
        $field1_join = 'inventory.product_id = product.id';

        $this->db->select(" " . $this->_table_name . ".id,
                            " . $this->_table_name . ".barcode,
                            " . $this->_table_name . ".created,
                            " . $this->_table_name . ".modified,
                            sale1,
                            sale2,
                            sale3,
                            cost1,
                            cost2,
                            cost_supplier,
                            cost_distributor,
                            qty1,
                            qty2,
                            qty3,
                            qty4,
                            qty_limit,
                            location,
                            " . $this->_table_name . ".is_active,
                            " . $table1_join . ".`name`,
                            " . $table1_join . ".description,
                            " . $table1_join . ".path,
                            " . $table1_join . ".barcode ");
        $this->db->join($table1_join, $field1_join, 'INNER');

        return parent::get($id, $single); // TODO: Change the autogenerated stub
    }
}