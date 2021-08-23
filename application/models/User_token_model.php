<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_token_model extends CI_Model
{

    public function addUserToken($data)
    {
        $up = [
            'email' => $data['email'],
            'token' => $data['token'],
            'date_created' => time()
        ];
        if ($this->db->insert('user_token', $up)) {
            return true;
        } else {
            return false;
        }
    }
}
