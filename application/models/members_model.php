<?php

class Members_model extends MY_Model {

    private $resource = array();

    function __construct() {
        parent::__construct();
        $this->resource = $this->loadParseQuery("Members");
        $this->resource->equalTo("mentor", $this->sessao['email']);
    }

    public function get($objectId) {
        return $this->resource->get($objectId);
    }

    function get_all() {
        $this->resource->ascending("name");
        return $this->resource->find();
    }

    public function save_or_update($data) {
        $this->resource = $this->loadParseObject("Members", $data['objectId']);

        $this->resource->set("mentor", $this->sessao['email']);
        $this->resource->set("name", $data['name']);
        $this->resource->set("email", $data['email']);
        $this->resource->set("localization", $data['localization']);
        $this->resource->setArray("interest", $data['interest']);

        try {
            $this->resource->save();
            return $this->resource->getObjectId();
        } catch (ParseException $ParseException) {
            echo json_encode(array(
                'success' => false,
                'error' => $ParseException->getMessage()
            ));
            exit;
        }
    }

}
