<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['prov'] = $this->admin->getProvinsi();
        $data['notif'] = $this->admin->getNotif();

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
        $this->form_validation->set_rules('kotkab', 'Kota/Kabupaten', 'required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
        $this->form_validation->set_rules('desa', 'Desa', 'required');
        $this->form_validation->set_rules('isi', 'Isi', 'trim|required');
        $this->form_validation->set_rules('link', 'Link', 'trim|required');

        if ($this->form_validation->run() == false) {
            if (isset($_POST['submit'])) {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
			Pendaftaran gagal, coba lagi dalam 10 detik.
            </div>');
            }
            $data['title'] = 'Admin';
            $this->load->view('admin/dashboard', $data);
        } else {

            $data2 = array(
                'id_admin' => $_SESSION['id'],
                'provinsi' => $this->input->post('provinsi'),
                'kotkab' => $this->input->post('kotkab'),
                'kecamatan' => $this->input->post('kecamatan'),
                'desa' => $this->input->post('desa'),
                'isi' => $this->input->post('isi'),
                'link' => $this->input->post('link'),
                'date' => time()
            );

            if ($this->broadcast()) {
                $this->admin->addLog($data2);
            }
            $data['title'] = 'Admin';
            $this->load->view('admin/dashboard', $data);
            header("Refresh:0");
        }
    }


    private function _broadcastEmail($data)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'mykroshop.com@gmail.com',
            'smtp_pass' => 'myshop123',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'crlf' => "\r\n"
        ];
        $jum = 0;
        $temp = $this->admin->getEmail($data);
        if ($temp == null) {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
			Tidak ditemukan member di daerah tersebut.
            </div>');
            return false;
        }
        // var_dump($temp);
        // die;
        foreach ($temp as $val) {
            $this->email->initialize($config);
            $this->email->set_newline("\r\n");

            $this->email->from('HiPLN', 'no-reply [HiPLN]');
            $this->email->to($val['email']);

            $this->email->subject('Notification');
            $this->email->message($data['pesan'] . ', Lebih lengkap klik link berikut : <a href="' . $data['link'] . '">Detail</a>');

            if ($this->email->send()) {
                $jum++;
            } else {
                echo $this->email->print_debugger();
                die;
            }
        }
        if ($jum > 0) {
            $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
			Broadcast telah terkirim sebanyak : ' . $jum . ' notifikasi
            </div>');
            return true;
        }
    }

    public function broadcast()
    {
        $data['pesan'] = htmlspecialchars($this->input->post('isi'));
        $data['link'] = htmlspecialchars($this->input->post('link'));
        $data['provinsi'] = $this->input->post('provinsi');
        $data['kotkab'] = $this->input->post('kotkab');
        $data['kecamatan'] = $this->input->post('kecamatan');
        $data['desa'] = $this->input->post('desa');

        return $this->_broadcastEmail($data);
    }
}
