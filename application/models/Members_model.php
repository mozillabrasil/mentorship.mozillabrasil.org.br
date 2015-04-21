<?php

class Members_model extends MY_Model {

  private $id;
  private $id_mentor;
  private $email;
  private $localization;
  private $name;

  function __construct() {
    parent::__construct();
    $this->table = 'members';
  }

  public function set_id($id){
    $this->id = $id;
  }
  public function get_id(){
    return $this->id;
  }

  public function set_id_mentor($id_mentor){
    $this->id_mentor = $id_mentor;
  }
  public function get_id_mentor(){
    return $this->id_mentor;
  }

  public function set_email($email){
    $this->email = $email;
  }
  public function get_email(){
    return $this->email;
  }

  public function set_localization($localization){
    $this->localization = $localization;
  }
  public function get_localization(){
    return $this->localization;
  }

  public function set_name($name){
    $this->name = $name;
  }
  public function get_name(){
    return $this->name;
  }

  function all() {

    $this->id_members = $this->get_id_mentor();

    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('id_mentor', $this->id_mentor);
    $this->db->order_by('name');

    return $this->db->get()->result_array();
  }

  public function get() {

    $this->id = $this->get_id();
    $this->id_members = $this->get_id_mentor();

    $this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('id', $this->id);
    $this->db->where('id_mentor', $this->id_mentor);
    return (array)$this->db->get()->row();
  }

  public function save_or_update() {

    $this->id = $this->get_id();
    $this->id_mentor = $this->get_id_mentor();

    $this->name = $this->get_name();
    $this->email = $this->get_email();
    $this->localization = $this->get_localization();

    $this->db->set('name',$this->name);
    $this->db->set('email',$this->email);
    $this->db->set('localization',$this->localization);

    if( is_numeric($this->id) ){

      $this->db->where('id',$this->id);
      $this->db->where('id_mentor',$this->id_mentor);
      $this->db->update($this->table);

      $response = $this->id;

    }else{

      $this->db->set('id_mentor',$this->id_mentor);
      $this->db->insert($this->table);

      $response = $this->db->insert_id();

    }
    return $response;
  }

}
