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
    public function product($id)
    {
        $query = "SELECT * FROM product
                    JOIN ongkir ON product.id_ongkir = ongkir.id_ongkir
                    JOIN category ON product.id_category = category.id_category
                    JOIN jadwal ON product.id_jadwal = jadwal.id
                    WHERE product.id_user = $id";
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

    //Data barang keluar
    public function barang_keluar($id)
    {
        $query = "SELECT barang_keluar.stok, barang_keluar.id, barang_keluar.id_product, barang_keluar.nama_produk, barang_keluar.berat, barang_keluar.gambar, barang_keluar.tanggal, product.id_user FROM barang_keluar
                    JOIN product ON product.id_product = barang_keluar.id_product
                    WHERE product.id_user = $id
                    ORDER BY barang_keluar.id DESC";
        return $this->db->query($query)->result_array();
    }

    //Transaksi keseluruhan
    public function getOrderMonthly($id)
    {
        $query = "SELECT COUNT(orders.kode_transaksi) AS sumtran, DATE_FORMAT(orders.waktu_input, '%M %Y') AS bulan
         FROM orders
               WHERE orders.id_penjual = $id
               GROUP BY MONTH(orders.waktu_input)
               HAVING COUNT(orders.kode_transaksi)
               ORDER BY orders.waktu_input ASC";

        $getOrderPerMonth = $this->db->query($query)->result_array();

        return $getOrderPerMonth;
    }

    //Transaksi Selesai
    public function getOrderFinish($id)
    {
        $query = "SELECT COUNT(orders.kode_transaksi) AS sumtran, DATE_FORMAT(orders.waktu_input, '%M %Y') AS bulan
          FROM orders
             WHERE orders.status = 3 AND orders.id_penjual = $id
                GROUP BY MONTH(orders.waktu_input)
                HAVING COUNT(orders.kode_transaksi)
                ORDER BY orders.waktu_input ASC";

        $getOrderFinish = $this->db->query($query)->result_array();

        return $getOrderFinish;
    }

    //Data Riwayat Penjualan
    public function riwayat_transaksi($id)
    {
        $query = "SELECT * FROM orderdetails
                    JOIN orders ON orderdetails.id_order = orders.id_order
                    JOIN category ON orders.id_category = category.id_category
                    JOIN ongkir ON orders.id_ongkir = ongkir.id_ongkir
                    JOIN jadwal ON orders.id_jadwal = jadwal.id
                    WHERE orders.id_penjual = $id
                    GROUP BY orders.kode_transaksi";
        return $this->db->query($query)->result_array();
    }
}
