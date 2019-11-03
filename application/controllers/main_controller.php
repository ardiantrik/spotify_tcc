<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main_controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('main_model');
    }

	public function index(){
		$this->load->view('view_home');
    }

    // public function viewInput(){
    //     $this->load->view('view_input');
    // }

    // public function inputData(){
    //     $data['nama'] = $this->input->post('nama');
    //     $data['nim'] = $this->input->post('nim');
    //     $this->model_mahasiswa->insertData($data);
    //     // redirect(base_url('index.php/mahasiswa'));
    //     $this->index();
    // }

    public function viewTampilData()
    {
        $data = $this->main_model->selectAllData();
        $this->load->view("view_home",array(
            'data' => $data
        ));
    }
}
