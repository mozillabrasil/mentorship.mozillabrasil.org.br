<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter MY_Controller class
 *
 * Basic data access functionality for CodeIgniter projects
 *
 * @package         CodeIgniter
 * @subpackage      Core
 * @category        Core
 * @author          Rodrigo Waters
 * @license         MIT License
 */
class MY_Controller extends CI_Controller {

    public $css = array(
        'style.default',
        'style.palegreen',
        'custom'
    );
    public $js = array(
        'jquery-1.10.2.min',
        'jquery-migrate-1.2.1.min',
        'jquery-ui-1.10.3.min',
        'bootstrap.min',
        'modernizr.min',
        'jquery.cookies',
        'custom',
        'app'
    );

    function __construct() {
        parent::__construct();
        $sessao = $this->session->userdata('status');
        if ($sessao !== 'okay') {
            if (!in_array($this->router->fetch_class(), array('login'))) {
                if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest') {
                    //        echo 'Perdeu sessÃ£o';
                } else {
                    redirect($this->config->config['base_url'] . 'login/index');
                }
            }
        }
    }

    public function render($view, $params = array()) {
        $data = array();
        if (!$this->input->is_ajax_request()) {
            $this->load->view('header', array(
                'css' => array_merge($this->css)
            ));
            $this->load->view('footer', array(
                'js' => array_merge($this->js)
            ));
        } else {
            $this->load->view($view, array_merge($data, $params));
        }
    }

}
