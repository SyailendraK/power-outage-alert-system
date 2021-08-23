<?php
defined('BASEPATH') or exit('No direct script access 0lowed');
//deskripsi : pengaksesan setiap data lewat query untuk h0aman admin

class Admin_model extends CI_Model
{

    public function getProvinsi()
    {
        $query = 'SELECT * FROM provinces';
        return $this->db->query($query)->result_array();
    }

    public function getNotif()
    {
        $hasil = [];
        $query0 = "SELECT id,provinsi,kotkab,kecamatan,desa FROM notif";
        $result = $this->db->query($query0)->result_array();

        foreach ($result as $v0) {
            $prov = $v0['provinsi'];
            $kotkab = $v0['kotkab'];
            $kec = $v0['kecamatan'];
            $desa = $v0['desa'];
            $id = $v0['id'];

            $query = "SELECT admin.username AS name, n.isi AS isi, n.date AS date, p.name AS provinsi, r.name AS kotkab, d.name AS kecamatan, v.name AS desa, n.link AS link
        FROM notif AS n
        JOIN (SELECT * FROM provinces WHERE id='$prov') AS p ON n.provinsi=p.id
        JOIN (SELECT * FROM regencies WHERE id='$kotkab') AS r ON n.kotkab=r.id
        JOIN (SELECT * FROM districts WHERE id='$kec') AS d ON n.kecamatan=d.id
        JOIN (SELECT * FROM villages WHERE id='$desa') AS v ON n.desa=v.id
        JOIN admin ON n.id_admin=admin.id
        WHERE n.id=$id";

            array_push($hasil, $this->db->query($query)->result_array()[0]);
        }
        // var_dump($hasil);
        // die;
        return array_reverse($hasil);
    }

    public function getEmail($data)
    {

        // var_dump($data);
        // die;
        if ($data['provinsi'] == '0' && $data['kotkab'] == '0' && $data['kecamatan'] == '0' && $data['desa'] == '0') { //semua
            $this->db->select('email');
            $array = array('active !=' => 0);
            $this->db->where($array);
            return $this->db->get('member')->result_array();
        } else if ($data['provinsi'] != '0' && $data['kotkab'] != '0' && $data['kecamatan'] != '0' && $data['desa'] != '0') { // full spesifik 
            $this->db->select('email');
            $array = array('active !=' => 0, 'provinsi' => $data['provinsi'], 'kotkab' => $data['kotkab'], 'kecamatan' => $data['kecamatan'], 'desa' => $data['desa']);
            $this->db->where($array);
            return $this->db->get('member')->result_array();
        } else if ($data['provinsi'] != '0' && $data['kotkab'] != '0' && $data['kecamatan'] != '0' && $data['desa'] == '0') { // semua desa
            $this->db->select('email');
            $array = array('active !=' => 0, 'provinsi' => $data['provinsi'], 'kotkab' => $data['kotkab'], 'kecamatan' => $data['kecamatan']);
            $this->db->where($array);
            return $this->db->get('member')->result_array();
        } else if ($data['provinsi'] != '0' && $data['kotkab'] != '0' && $data['kecamatan'] == '0' && $data['desa'] == '0') { // semua kecamatan
            $this->db->select('email');
            $array = array('active !=' => 0, 'provinsi' => $data['provinsi'], 'kotkab' => $data['kotkab']);
            $this->db->where($array);
            return $this->db->get('member')->result_array();
        } else if ($data['provinsi'] != '0' && $data['kotkab'] == '0' && $data['kecamatan'] == '0' && $data['desa'] == '0') { // semua kota/kabupaten
            $this->db->select('email');
            $array = array('active !=' => 0, 'provinsi' => $data['provinsi']);
            $this->db->where($array);
            return $this->db->get('member')->result_array();
        } else {
            return null;
        }
    }

    public function cekLogin($data)
    {
        $this->db->select('id');
        $array = array('username' => $data['username'], 'password' => $data['password']);
        $this->db->where($array);
        return $this->db->get('admin')->result_array();
    }

    public function addLog($data)
    {
        //     $data = array(
        //         'id_admin' => $data['id_admin'],
        //         'provinsi' => $data['provinsi'],
        //         'kotkab' => $data['kotkab'],
        //         'kecamatan' => $data['kecamatan'],
        //         'desa' => $data['desa'],
        //         'isi' => $data['isi'],
        //         'link' => $data['link'],
        //         'date' => time();
        // );

        return $this->db->insert('notif', $data);
    }
}
