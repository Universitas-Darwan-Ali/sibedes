<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kendaraan_model  extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('kendaraan');
    }

    public function getKendaraan()
    {
        $query = "SELECT `kendaraan`.*, `kode_kendaraan`.`nama_brg`,`kode_kendaraan`.`kode_barang_kendaraan`
        FROM `kendaraan` JOIN `kode_kendaraan`
        ON `kendaraan`.`kode_kendaraan_id` = `kode_kendaraan`.`kode_kendaraan_id`
        WHERE `kendaraan`. `del` = 1
        ";
        return $this->db->query($query)->result_array();
    }

    public function getKendaraanLog()
    {
        $query = "SELECT `kendaraan`.*, `kode_kendaraan`.`nama_brg`,`kode_kendaraan`.`kode_barang_kendaraan`,`kendaraan_log`.*
        FROM `kendaraan` JOIN `kode_kendaraan`
        ON `kendaraan`.`kode_kendaraan_id` = `kode_kendaraan`.`kode_kendaraan_id`
        JOIN `kendaraan_log`
        ON `kendaraan`.`kendaraan_id` = `kendaraan_log`.`kendaraan_id`
        ";
        return $this->db->query($query)->result_array();
    }
}
