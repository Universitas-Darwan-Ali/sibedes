<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tanah_model  extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('tanah');
    }

    public function getTanah()
    {
        $query = "SELECT `tanah`.*, `kode_tanah`.`jns_tanah`,`kode_tanah`.`kode_barang_tanah`
        FROM `tanah` JOIN `kode_tanah`
        ON `tanah`.`kode_tanah_id` = `kode_tanah`.`kode_tanah_id`
        WHERE `tanah`. `del` = 1
        ";
        return $this->db->query($query)->result_array();
    }

    public function getTanahLog()
    {
        $query = "SELECT `tanah`.*, `kode_tanah`.`jns_tanah`,`kode_tanah`.`kode_barang_tanah`,`tanah_log`.*
        FROM `tanah` JOIN `kode_tanah`
        ON `tanah`.`kode_tanah_id` = `kode_tanah`.`kode_tanah_id`
        JOIN `tanah_log`
        ON `tanah`.`tanah_id` = `tanah_log`.`tanah_id`
        ";
        return $this->db->query($query)->result_array();
    }
}
