<?php

class DashAdmin_model extends CI_Model
{
    //Data User
    public function getAllUser()
    {
        $query = "SELECT user.*,
                    (SELECT SUM(orders.harga) FROM orders WHERE user.id_user = orders.id_penjual) as pendp FROM user";
        return $this->db->query($query)->result_array();
    }
    public function statusUser($where, $data)
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
        $query = "SELECT SUM(orders.harga) AS saldo, waktu_input, orders.satuan
        FROM orders
          WHERE
            orders.id_penjual = $id
              HAVING COUNT(orders.harga)
              ORDER BY orders.waktu_input ASC";

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
                    JOIN ongkir ON product.id_ongkir = ongkir.id_ongkir
                    JOIN category ON product.id_category = category.id_category
                    JOIN jadwal ON product.id_jadwal = jadwal.id";
        return $this->db->query($query)->result_array();
    }



    //Data Riwayat Penjualan
    public function riwayat_transaksi()
    {
        $query = "SELECT * FROM orderdetails
                    JOIN orders ON orderdetails.id_order = orders.id_order
                    JOIN category ON orders.id_category = category.id_category
                    JOIN ongkir ON orders.id_ongkir = ongkir.id_ongkir
                    JOIN jadwal ON orders.id_jadwal = jadwal.id
                    GROUP BY orders.kode_transaksi";
        return $this->db->query($query)->result_array();
    }

    //Data ongkir
    public function shipping()
    {
        $query = "SELECT * FROM ongkir ORDER BY ongkir.id_ongkir DESC";
        return $this->db->query($query)->result_array();
    }

    //Data jadwal
    public function jadwals()
    {
        $query = "SELECT * FROM jadwal ORDER BY jadwal.id DESC";
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
        $query = "SELECT COUNT(orders.kode_transaksi) AS sumtran, DATE_FORMAT(orders.waktu_input, '%M %Y') AS bulan
        FROM orders
              
              GROUP BY MONTH(orders.waktu_input)
              HAVING COUNT(orders.kode_transaksi)
              ORDER BY orders.waktu_input ASC";

        $getOrderPerMonth = $this->db->query($query)->result_array();

        return $getOrderPerMonth;
    }

    //Transaksi Selesai
    public function getOrderFinish()
    {
        $query = "SELECT COUNT(orders.kode_transaksi) AS sumtran, DATE_FORMAT(orders.waktu_input, '%M %Y') AS bulan
         FROM orders
            WHERE orders.status = 3 
               GROUP BY MONTH(orders.waktu_input)
               HAVING COUNT(orders.kode_transaksi)
               ORDER BY orders.waktu_input ASC";

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
}
