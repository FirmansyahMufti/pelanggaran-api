<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/JWT/JWT.php';

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->config('jwt');
        header('Content-Type: application/json');
    }

    public function login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (!$username || !$password) {
            http_response_code(400);
            echo json_encode([
                'status' => false,
                'message' => 'Username dan password wajib diisi'
            ]);
            return;
        }

        $user = $this->db->get_where('users', [
            'username' => $username
        ])->row();

        if (!$user || !password_verify($password, $user->password)) {
            http_response_code(401);
            echo json_encode([
                'status' => false,
                'message' => 'Username atau password salah'
            ]);
            return;
        }

        $payload = [
            'id' => $user->id,
            'username' => $user->username,
            'iat' => time(),
            'exp' => time() + $this->config->item('jwt_exp')
        ];

        // JWT encode (AMAN, CI3)
        $token = JWT::encode($payload, $this->config->item('jwt_key'));

        echo json_encode([
            'status' => true,
            'token' => $token
        ]);
    }
}
