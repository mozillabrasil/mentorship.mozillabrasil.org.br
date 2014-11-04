<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Main extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->render('main/index');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login/index');
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */