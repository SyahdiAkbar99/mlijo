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
        $this->db->where('id', $where);
        $this->db->delete('user');
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

    //Data Penanaman
    public function data_penanaman()
    {
        $query = "SELECT * FROM data_penanaman ORDER BY data_penanaman.urutan ASC";
        return $this->db->query($query)->result_array();
    }
    public function insert_data_penanaman($data)
    {
        $this->db->insert('data_penanaman', $data);
    }
    public function update_data_penanaman($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('data_penanaman', $data);
    }
    public function delete_data_penanaman($where)
    {
        $this->db->where('id', $where);
        $this->db->delete('data_penanaman');
    }

    //Data Perawatan
    public function data_perawatan()
    {
        $query = "SELECT * FROM data_perawatan ORDER BY data_perawatan.urutan ASC";
        return $this->db->query($query)->result_array();
    }
    public function insert_data_perawatan($data)
    {
        $this->db->insert('data_perawatan', $data);
    }
    public function update_data_perawatan($where, $data)
    {
        $this->db->where('id', $where);
        $this->db->update('data_perawatan', $data);
    }
    public function delete_data_perawatan($where)
    {
        $this->db->where('id', $where);
        $this->db->delete('data_perawatan');
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
