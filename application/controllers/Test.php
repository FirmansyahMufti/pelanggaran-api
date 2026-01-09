<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// PAKSA LOAD HELPER
require_once APPPATH . 'helpers/jwt_helper.php';

class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        validate_jwt(); // SEKARANG PASTI KELOAD
    }

    public function index() {
        echo json_encode([
            'message' => 'token valid, akses aman'
        ]);
    }
}
