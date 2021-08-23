<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/index');
        } else {
            $data['username'] = htmlspecialchars($this->input->post('username'));
            $data['password'] = $this->input->post('password');

            $cek = $this->admin->cekLogin($data);
            if ($cek == null) {
                $this->load->view('admin/index');
            } else {
                $this->session->set_userdata('id', $cek[0]['id']);
                redirect('Admin');
            }
        }
    }

    public function logout()
    {
        $_SESSION = null;
        session_destroy();
        redirect('Auth');
    }

    public function verify()
    {

        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('member', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 30)) {
                    $this->db->set("active", 1);
                    $this->db->where('email', $email);
                    $this->db->update('member');
                    $this->db->delete('user_token', ['email' => $email]);
                    $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
					    Akun ' . $email . ' telah di aktivasi, terimakasih.
					</div>');
                    redirect('Home');
                } else {
                    $this->db->delete('member', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
					    Aktivasi akun gagal, token expired.
					</div>');
                    redirect('Home');
                }
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
			    Aktivasi akun gagal, wrong token.
			</div>');
                redirect('Home');
            }
        } else {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            Aktivasi akun gagal, wrong email
			</div>');
            redirect('Home');
        }
    }
}
