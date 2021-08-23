<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{

    public function getProvinsi()
    {
        $query = 'SELECT * FROM provinces';
        return $this->db->query($query)->result_array();
    }

    public function addMember($data)
    {
        $this->db->insert('member', $data);
    }

    public function getMember($email)
    {
        $query = 'SELECT * FROM member WHERE email="' . $email . '"';
        $temp = $this->db->query($query)->result_array()[0];
        $query1 = 'SELECT * FROM provinces WHERE id="' . $temp['provinsi'] . '"';
        $query2 = 'SELECT * FROM regencies WHERE id="' . $temp['kotkab'] . '"';
        $query3 = 'SELECT * FROM districts WHERE id="' . $temp['kecamatan'] . '"';
        $query4 = 'SELECT * FROM villages WHERE id="' . $temp['desa'] . '"';
        $gab = [];
        $gab['nama'] = $temp['nama'];
        $gab['email'] = $temp['email'];
        $gab['provinsi'] = $this->db->query($query1)->result_array()[0];
        $gab['kotkab'] = $this->db->query($query2)->result_array()[0];
        $gab['kecamatan'] = $this->db->query($query3)->result_array()[0];
        $gab['desa'] = $this->db->query($query4)->result_array()[0];
        $gab['alamat'] = $temp['alamat'];
        return $gab;
    }

    public function updateMember($email)
    {
        $query = 'UPDATE member SET nama = "' . $email['nama'] . '", email = "' . $email['email'] . '", provinsi = "' . $email['provinsi'] . '",  kotkab = "' . $email['kotkab'] . '",  kecamatan = "' . $email['kecamatan'] . '",  desa = "' . $email['desa'] . '",  alamat = "' . $email['alamat'] . '" WHERE email="' . $email['email'] . '"';
        if ($this->db->query($query)) {
            $this->db->delete('user_token', ['email' => $email['email']]);

            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
					    Update akun berhasil.
					</div>');
            redirect('Home');
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
					    Update akun gagal.
					</div>');
            header("Refresh:0");
        }
    }
}
