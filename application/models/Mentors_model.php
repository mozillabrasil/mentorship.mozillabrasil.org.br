<?php

class Mentors_model extends MY_Model {

  private $id;
  private $name;
  private $email;
  private $city;
  private $uf;

  function __construct() {
    parent::__construct();
    $this->table = 'mentors';
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

  public function set_email($email){
    $this->email = $email;
  }
  public function get_email(){
    return $this->email;
  }

  public function set_city($city){
    $this->city = $city;
  }
  public function get_city(){
    return $this->city;
  }

  public function set_uf($uf){
    $this->uf = $uf;
  }
  public function get_uf(){
    return $this->uf;
  }

  function all() {

    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->order_by('name');

    return $this->db->get()->result_array();
  }

  public function get_by_email() {

    $this->email = $this->get_email();

    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('email', $this->email);
    return $this->db->get()->row();
  }

}
