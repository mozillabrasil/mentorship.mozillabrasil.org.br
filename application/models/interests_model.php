<?php

class Interests_model extends MY_Model {

    private $resource = array();

    function __construct() {
        parent::__construct();
        $this->resource = $this->loadParseQuery("Interests");
    }

    function get_all() {
        $this->resource->ascending("name");
        return $this->resource->find();
    }

}
