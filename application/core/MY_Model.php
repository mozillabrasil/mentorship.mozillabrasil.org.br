<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter MY_Model class
 *
 * Basic data access functionality for CodeIgniter projects
 *
 * @package         CodeIgniter
 * @subpackage      Core
 * @category        Core
 * @author          Rodrigo Waters
 * @license         MIT License
 */
require_once APPPATH . 'third_party/autoload.php';

use Parse\ParseClient;
use Parse\ParseQuery;
use Parse\ParseObject;

class MY_Model extends CI_Model {

    public $sessao = array();

    function __construct() {
        parent::__construct();

        $app_id = '';
        $rest_key = '';
        $master_key = '';

        ParseClient::initialize($app_id, $rest_key, $master_key);
        $this->sessao = $this->session->userdata;
    }

    public function loadParseQuery($Class) {
        return new ParseQuery($Class);
    }

    public function loadParseObject($Class, $objectId = NULL) {
        return new ParseObject($Class, $objectId);
    }

    public function debug($Debug) {
        echo '####################<pre>';
        print_r($Debug);
        echo '</pre>####################';
    }

}
