<?php

class Members_interests_model extends MY_Model {

  private $id;
  private $id_members;
  private $id_interests;

  function __construct() {
    parent::__construct();
    $this->table = 'members_interests';
  }

  public function set_id($id){
    $this->id = $id;
  }
  public function get_id(){
    return $this->id;
  }

  public function set_id_members($id_members){
    $this->id_members = $id_members;
  }
  public function get_id_members(){
    return $this->id_members;
  }

  public function set_id_interests($id_interests){
    $this->id_interests = $id_interests;
  }
  public function get_id_interests(){
    return $this->id_interests;
  }

  public function all() {

    $this->id_members = $this->get_id_members();

    $this->db->select('interests.*');
    $this->db->from($this->table, 'members_interests');
    $this->db->join('members AS members', 'members.id = members_interests.id_members', 'INNER');
    $this->db->join('interests AS interests', 'interests.id = members_interests.id_interests', 'INNER');
    $this->db->where('members_interests.id_members', $this->id_members);
    $this->db->order_by('interests.name');

    return $this->db->get()->result_array();
  }

  public function truncate(){

    $this->id_members = $this->get_id_members();

    $this->db->where('id_members',$this->id_members);
    $this->db->delete($this->table);

  }

  public function save(){

    $this->id_members = $this->get_id_members();
    $this->id_interests = $this->get_id_interests();

    $this->db->set('id_members',$this->id_members);
    $this->db->set('id_interests',$this->id_interests);
    $this->db->insert($this->table);

  }

}
