<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/17/2018
 * Time: 1:28 AM
 */

class M_logis_in extends MY_Model
{
    protected $_table_name = 'n_stock_order';
    protected $_timestamps = TRUE;

    public function get($id = NULL, $single = FALSE)
    {
        $this->db->select(" *, 
                            n_stock_order.id AS id,
                            n_stock_order.status AS sts,
                            n_stock_order.code AS so_code,
                            n_stock_order.created AS created,
                            n_stock_order.modified AS modified,
                            from.`name` AS fname,
                            destination.`name` AS dname,
                            efrom.`name` AS fename,
                            edestination.`name` AS dename,
                            supplier.name AS supplier,
                            (SELECT SUM(supply_price) FROM `n_stock_order_detail` WHERE stock_order_id = n_stock_order.id) AS sum_sp ,
                            (SELECT SUM( request_qty ) FROM `n_stock_order_detail` WHERE stock_order_id = n_stock_order.id) AS sum_rq ,
                            (SELECT SUM( send_qty ) FROM `n_stock_order_detail` WHERE stock_order_id = n_stock_order.id) AS sum_sq ,
                            (SELECT SUM( received_qty ) FROM `n_stock_order_detail` WHERE stock_order_id = n_stock_order.id) AS sum_rc 
                            ");
        $this->db->join("supplier AS `supplier`", "supplier.id = n_stock_order.order_id_supplier", "LEFT OUTER");
        $this->db->join("n_store AS `from`", "n_stock_order.from_place = `from`.id", "LEFT OUTER");
        $this->db->join("n_store AS `destination`", "n_stock_order.destination = destination.id", "LEFT OUTER");
        $this->db->join("n_employee AS efrom", "efrom.id = n_stock_order.user_request", "LEFT OUTER");
        $this->db->join("n_employee AS edestination", "edestination.id = n_stock_order.user_approve", "LEFT OUTER");
        return parent::get($id, $single); // TODO: Change the autogenerated stub
    }

}