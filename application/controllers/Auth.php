<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        header('Content-Type: application/json');
    }

    public function login() {
        $user = $this->db->get('users')->result();

        echo json_encode([
            'status' => 'db hidup',
            'data' => $user
        ]);
    }
}
