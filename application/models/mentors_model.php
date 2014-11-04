<?php

class Mentors_model extends MY_Model {

    private $resource = array();

    function __construct() {
        parent::__construct();
        $this->resource = $this->loadParseQuery("Mentors");
    }

    public function get_by_email($email) {
        $this->resource->equalTo("email", $email);
        $result = $this->resource->find();
        return isset($result[0]) ? $result[0] : array() ;
    }

}
