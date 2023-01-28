<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peralatan_model  extends CI_Model
{
    public function tampil_data()
    {
        return $this->db->get('peralatan');
    }

    public function getPeralatan()
    {
        $query = "SELECT `peralatan`.*, `kode_peralatan`.`nama_brg`,`kode_peralatan`.`kode_barang_peralatan`
        FROM `peralatan` JOIN `kode_peralatan`
        ON `peralatan`.`kode_peralatan_id` = `kode_peralatan`.`kode_peralatan_id`
        WHERE `peralatan`. `del` = 1
        ";
        return $this->db->query($query)->result_array();
    }

    public function getPeralatanLog()
    {
        $query = "SELECT `peralatan`.*, `kode_peralatan`.`nama_brg`,`kode_peralatan`.`kode_barang_peralatan`,`peralatan_log`.*
        FROM `peralatan` JOIN `kode_peralatan`
        ON `peralatan`.`kode_peralatan_id` = `kode_peralatan`.`kode_peralatan_id`
        JOIN `peralatan_log`
        ON `peralatan`.`peralatan_id` = `peralatan_log`.`peralatan_id`
        ";
        return $this->db->query($query)->result_array();
    }
}
