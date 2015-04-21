<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Members extends MY_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('Members_model');
    $this->load->model('Members_interests_model');
  }

  public function index() {
    $this->load->model('interests_model');
    $data = array(
        'list_interests' => $this->interests_model->all()
    );
    $this->render('members/index', $data);
  }

  public function load() {

    $this->Members_model->set_id_mentor($this->sessao['id']);

    $list_members = $this->Members_model->all();
    if (count($list_members) > 0) {

      foreach ($list_members as $member) {

        $this->Members_interests_model->set_id_members($member['id']);
        $member['interests'] = $this->Members_interests_model->all();
        $this->load->view('members/row_member', $member);

      }

    } else {

      echo '<tr><td colspan="5">Nenhum registro encontrado</td></tr>';

    }
  }

  public function form($id = null) {
    $data = array(
      'success' => false
    );
    if (is_numeric($id)) {

      $this->Members_model->set_id($id);
      $this->Members_model->set_id_mentor($this->sessao['id']);

      $member = $this->Members_model->get();

      if( isset($member['id']) && is_numeric($member['id']) ){
        $data['success'] = true;
        $this->Members_interests_model->set_id_members($member['id']);
        $member['interests'] = $this->Members_interests_model->all();
        $data['data'] = $member;
      }
    }
    echo json_encode($data);
  }

  public function save_or_update() {

    $this->Members_model->set_id($this->input->post('id', TRUE));
    $this->Members_model->set_id_mentor($this->sessao['id']);

    $this->Members_model->set_name($this->input->post('name', TRUE));
    $this->Members_model->set_email($this->input->post('email', TRUE));
    $this->Members_model->set_localization($this->input->post('localization', TRUE));

    $id_member = $this->Members_model->save_or_update();
    $success = false;

    if ( is_numeric($id_member) ) {

      $this->Members_interests_model->set_id_members($id_member);
      $this->Members_interests_model->truncate();

      $interests = $this->input->post('interests', TRUE);
      if( is_array($interests) ){

        foreach($interests as $interest){
          $this->Members_interests_model->set_id_interests($interest);
          $this->Members_interests_model->save();
        }

      }
      $success = true;
    }
    echo json_encode(array(
      'success' => $success
    ));
  }

}
