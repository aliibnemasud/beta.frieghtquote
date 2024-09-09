<?php

class General_m extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function save_employee($data)
    {
        $this->db->insert("tbl_freight", $data);
        return $this->db->insert_id();
    }

    public function get_quote($id)
    {
        $sql = "SELECT `tf`.*, `wu`.`display_name`, `wu`.`user_email` FROM `tbl_freight` as `tf` LEFT JOIN `intercotrading_wp3`.`wp_users` as `wu` ON `wu`.`id` = `tf`.`user_id` WHERE `tf`.`id` = ?";
        $query = $this->db->query($sql, [$id]);
        return $query->result_array();
    }

    public function get_company($query)
    {
        $sql = "SELECT * FROM `tbl_company` WHERE `name` LIKE '%" . $query . "%'";
        $query = $this->db->query($sql);
        if ($query === false) {
            return [];
        }
        return $query->result_array();
    }

    public function save_company($name, $city, $state, $zip_code)
    {
        $sql = "INSERT INTO `tbl_company`(`name`, `city`, `state`, `zip_code`) VALUES(?, ?, ?, ?)";
        $query = $this->db->query($sql, [$name, $city, $state, $zip_code]);
        return "success";
    }

    public function get_mcc_name($id)
    {
        $sql = "SELECT `display_name`, `user_email` FROM `intercotrading_wp3`.`wp_users` WHERE `id` = ?";
        $query = $this->db->query($sql, [$id]);
        return $query->result_array();
    }

    public function save_carrier($data)
    {
        $this->db->insert("tbl_carrier", $data);
        return "success";
    }

    public function get_carrier()
    {
        $sql = "SELECT * FROM `tbl_carrier` ORDER BY `carrier_name` ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function update_mcc($id, $carrier, $rate, $mcc_date, $mcc_user, $note)
    {
        $sql = "UPDATE `tbl_freight` SET `rate` = ?, `carrier` = ?, `mcc_user` = ?, `mcc_date` = ?, `note` = ? WHERE `id` = ?";
        $query = $this->db->query($sql, [$rate, $carrier, $mcc_user, $mcc_date, $note, $id]);

        $sql = "SELECT `tf`.*, `wu`.`display_name`, `wu`.`user_email`, `tc`.`carrier_name` FROM `tbl_freight` as `tf` LEFT JOIN `intercotrading_wp3`.`wp_users` as `wu` ON `wu`.`id` = `tf`.`user_id` LEFT JOIN `tbl_carrier` as `tc` ON `tc`.`id` = `tf`.`carrier` WHERE `tf`.`id` = ?";
        $query = $this->db->query($sql, [$id]);
        $result = $query->result_array();
        $sender = array();
        foreach ($result as $res) {
            $data = array();
            $data['id'] = $res['id'];
            $data['trader_date'] = $res['trader_date'];
            $data['trader'] = $res['display_name'];
            $data['trader_email'] = $res['user_email'];
            $data['origin_company'] = $res['origin_company'];
            $data['origin_city'] = $res['origin_city'];
            $data['origin_state'] = $res['origin_state'];
            $data['origin_country'] = $res['origin_country'];
            $data['origin_zip_code'] = $res['origin_zip_code'];
            $data['dest_company'] = $res['dest_company'];
            $data['dest_city'] = $res['dest_city'];
            $data['dest_state'] = $res['dest_state'];
            $data['dest_country'] = $res['dest_country'];
            $data['dest_zip_code'] = $res['dest_zip_code'];
            $data['van_dump'] = $res['van_dump'];
            $data['pallet'] = $res['pallet'];
            $data['weight'] = $res['weight'];
            $data['commodity'] = $res['commodity'];
            $data['carrier_name'] = $res['carrier_name'];
            $data['rate'] = $res['rate'];
            $data['note'] = $res['note'];
            $data['mcc_date'] = $res['mcc_date'];
            array_push($sender, $data);
        }
        $sql = "SELECT `wu`.`display_name`, `wu`.`user_email`, `tc`.`carrier_name` FROM `tbl_freight` as `tf` LEFT JOIN `intercotrading_wp3`.`wp_users` as `wu` ON `wu`.`id` = `tf`.`mcc_user` LEFT JOIN `tbl_carrier` as `tc` ON `tc`.`id` = `tf`.`carrier` WHERE `tf`.`id` = ?";
        $query = $this->db->query($sql, [$id]);
        $result = $query->result_array();
        $sender[0]['mcc_user'] = $result[0]['display_name'];
        return $sender;
    }

    public function update_sharing_link($id, $link)
    {
        $sql = "UPDATE `tbl_freight` SET `link` = ? WHERE `id` = ?";
        $query = $this->db->query($sql, [$link, $id]);
        return "success";
    }

    public function get_eod_email()
    {
        $date = date("Y-m-d 09:00:00");
        $yesterday = date("Y-m-d 09:00:00", strtotime("-1 days"));
        $sql = "SELECT `tf`.*, `wu`.`display_name`, `wu`.`user_email`, `tc`.`carrier_name` FROM `tbl_freight` as `tf` LEFT JOIN `intercotrading_wp3`.`wp_users` as `wu` ON `wu`.`id` = `tf`.`user_id` LEFT JOIN `tbl_carrier` as `tc` ON `tc`.`id` = `tf`.`carrier` WHERE `tf`.`mcc_date` >= ? AND `tf`.`mcc_date` < ?";
        $query = $this->db->query($sql, [$yesterday, $date]);
        $result = $query->result_array();
        $sender = array();
        foreach ($result as $res) {
            $data = array();
            $data['id'] = $res['id'];
            $data['trader_date'] = $res['trader_date'];
            $data['trader'] = $res['display_name'];
            $data['trader_email'] = $res['user_email'];
            $data['origin_company'] = $res['origin_company'];
            $data['origin_city'] = $res['origin_city'];
            $data['origin_state'] = $res['origin_state'];
            $data['origin_country'] = $res['origin_country'];
            $data['origin_zip_code'] = $res['origin_zip_code'];
            $data['dest_company'] = $res['dest_company'];
            $data['dest_city'] = $res['dest_city'];
            $data['dest_state'] = $res['dest_state'];
            $data['dest_country'] = $res['dest_country'];
            $data['dest_zip_code'] = $res['dest_zip_code'];
            $data['van_dump'] = $res['van_dump'];
            $data['pallet'] = $res['pallet'];
            $data['weight'] = $res['weight'];
            $data['commodity'] = $res['commodity'];
            $data['carrier_name'] = $res['carrier_name'];
            $data['rate'] = $res['rate'];
            $data['note'] = $res['note'];
            $data['mcc_date'] = $res['mcc_date'];
            $data['link'] = $res['link'];
            array_push($sender, $data);
        }
        $sql = "SELECT `wu`.`display_name`, `wu`.`user_email`, `tc`.`carrier_name` FROM `tbl_freight` as `tf` LEFT JOIN `intercotrading_wp3`.`wp_users` as `wu` ON `wu`.`id` = `tf`.`mcc_user` LEFT JOIN `tbl_carrier` as `tc` ON `tc`.`id` = `tf`.`carrier` WHERE `tf`.`mcc_date` >= ? AND `tf`.`mcc_date` < ?";
        $query = $this->db->query($sql, [$yesterday, $date]);
        $result = $query->result_array();
        $sender[0]['mcc_user'] = $result[0]['display_name'];
        return $sender;
    }

    public function save_staff($data)
    {
        $this->db->insert("tbl_staff", $data);
        return "success";
    }

    public function get_staff()
    {
        $query = $this->db->get('tbl_staff');
        return $query->result_array();
    }

    public function update_staff($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_staff', $data);
        return "success";
    }

    public function delete_staff($id)
    {
        $sql = "DELETE FROM `tbl_staff` WHERE `id` = ?";
        $query = $this->db->query($sql, [$id]);
        return "success";
    }
}
