<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bangunan_model  extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('bangunan');
    }

    public function getBangunan()
    {
        $query = "SELECT `bangunan`.*, `kode_bangunan`.`jns_bangun`,`kode_bangunan`.`kode_barang_bangunan`
        FROM `bangunan` JOIN `kode_bangunan`
        ON `bangunan`.`kode_bangunan_id` = `kode_bangunan`.`kode_bangunan_id`
        WHERE `bangunan`. `del` = 1
        ";
        return $this->db->query($query)->result_array();
    }

    public function getBangunanLog()
    {
        $query = "SELECT `bangunan`.*, `kode_bangunan`.`jns_bangun`,`kode_bangunan`.`kode_barang_bangunan`,`bangunan_log`.*
        FROM `bangunan` JOIN `kode_bangunan`
        ON `bangunan`.`kode_bangunan_id` = `kode_bangunan`.`kode_bangunan_id`
        JOIN `bangunan_log`
        ON `bangunan`.`bangunan_id` = `bangunan_log`.`bangunan_id`
        ";
        return $this->db->query($query)->result_array();
    }
}
