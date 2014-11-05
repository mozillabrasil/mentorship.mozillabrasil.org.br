<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Members extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('members_model');
    }

    public function index() {
        $this->load->model('interests_model');
        $data = array(
            'list_interests' => $this->interests_model->get_all()
        );
        $this->render('members/index', $data);
    }

    public function load() {
        $list_members = $this->members_model->get_all();
        if (count($list_members) > 0) {
            foreach ($list_members as $member) {
                $this->load->view('members/row_member', $member->serverData);
            }
        } else {
            echo '<tr><td colspan="5">Nenhum registro encontrado</td></tr>';
        }
    }

    public function form($objectId = null) {
        $data = array(
            'success' => true
        );
        if (!is_null($objectId)) {
            $member = $this->members_model->get($objectId);
            $data['success'] = isset($member->serverData['objectId']) ? true : false;
            $data['data'] = $member->serverData;
        }
        echo json_encode($data);
    }

    public function save_or_update() {
        $data = array(
            'objectId' => $this->input->post('objectId', TRUE),
            'name' => $this->input->post('name', TRUE),
            'email' => $this->input->post('email', TRUE),
            'localization' => $this->input->post('localization', TRUE),
            'interest' => explode(',', $this->input->post('interest', TRUE))
        );
        $objectID = $this->members_model->save_or_update($data);
        $success = false;
        if (trim($objectID)) {
            $success = true;
        } else {
            $objectID = null;
        }
        echo json_encode(array(
            'success' => $success,
            'objectID' => $objectID
        ));
    }

}
