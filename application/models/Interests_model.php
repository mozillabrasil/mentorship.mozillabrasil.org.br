<?php

class Interests_model extends MY_Model {

  private $id;
  private $name;

  function __construct() {
    parent::__construct();
    $this->table = 'interests';
  }


  public function set_id($id){
    $this->id = $id;
  }
  public function get_id(){
    return $this->id;
  }

  public function set_name($name){
    $this->name = $name;
  }
  public function get_name(){
    return $this->name;
  }

  function all() {

    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->order_by('name');

    return $this->db->get()->result_array();
  }

}
