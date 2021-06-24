<?php

class IndexBuyer_model extends CI_Model
{
    public function updateUserBuyer($where, $data)
    {
        $this->db->where('email', $where);
        $this->db->update('user', $data);
    }

    //Data Banner
    public function data_banner()
    {
        $query = "SELECT * FROM data_banner ORDER BY data_banner.id ASC";
        return $this->db->query($query)->result_array();
    }

    //Data Penanaman
    public function data_penanaman()
    {
        $query = "SELECT * FROM data_penanaman ORDER BY data_penanaman.urutan ASC";
        return $this->db->query($query)->result_array();
    }

    //Data Penanaman
    public function data_perawatan()
    {
        $query = "SELECT * FROM data_perawatan ORDER BY data_perawatan.urutan ASC";
        return $this->db->query($query)->result_array();
    }

    //Data Tanaman
    public function data_tanaman()
    {
        $query = "SELECT * FROM data_tanaman ORDER BY data_tanaman.id ASC";
        return $this->db->query($query)->result_array();
    }

    //Data Cart
    public function data_cart($id)
    {
        $query = $this->db->where('id', $id)->limit(1)->get('data_tanaman');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return array();
        }
    }

    //Data Checkout
    public function data_checkout()
    {
        $query = "SELECT * FROM transaksi
                    JOIN detail_transaksi ON transaksi.id = detail_transaksi.transaksi_id GROUP BY transaksi.kode";
        return $this->db->query($query)->result_array();
    }

    //Batal System
    public function system_batal($id)
    {
        $query = "SELECT detail_transaksi.product_id, detail_transaksi.name, detail_transaksi.jumlah FROM detail_transaksi WHERE detail_transaksi.transaksi_id = $id";
        return $this->db->query($query)->result_array();
    }

    //Detail Transaksi
    public function detail_trans($id)
    {
        $query = "SELECT * FROM detail_transaksi WHERE detail_transaksi.transaksi_id = '$id' ORDER BY detail_transaksi.detail_id DESC";
        return $this->db->query($query)->result_array();
    }

    //Per Transaksi
    public function per_trans($id)
    {
        $query = "SELECT * FROM detail_transaksi
                    JOIN transaksi ON detail_transaksi.transaksi_id = transaksi.id WHERE detail_transaksi.detail_id = '$id'";
        return $this->db->query($query)->row_array();
    }

    //Upload Bukti Bayar
    public function upload_bukti($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('transaksi', $data);
    }

    //Data Seller Only
    public function seller_only($id)
    {
        $query = "SELECT * FROM user WHERE user.id = '$id'";
        return $this->db->query($query)->row_array();
    }





    // ------------------------ Camel Case typing -------------------------

    //Data All Produk
    public function getAllProduk()
    {
        return $this->db->get('data_tanaman')->result_array();
    }

    //Data Produk
    public function getProduk($limit, $start)
    {
        return $this->db->get('data_tanaman', $limit, $start)->result_array();
    }

    //count All Produk
    public function countAllProduk()
    {
        return $this->db->get('data_tanaman')->num_rows();
    }
}
