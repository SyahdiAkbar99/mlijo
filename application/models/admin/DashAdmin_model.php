<?php

class DashAdmin_model extends CI_Model
{
    //Data User
    public function getAllUser()
    {
        $query = "SELECT * FROM user ORDER BY user.id_user ASC";
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



    //Data Riwayat Penjualan
    public function riwayat_transaksi()
    {
        $query = "SELECT * FROM orderdetails
                    JOIN orders ON orderdetails.id_order = orders.id_order";
        return $this->db->query($query)->result_array();
    }

    //Data ongkir
    public function shipping()
    {
        $query = "SELECT * FROM ongkir ORDER BY ongkir.id_ongkir DESC";
        return $this->db->query($query)->result_array();
    }
}
