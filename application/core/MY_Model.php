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

class MY_Model extends CI_Model {

    public $table = null;

    function __construct() {
        parent::__construct();
    }

}
