<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('form_validation');
		$this->load->model('auth_model');
		$this->load->model('User_model');
		if(!$this->auth_model->current_user()){
			redirect('auth/login');
		}
	}

	public function index($id)
	{
		$data['title'] = "Profile";
		$data['current_user'] = $this->auth_model->current_user();
		$data['user'] = $this->User_model->getById($id);
		$this->load->view('backoffice/profile/index', $data);
	}

	public function update($id = null)
    {
        if (!isset($id)) redirect('user');
       
        $user = $this->User_model;
        $validation = $this->form_validation;
        $validation->set_rules($user->rules_edit());
        if ($validation->run()) {
            $user->updateData($id);
            $this->session->set_flashdata('message', 'Berhasil mengganti data');
			redirect('dashboard');
        }else{
			$data['title'] = "Profile";
			$data['current_user'] = $this->auth_model->current_user();
			$data['user'] = $this->User_model->getById($id);
			$this->load->view('backoffice/profile/index', $data);
		}

    }
}
