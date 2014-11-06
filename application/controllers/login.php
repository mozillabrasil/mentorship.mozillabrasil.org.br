<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

    /**
     * Scheme, hostname and port
     */
    protected $audience;

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
            $response = $this->verifyAssertion($assertion);
            if ($response->status === 'okay') {
                if ($this->valid_if_user_exists($response->email) === true) {
                    $json['success'] = true;
                    $json['data'] = $response;
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
        return isset($user_exists->serverData) ? true : false;
    }

    /**
     * Verify the validity of the assertion received from the user
     *
     * @param string $assertion The assertion as received from the login dialog
     * @return object The response from the Persona online verifier
     */
    public function verifyAssertion($assertion) {
        $this->audience = $this->guessAudience();

        $postdata = 'assertion=' . urlencode($assertion) . '&audience=' . urlencode($this->audience);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://verifier.login.persona.org/verify");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }

    /**
     * Guesses the audience from the web server configuration
     */
    protected function guessAudience() {
        $audience = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $audience .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'];
        return $audience;
    }

}

/* End of file main.php */
/* Location: ./application/controllers/main.php */