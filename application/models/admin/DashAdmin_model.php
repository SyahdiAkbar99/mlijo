<?php

class DashAdmin_model extends CI_Model
{
    //Data User
    public function getAllUser()
    {
        $query = "SELECT user.*,
                    (SELECT SUM(orderdetails.harga_pesan) FROM orderdetails 
                    WHERE orderdetails.id_user = user.id_user) as pendp FROM user";
        return $this->db->query($query)->result_array();

        // $query = "SELECT *,
        // (SELECT SUM(orderdetails.harga_pesan) FROM orderdetails 
        // WHERE orders.id_user = user.id_user) as pendp FROM orderdetails
        // JOIN orders ON orderdetails.id_order = orders.id_order
        // JOIN product ON orderdetails.id_product = product.id_product
        // JOIN jam_antar ON orders.id_jamantar = jam_antar.id
        // JOIN ongkir ON product.id_lokasi = ongkir.id_ongkir
        // JOIN user ON orders.id_user = user.id_user GROUP BY user.id_user";

        // $query = "SELECT user.*,
        //             (SELECT SUM(orders.harga) FROM orders WHERE user.id_user = orders.id_penjual) as pendp FROM user";
        // return $this->db->query($query)->result_array();
    }
    public function prosesUser($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('user', $data);
    }
    public function deleteUser($where)
    {
        $this->db->where('id_user', $where);
        $this->db->delete('user');
    }
    public function count_user()
    {
        $query = "SELECT COUNT(user.id_akses) AS penjual, date_created, user.level
        FROM user
          WHERE
            user.id_akses != 1
              HAVING COUNT(user.id_akses)
              ORDER BY user.date_created ASC";

        $countUser = $this->db->query($query)->result_array();

        return $countUser;
    }
    public function saldo_user($id)
    {
        $query = "SELECT SUM(orderdetails.harga_pesan) AS saldo, orders.waktu_transaksi, orderdetails.satuan
        FROM orderdetails
        JOIN orders ON orderdetails.id_order = orders.id_order
          WHERE
            orderdetails.id_user = $id
              HAVING COUNT(orderdetails.harga_pesan)
              ORDER BY orders.waktu_transaksi ASC";

        $countUser = $this->db->query($query)->result_array();

        return $countUser;
    }




    //Data Banner
    public function data_banner()
    {
        $query = "SELECT * FROM data_banner ORDER BY data_banner.id ASC";
        return $this->db->query($query)->result_array();
    }
    public function insert_data_banner($data)
    {
        $this->db->insert('data_banner', $data);
    }
    public function update_data_banner($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('data_banner', $data);
    }
    public function delete_data_banner($where)
    {
        $this->db->where('id', $where);
        $this->db->delete('data_banner');
    }


    //Only Profile User Admin
    public function updateUserAdmin($where, $data)
    {
        $this->db->where('email', $where);
        $this->db->update('user', $data);
    }

    //Data Tanaman
    public function product()
    {
        $query = "SELECT * FROM product
                    JOIN ongkir ON product.id_lokasi = ongkir.id_ongkir
                    JOIN category ON product.id_category = category.id_category";
        return $this->db->query($query)->result_array();
    }



    //Data Riwayat Penjualan
    public function riwayat_transaksi()
    {
        $query = "SELECT * FROM orderdetails
                    JOIN orders ON orderdetails.id_order = orders.id_order
                    JOIN product ON orderdetails.id_product = product.id_product
                    JOIN jadwal_po ON orders.id_jamantar = jadwal_po.id
                    JOIN user ON orderdetails.id_user = user.id_user
                    JOIN ongkir ON product.id_lokasi = ongkir.id_ongkir
                    GROUP BY orders.kode_transaksi";
        return $this->db->query($query)->result_array();
    }

    //Data ongkir
    public function shipping()
    {
        $query = "SELECT * FROM ongkir GROUP BY ongkir.tempat_kirim DESC";
        return $this->db->query($query)->result_array();
    }

    //Data jadwal
    public function jadwals()
    {
        $query = "SELECT * FROM jadwal_po
                    JOIN product ON jadwal_po.id_product = product.id_product
                    ORDER BY jadwal_po.id DESC";
        return $this->db->query($query)->result_array();
    }
    public function only_product()
    {
        $query = "SELECT * FROM product ORDER BY product.id_product DESC";
        return $this->db->query($query)->result_array();
    }

    //Data Kategori
    public function category()
    {
        $query = "SELECT * FROM category ORDER BY category.id_category DESC";
        return $this->db->query($query)->result_array();
    }

    //Transaksi keseluruhan
    public function getOrderMonthly()
    {
        $query = "SELECT COUNT(orders.kode_transaksi) AS sumtran, DATE_FORMAT(orders.waktu_transaksi, '%M %Y') AS bulan
        FROM orders
              
              GROUP BY MONTH(orders.waktu_transaksi)
              HAVING COUNT(orders.kode_transaksi)
              ORDER BY orders.waktu_transaksi ASC";

        $getOrderPerMonth = $this->db->query($query)->result_array();

        return $getOrderPerMonth;
    }

    //Transaksi Selesai
    public function getOrderFinish()
    {
        $query = "SELECT COUNT(orders.kode_transaksi) AS sumtran, DATE_FORMAT(orders.waktu_transaksi, '%M %Y') AS bulan
         FROM orders
            WHERE orders.proses = 3 
               GROUP BY MONTH(orders.waktu_transaksi)
               HAVING COUNT(orders.kode_transaksi)
               ORDER BY orders.waktu_transaksi ASC";

        $getOrderFinish = $this->db->query($query)->result_array();

        return $getOrderFinish;
    }

    //Transaksi Selesai
    public function getOrderOngkir()
    {
        $query = "SELECT COUNT(ongkir.tempat_kirim) AS sumrim
           FROM ongkir
                 GROUP BY MONTH(ongkir.id_ongkir)
                 HAVING COUNT(ongkir.id_ongkir)
                 ORDER BY ongkir.id_ongkir ASC";

        $getOrderOngkir = $this->db->query($query)->result_array();

        return $getOrderOngkir;
    }

    //Transaksi Selesai
    public function getLokasiUser()
    {
        $query = "SELECT COUNT(user.alamat) AS sumrim
            FROM user
            WHERE user.id_akses = 2
                  GROUP BY MONTH(user.id_user)
                  HAVING COUNT(user.id_user)
                  ORDER BY user.id_user ASC";

        $getLokasi = $this->db->query($query)->result_array();

        return $getLokasi;
    }
}
