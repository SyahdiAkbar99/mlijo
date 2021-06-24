<?php

class DashSeller_model extends CI_Model
{
    //Only User Seller
    public function updateUserSeller($where, $data)
    {
        $this->db->where('email', $where);
        $this->db->update('user', $data);
    }

    //Data Tanaman
    public function product()
    {
        $query = "SELECT * FROM product";
        return $this->db->query($query)->result_array();
    }
    public function insert_product($data)
    {
        $this->db->insert('product', $data);
    }
    public function update_product($where, $datas)
    {
        $this->db->where('id_product', $where);
        $this->db->update('product', $datas);
    }

    //Data Riwayat Penjualan
    public function riwayat_penjualan($id)
    {
        $query = "SELECT * FROM detail_transaksi
                    JOIN transaksi ON detail_transaksi.transaksi_id = transaksi.id WHERE detail_transaksi.seller_id = $id";
        return $this->db->query($query)->result_array();
    }
}
