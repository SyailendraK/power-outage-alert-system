<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Home_model', 'indo');
        $this->load->model('user_token_model', 'token');
    }

    public function Index()
    {
        $data['provinsi'] = $this->indo->getProvinsi();

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[member.email]');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('number', 'No telp', 'trim|required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('kotkab', 'Kota/Kabupaten', 'trim|required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        if ($this->form_validation->run() == false && $this->input->post('check') != 1) {
            // $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            // Pendaftaran gagal, coba lagi dalam 10 detik.
            // </div>');
            $data['title'] = 'HiPLN';
            $this->load->view('home/index', $data);
        } else {
            $this->addMember();

            $data['title'] = 'HiPLN';
            $this->load->view('home/index', $data);
        }
    }

    public function save()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[member.email]');
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('number', 'No telp', 'trim|required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'trim|required');
        $this->form_validation->set_rules('kotkab', 'Kota/Kabupaten', 'trim|required');
        $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');

        if ($this->form_validation->run() == false && $this->input->post('check') != 1) {
            $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
            Pendaftaran gagal, coba lagi.
            </div>');
            echo '<p><a href="javascript: history.back()">Go Back</a></p>';
            //header("Refresh:0");
        } else {

            $data['email'] = htmlspecialchars($this->input->post('email'));
            $data['nama'] = htmlspecialchars($this->input->post('nama'));
            $data['provinsi'] = $this->input->post('provinsi');
            $data['kotkab'] = $this->input->post('kotkab');
            $data['kecamatan'] = $this->input->post('kecamatan');
            $data['desa'] = $this->input->post('desa');
            $data['alamat'] = htmlspecialchars($this->input->post('alamat'));

            $this->indo->updateMember($data);
        }
    }

    public function update()
    {
        if ($this->input->post('emailup') == null) {
            redirect('home');
        }

        $token = str_replace(array('\'', '"', ',', ';', '<', '>', '=', '|', '/', '+', '-', '&', '^', '$', '#', '@', '!', '~', '`', '_', '(', ')'), '', base64_encode(random_bytes(32)));
        $data['token'] = $token;
        $data['email'] = $this->input->post('emailup');
        $data['isi'] = 'Click this link to update your account information';
        $data['update'] = true;
        $data['date_created'] = time();
        $this->token->addUserToken($data);
        $this->_sendEmail($data);
        $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
            Kami telah mengirimkan link update ke email anda, harap mengupdate dalam 1x24 jam</div>');
        $data['title'] = 'HiPLN';
        $this->load->view('home/index', $data);
    }

    public function verify()
    {

        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('member', ['email' => $email])->row_array();
        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    // $this->db->set("active", 1);
                    // $this->db->where('email', $email);
                    // $this->db->update('member');
                    // $this->db->delete('user_token', ['email' => $email]);
                    // $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
                    //     Akun ' . $email . ' telah di update, terimakasih.
                    // </div>');
                    // TAMPILIN FORM UPDATE
                    $data['provinsi'] = $this->indo->getProvinsi();

                    $data['member'] = $this->indo->getMember($email);

                    $data['title'] = 'Update';
                    $this->session->set_userdata('update', true);
                    $this->load->view('home/update', $data);
                    // redirect('Home');
                } else {
                    $this->db->delete('member', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
					    Update akun gagal, token expired.
					</div>');
                    redirect('Home');
                }
            } else {
                $this->session->set_flashdata('massage', '<div class="alert alert-danger" role="alert">
			    Update akun gagal, wrong token.
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

    private function _sendEmail($token)
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

        $this->email->initialize($config);
        $this->email->set_newline("\r\n");

        $this->email->from('HiPLN', 'no-reply [HiPLN]');
        $this->email->to($token['email']);
        if ($token['update'] == true) {
            $this->email->subject('Update Account');
            $this->email->message($token['isi'] . ' : <a href="' . base_url() . 'Home/verify?email=' . $token['email'] . '&token=' . urlencode($token['token']) . '">Click here</a>');
        } else {
            $this->email->subject('Account Verification');
            $this->email->message($token['isi'] . ' : <a href="' . base_url() . 'Auth/verify?email=' . $token['email'] . '&token=' . urlencode($token['token']) . '">Click here</a>');
        }
        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function addMember()
    {
        $data['email'] = htmlspecialchars($this->input->post('email'));
        $data['nama'] = htmlspecialchars($this->input->post('nama'));
        $data['provinsi'] = $this->input->post('provinsi');
        $data['kotkab'] = $this->input->post('kotkab');
        $data['kecamatan'] = $this->input->post('kecamatan');
        $data['desa'] = $this->input->post('desa');
        $data['alamat'] = htmlspecialchars($this->input->post('alamat'));

        $this->indo->addMember($data);

        $token = str_replace(array('\'', '"', ',', ';', '<', '>', '=', '|', '/', '+', '-', '&', '^', '$', '#', '@', '!', '~', '`', '_', '(', ')'), '', base64_encode(random_bytes(32)));

        $user_token = [
            'isi' => 'Click this link to verify your HiPLN account',
            'email' => $data['email'],
            'token' => $token,
            'update' => false,
            'date_created' => time()
        ];

        $this->token->addUserToken($user_token);

        $this->_sendEmail($user_token);

        $this->session->set_flashdata('massage', '<div class="alert alert-success" role="alert">
			Kami telah mengirimkan link aktifasi ke email anda, harap memferivikasi dalam 30 menit terimakasih.
			</div>');
    }
}
