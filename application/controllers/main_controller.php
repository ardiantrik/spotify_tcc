<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class main_controller extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('main_model');
    }

	public function index(){
		//$this->load->view('view_home');
        $this->testGetData();
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

    public function testGetData()
    {
        $data = $this->main_model->selectAllData();
        $this->load->library('ftp');
        $config['hostname'] = '192.168.91.128';
        $config['username'] = 'root';
        $config['password'] = '123160035';
        $config['debug']    = TRUE;

        $this->ftp->connect($config);

        foreach ($data as $temp) {
            $this->ftp->download('/mnt/assets/'.$temp['file_name'],'C:/xampp/htdocs/spotify_tcc/assets/'.$temp['file_name'],'auto');
        }

        //$test = $this->ftp->mirror('C:/xampp/htdocs/spotify_tcc/assets/','/mnt/assets/');
        // $test = $this->ftp->list_files('/mnt/assets/');
        
        // if ($test) {
        //     echo "fefef";
        // }else{
        //     echo 'sad';
        // }

        $this->load->view("view_home",array(
            'data' => $data
        ));

        $this->ftp->close();
    }

    // public function viewTampilData()
    // {
    //     $data = $this->main_model->selectAllData();
    //     $this->load->view("view_home",array(
    //         'data' => $data
    //     ));
    // }
}
