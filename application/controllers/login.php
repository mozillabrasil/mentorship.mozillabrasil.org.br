<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

    private $fake_user = array(
        'status' => 'okay',
        'email' => 'rdrgwtrs@gmail.com',
        'audience' => 'http://persona.localhost:80',
        'expires' => 1348971576253,
        'issuer' => 'login.persona.org'
    );

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->view('login/index');
    }

    public function auth() {
        $json = array(
            'success' => false
        );
        $assertion = $this->input->post('assertion', true);
        if (trim($assertion)) {
            $response = $this->get_response($assertion);
            if ($response->status !== 'okay') {
                $email = 'rdrgwtrs@gmail.com';
                if ($this->valid_if_user_exists($email) === true) {
                    $json['success'] = true;
                    $json['data'] = $this->fake_user;
                    $this->session->set_userdata($json['data']);
                }
            } else {
                $json['error'] = isset($response->reason) ? $response->reason : '';
            }
        }
        echo json_encode($json);
    }

    public function valid_if_user_exists($email) {
        $this->load->model('mentors_model');
        $user_exists = $this->mentors_model->get_by_email($email);
        return isset($user_exists->serverData) ? true : false ;
    }

    public function get_response($assertion) {
        $url = 'https://verifier.login.persona.org/verify';
        $c = curl_init($url);
        $data = 'assertion=' . $assertion . '&audience=http://persona.localhost:80';

        curl_setopt_array($c, array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2
        ));

        $result = curl_exec($c);
        curl_close($c);

        return json_decode($result);
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */